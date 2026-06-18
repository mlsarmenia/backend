<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRentedEstateByLastRentEndDateView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW `rented_estate_by_last_rent_end_date` AS select `red_db`.`estate_rent_contract`.`ESTATE_ID` AS `estate_id`,max(`red_db`.`estate_rent_contract`.`END_DATE`) AS `lastEndDate` from `red_db`.`estate_rent_contract` where `red_db`.`estate_rent_contract`.`ESTATE_ID` is not null group by `red_db`.`estate_rent_contract`.`ESTATE_ID`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `rented_estate_by_last_rent_end_date`");
    }
}
