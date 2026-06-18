<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('estate')
            ->whereNull('main_image_file_path')
            ->orderBy('id')
            ->chunk(500, function ($estates) {
                $estateIds = $estates->pluck('id');

                $documents = DB::table('estate_document')
                    ->whereIn('estate_id', $estateIds)
                    ->groupBy('estate_id')
                    ->select('estate_id', DB::raw('MIN(id) as id'))
                    ->get();

                $documentPaths = DB::table('estate_document')
                    ->whereIn('id', $documents->pluck('id'))
                    ->get()
                    ->keyBy('id');

                $updates = [];
                foreach ($estates as $estate) {
                    $firstDocument = $documents->firstWhere('estate_id', $estate->id);

                    if ($firstDocument && isset($documentPaths[$firstDocument->id])) {
                        $path = $documentPaths[$firstDocument->id]->path;
                        $updates[] = [
                            'id' => $estate->id,
                            'main_image_file_name' => $path,
                            'main_image_file_path' => $estate->id . '/' . $path,
                            'main_image_file_path_thumb' => $estate->id . '/' . $path,
                        ];
                    }
                }

                foreach ($updates as $update) {
                    DB::table('estate')
                        ->where('id', $update['id'])
                        ->update([
                            'main_image_file_name' => $update['main_image_file_name'],
                            'main_image_file_path' => $update['main_image_file_path'],
                            'main_image_file_path_thumb' => $update['main_image_file_path_thumb'],
                        ]);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
