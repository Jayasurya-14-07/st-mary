<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $positionByParent = DB::table('menuses')
            ->select('parent_id', DB::raw('MAX(order_by) as max_order'))
            ->whereNotNull('order_by')
            ->groupBy('parent_id')
            ->get()
            ->mapWithKeys(fn ($menu): array => [
                $menu->parent_id ?? 'root' => (int) $menu->max_order,
            ])
            ->all();

        DB::table('menuses')
            ->select('id', 'parent_id', 'order_by')
            ->whereNull('order_by')
            ->orderBy('parent_id')
            ->orderBy('id')
            ->get()
            ->each(function ($menu) use (&$positionByParent): void {
                $parentKey = $menu->parent_id ?? 'root';
                $positionByParent[$parentKey] = ($positionByParent[$parentKey] ?? 0) + 1;

                DB::table('menuses')
                    ->where('id', $menu->id)
                    ->update(['order_by' => $positionByParent[$parentKey]]);
            });
    }

    public function down(): void
    {
        //
    }
};
