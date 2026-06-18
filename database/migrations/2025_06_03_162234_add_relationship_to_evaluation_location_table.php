<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('c_evaluation_location', function (Blueprint $table) {
            $table->integer('c_location_community_id')
                ->nullable()
                ->unique()
                ->after('evaluation_location_type_id');

            $table->foreign('c_location_community_id')
                ->references('id')
                ->on('c_location_community')
                ->onDelete('set null');
        });

        $now = Carbon::now();
        $communities = DB::table('c_location_community')->select(['id', 'name_arm', 'name_eng', 'name_ru'])->get();
        $data = $communities->map(function ($community) use ($now) {
            return [
                'name_arm' => $community->name_arm,
                'name_eng' => $community->name_eng,
                'name_ru' => $community->name_ru,
                'coefficient' => 1000,
                'c_location_community_id' => $community->id,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->toArray();

        DB::table('c_evaluation_location')->insert($data);

        $districts = DB::table('c_evaluation_location')
            ->whereNull('c_location_community_id')
            ->select(['id', 'name_arm', 'name_eng', 'name_ru', 'coefficient'])
            ->get();
        $data = $districts->map(function ($district) use ($now) {
            return [
                'name_arm' => $district->name_arm,
                'name_eng' => $district->name_eng,
                'name_ru' => $district->name_ru,
                'coefficient' => $district->coefficient,
                'c_evaluation_location_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->toArray();

        DB::table('c_evaluation_project_and_micro_district')->insert($data);
        DB::table('c_evaluation_location')
            ->whereNull('c_location_community_id')
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $now = Carbon::now();
        $districts = DB::table('c_evaluation_project_and_micro_district')
            ->whereNull('c_evaluation_location_id')
            ->get();

        $data = $districts->map(function ($district) use ($now) {
            return [
                'name_arm' => $district->name_arm,
                'name_eng' => $district->name_eng,
                'name_ru' => $district->name_ru,
                'coefficient' => $district->coefficient,
                'c_location_community_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->toArray();

        DB::table('c_evaluation_location')->insert($data);
        DB::table('c_evaluation_location')
            ->whereNotNull('c_location_community_id')
            ->delete();
        DB::table('c_evaluation_project_and_micro_district')
            ->whereNull('c_evaluation_location_id')
            ->delete();

        Schema::table('c_evaluation_location', function (Blueprint $table) {
            $table->dropForeign(['c_location_community_id']);
            $table->dropColumn('c_location_community_id');
        });
    }
};
