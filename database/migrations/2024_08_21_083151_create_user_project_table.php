<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_project', function (Blueprint $table) {
            $table->foreignId('user')->constrained(table:'users', column:'user_id');
            $table->foreignId('project')->constrained(table:'projects', column:'prj_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_project');
    }
};