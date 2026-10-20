<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SolutionForest\FilamentTree\Concern\ModelTree;

class Menus extends Model
{
    use HasFactory;
    use ModelTree;

    public function determineOrderColumnName(): string
    {
        return 'order_by';
    }

    public function determineParentColumnName(): string
    {
        return 'parent_id';
    }

    public function determineTitleColumnName(): string
    {
        return 'name';
    }

    public static function defaultParentKey()
    {
        return null;
    }

    public const TYPE_LABELS = [
        'main_menu' => 'Main Menu',
        'sub_menu' => 'Sub Menu',
        'submenu_under_submenu' => 'Submenu Under Submenu',
        'submenu_level_4' => 'Submenu Level 4',
        'submenu_level_5' => 'Submenu Level 5',
    ];

    public const PARENT_TYPES = [
        'sub_menu' => 'main_menu',
        'submenu_under_submenu' => 'sub_menu',
        'submenu_level_4' => 'submenu_under_submenu',
        'submenu_level_5' => 'submenu_level_4',
    ];

    protected $fillable = [
        'type',
        'name',
        'is_url',
        'url',
        'target',
        'status',
        'order_by',
        'parent_id',
        'created_at',
        'updated_at'
    ];

    protected $appends = ['type_label'];

    public function getTypeLabelAttribute(): string
    {
        $type = $this->attributes['type'] ?? null;
        if (!$type) {
            return '';
        }

        return self::TYPE_LABELS[$type]
            ?? ucfirst(str_replace('_', ' ', $type));
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Menus::class, 'parent_id')->where('status', 1);
    }
    public function subParent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Menus::class, 'parent_id')->where('type', 'main_menu')->where('status', 1);
    }

    public function subUnderParent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Menus::class, 'parent_id')->where('type', 'sub_menu')->where('status', 1);
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Menus::class, 'parent_id')
            ->where('status', 1)
            ->orderByRaw('order_by IS NULL')
            ->orderBy('order_by', 'asc')
            ->orderBy('id', 'asc');
    }

    public function allChildren()
    {
        return $this->hasMany(Menus::class, 'parent_id')
            ->with('allChildren')
            ->where('status', 1)
            ->orderByRaw('order_by IS NULL')
            ->orderBy('order_by', 'asc')
            ->orderBy('id', 'asc');
    }

    public function page(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Pages::class, 'menu_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($menu) {
            if (filled($menu->order_by)) {
                return;
            }

            $menu->order_by = static::where('parent_id', $menu->parent_id)->max('order_by') + 1;
        });

        static::deleting(function ($menu) {
            // Check if the menu has child menus
            if ($menu->children()->count() > 0) {
                throw new \Exception("This menu has submenus and cannot be deleted.");
            }

            // Check if the menu is referred to by a page
            if ($menu->page()->exists()) {
                throw new \Exception("This menu is referenced by a page and cannot be deleted.");
            }
        });
    }
}
