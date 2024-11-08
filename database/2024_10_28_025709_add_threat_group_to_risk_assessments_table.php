<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('risk_assessments', function (Blueprint $table) {
            $table->id();
            
            // Link to the assets table
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id')->references('id')->on('asset_register')->onDelete('cascade');


            $table->unsignedBigInteger('threat_group_id')->nullable();
            $table->unsignedBigInteger('threat_id')->nullable();
            $table->unsignedBigInteger('vulnerability_group_id')->nullable();
            $table->unsignedBigInteger('vulnerability_id')->nullable();

           // Add foreign key constraints
           $table->foreign('threat_group_id')->references('id')->on('threat_groups')->onDelete('set null');
           $table->foreign('threat_id')->references('id')->on('threats')->onDelete('set null');
           $table->foreign('vulnerability_group_id')->references('id')->on('vulnerability_groups')->onDelete('set null');
           $table->foreign('vulnerability_id')->references('id')->on('vulnerabilities')->onDelete('set null');

            // CIA Triad (Confidentiality, Integrity, Availability)
            $table->integer('confidentiality')->default(1); // or change default as needed
            $table->integer('integrity')->default(1);
            $table->integer('availability')->default(1);
            // New column for CIA Score Category
            $table->string('cia_score_category')->nullable(); // Column to store the CIA score category

           
            // Risk assessment fields
            $table->string('personnel')->nullable();
            $table->enum('likelihood', ['Low', 'Medium', 'High'])->nullable();
            $table->enum('impact', ['Low', 'Medium', 'High'])->nullable();
            $table->enum('risk_level', ['Low', 'Medium', 'High'])->nullable();
            $table->string('risk_owner')->nullable();
            $table->string('mitigation_option')->nullable();
            $table->text('treatment')->nullable();
            $table->text('actions')->nullable();

            

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('risk_assessments', function (Blueprint $table) {
            // Drop foreign key constraints first
            $table->dropForeign(['asset_id']);
            $table->dropForeign(['threat_group_id']);
            $table->dropForeign(['threat_id']);
            $table->dropForeign(['vulnerability_group_id']);
            $table->dropForeign(['vulnerability_id']);
            $table->boolean('confidentiality')->default(false);
            $table->boolean('integrity')->default(false);
            $table->boolean('availability')->default(false);
        });

        Schema::dropIfExists('risk_assessments');
    }
};