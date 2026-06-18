<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealtorUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realtor_user', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('contact_id')->nullable();
            $table->string('username', 100)->nullable();
            $table->string('password', 128)->nullable();
            $table->integer('version')->nullable();
            $table->boolean('is_deleted')->nullable();
            $table->integer('profession_type_id')->nullable();
            $table->dateTime('last_modified_on')->nullable();
            $table->integer('last_modified_by')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->integer('created_by')->nullable();
            $table->boolean('is_from_public')->nullable();
            $table->boolean('is_active')->nullable();
            $table->boolean('is_blocked')->nullable();
            $table->string('profile_picture_name')->nullable();
            $table->string('profile_picture_path')->nullable();
            $table->string('activation_code')->nullable();
            $table->integer('view_count')->nullable();
            $table->integer('party_type_id')->nullable();
            $table->integer('contact_visits_count')->nullable();
            $table->integer('screened_count')->nullable();
            $table->integer('packet_type_id')->nullable();
            $table->date('packet_start_date')->nullable();
            $table->date('packet_end_date')->nullable();
            $table->integer('menu_location_province_id')->nullable();
            $table->string('meta_title_eng', 500)->nullable();
            $table->string('meta_title_arm', 500)->nullable();
            $table->string('meta_title_ru', 500)->nullable();
            $table->string('meta_description_eng', 2000)->nullable();
            $table->string('meta_description_arm', 2000)->nullable();
            $table->string('meta_description_ru', 2000)->nullable();
            $table->integer('permission_menu_packet_type_id')->nullable();
            $table->date('permission_menu_packet_start_date')->nullable();
            $table->date('permission_menu_packet_end_date')->nullable();
            $table->integer('permission_menu_location_province_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realtor_user');
    }
}
