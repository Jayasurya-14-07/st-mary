<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = [
            'posts' => ['title', 'excerpt'],
            'pages' => ['title', 'excerpt'],
            'sliders' => ['title', 'subtitle', 'description'],
            'menus' => ['name'],
            'categories' => ['name', 'description'],
            'flash_news' => ['title'],
            'photo_galleries' => ['title', 'description'],
        ];

        foreach ($tables as $table => $columns) {
            if (!Schema::hasTable($table)) continue;

            $records = DB::table($table)->get();

            foreach ($records as $record) {
                $updateData = [];
                foreach ($columns as $column) {
                    if (isset($record->$column)) {
                        $value = $record->$column;
                        if ($this->isJson($value)) {
                            $decoded = json_decode($value, true);
                            $updateData[$column] = $decoded['en'] ?? (reset($decoded) ?: $value);
                        }
                    }
                }

                if (!empty($updateData)) {
                    DB::table($table)->where('id', $record->id)->update($updateData);
                }
            }
        }
    }

    private function isJson($string) {
        if (!is_string($string)) return false;
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No easy way to reverse this
    }
};
