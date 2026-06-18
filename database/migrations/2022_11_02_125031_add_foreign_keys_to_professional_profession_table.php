<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProfessionalProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professional_profession', function (Blueprint $table) {
            $table->foreign(['PROFESSION_ID'], 'FK_PROFESSIONAL_PROFESSION')->references(['ID'])->on('c_profession_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professional_profession', function (Blueprint $table) {
            $table->dropForeign('FK_PROFESSIONAL_PROFESSION');
        });
    }
}
