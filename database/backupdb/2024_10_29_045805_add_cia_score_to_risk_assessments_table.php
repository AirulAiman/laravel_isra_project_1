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
        Schema::table('risk_assessments', function (Blueprint $table) {
            $table->string('cia_score')->nullable(); // Adjust the type if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('risk_assessments', function (Blueprint $table) {
            $table->dropColumn('cia_score');
        });
    }
};
