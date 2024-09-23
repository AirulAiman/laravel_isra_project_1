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
    Schema::create('threats', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('threat_group_id');
        $table->string('name');
        $table->text('description');
        $table->timestamps();

        $table->foreign('threat_group_id')->references('id')->on('threat_groups')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threats');
    }
};
