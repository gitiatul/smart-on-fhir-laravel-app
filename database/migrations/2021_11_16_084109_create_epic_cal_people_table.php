<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpicCalPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epic_cal_people', function (Blueprint $table) {
            $table->bigIncrements('p_UID');
            $table->Integer('p_PRACTID')->nullable();
            $table->string('p_pid')->nullable();
            $table->string('p_fhir_id')->unique();
            $table->string('p_fname')->nullable();
            $table->string('p_mname')->nullable();
            $table->string('p_lname')->nullable();
            $table->string('p_phone_home')->nullable();
            $table->string('p_phone_cell')->nullable();
            $table->string('p_email')->nullable();
            $table->tinyInteger('p_gender')->nullable();
            $table->date('p_dob')->nullable();
            $table->string('p_street')->nullable();
            $table->string('p_city')->nullable();
            $table->string('p_county')->nullable();
            $table->string('p_state')->nullable();
            $table->string('p_postal_code')->nullable();
            $table->string('p_country_code')->nullable();
            $table->string('p_allow_sms')->nullable();
            $table->string('p_allow_avm')->nullable();
            $table->string('p_allow_email')->nullable();
            $table->timestamp('last_changed')->useCurrent();
            $table->dateTime('p_deceased')->nullable();
            $table->string('p_language')->nullable();
            $table->string('p_allow_surveys')->nullable();
            $table->date('p_last_CAPHS')->nullable();
            $table->tinyInteger('needs_verification')->nullable();
            $table->text('last_json')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epic_cal_people');
    }
}
