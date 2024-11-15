<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('existing_controls', function (Blueprint $table) {
            $table->id();
            $table->string('control_id')->unique();
            $table->string('name');
            $table->text('description');
            $table->foreignId('control_group_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('existing_controls');
    }
};