<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('client', function (Blueprint $table) {
            $table->integer('contact_type_id')->nullable();
            $table->string('name_arm', 500)->nullable();
            $table->string('last_name_arm', 500)->nullable();
            $table->char('phone_mobile_1', 40)->nullable();
        });

        DB::table('client')
            ->join('contact', 'client.contact_id', '=', 'contact.id')
            ->update([
                'client.contact_type_id' => DB::raw('contact.contact_type_id'),
                'client.name_arm' => DB::raw('contact.name_arm'),
                'client.last_name_arm' => DB::raw('contact.last_name_arm'),
                'client.phone_mobile_1' => DB::raw('contact.phone_mobile_1'),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropColumn(['contact_type_id', 'name_arm', 'last_name_arm', 'phone_mobile_1']);
        });
    }
};
