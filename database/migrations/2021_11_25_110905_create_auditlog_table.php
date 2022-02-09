<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditlog', function (Blueprint $table) {
            $table->bigIncrements('auditlog_id');
            $table->string('request_token')->nullable();
            $table->text('request_url')->nullable();
            $table->string('request_method')->nullable();
            $table->text('request_query')->nullable();
            $table->longText('request_payload')->nullable();
            $table->longText('response_payload')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('browser_useragent')->nullable();
            $table->timestamp('event_datetime')->useCurrent();
            $table->Integer('event_actor')->nullable();
            $table->bigInteger('event_actor_id')->nullable();
            $table->tinyInteger('authorized')->default(1);
            $table->Integer('response_code')->nullable();
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
        Schema::dropIfExists('auditlog');
    }
}
