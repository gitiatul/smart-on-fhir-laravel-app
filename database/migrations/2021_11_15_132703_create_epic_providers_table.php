<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpicProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epic_providers', function (Blueprint $table) {
            $table->bigIncrements('P_UID');
            $table->Integer('P_PID')->nullable();
            $table->string('P_ID')->nullable();
            $table->string('P_FHIR_ID')->unique();
            $table->string('P_PSID')->nullable();
            $table->string('P_NPI')->nullable();
            $table->string('P_FNAME')->nullable();
            $table->string('P_LNAME')->nullable();
            $table->string('P_SUFFIX')->nullable();
            $table->string('P_SALUTE')->nullable();
            $table->string('P_PHONETIC')->nullable();
            $table->string('P_FACILITY')->nullable();
            $table->string('P_FACILITY_ID')->nullable();
            $table->string('P_code')->nullable();
            $table->Integer('P_active')->nullable();
            $table->tinyInteger('P_appt')->nullable();
            $table->string('P_sec_phone')->nullable();
            $table->string('P_email')->nullable();
            $table->string('P_SMS')->nullable();
            $table->string('password')->nullable();
            $table->string('salt')->nullable();
            $table->string('P_TM_room')->nullable();
            $table->string('P_IMG')->nullable();
            $table->Integer('P_order_UID')->nullable();
            $table->timestamp('last_updated')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epic_providers');
    }
}
