<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_credentials', function (Blueprint $table) {
            $table->bigIncrements('facility_credentials_id');
            $table->unsignedBigInteger('facility_id');
            $table->foreign('facility_id')->references('facility_id')->on('facilities');
            $table->string('ehr_client_id')->nullable();
            $table->string('facility_hl7_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->string('facility_internal_id')->nullable();
            $table->string('ehr_metadata_endpoint')->nullable();
            $table->string('ehr_authorize_endpoint')->nullable();
            $table->string('ehr_token_endpoint')->nullable();
            $table->string('ehr_fhir_endpoint')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_credentials');
    }
}
