<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary(); // XXX000
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');
            $table->integer('privilege')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreignId('organization')->nullable()->constrained(table:'organizations', column:'org_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
