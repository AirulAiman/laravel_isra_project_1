<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('risk_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('threat_group_id')->nullable();
            $table->unsignedBigInteger('threat_id')->nullable();
            $table->unsignedBigInteger('vulnerability_group_id')->nullable();
            $table->unsignedBigInteger('vulnerability_id')->nullable();
            $table->integer('confidentiality')->default(0);
            $table->integer('integrity')->default(0);
            $table->integer('availability')->default(0);
            $table->string('personnel')->default('N/A');
            $table->timestamp('start_time')->default(now());
            $table->timestamp('end_time')->nullable();
            $table->string('likelihood')->default('Low');
            $table->string('impact')->default('Low');
            $table->string('risk_level')->default('Acceptable');
            $table->string('risk_owner')->nullable();
            $table->text('mitigation_option')->default('None');
            $table->text('treatment')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('asset_id')->references('asset_id')->on('asset_register')->onDelete('cascade');
            $table->foreign('threat_group_id')->references('id')->on('threat_groups')->onDelete('set null');
            $table->foreign('threat_id')->references('id')->on('threats')->onDelete('set null');
            $table->foreign('vulnerability_group_id')->references('id')->on('vulnerability_groups')->onDelete('set null');
            $table->foreign('vulnerability_id')->references('id')->on('vulnerabilities')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('risk_assessments');
    }
}
