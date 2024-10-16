<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('risk_assessments', function (Blueprint $table) {
            $table->id(); // or your custom primary key
            $table->foreignId('asset_id')->constrained('asset_register')->onDelete('cascade'); // Ensure foreign key constraints
            $table->foreignId('threat_group_id')->nullable()->constrained('threat_groups')->onDelete('set null');
            $table->foreignId('threat_id')->nullable()->constrained('threats')->onDelete('set null');
            $table->foreignId('vulnerability_group_id')->nullable()->constrained('vulnerability_groups')->onDelete('set null');
            $table->foreignId('vulnerability_id')->nullable()->constrained('vulnerabilities')->onDelete('set null');
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
        });
    }
    public function down()
    {
        Schema::dropIfExists('risk_assessments');
    }
}
