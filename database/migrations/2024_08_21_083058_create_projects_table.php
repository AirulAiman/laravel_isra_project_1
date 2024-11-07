<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ========================
        // Projects Table:
        // ProjectID, OrgID, Month, Year, CreatedTimestamp, EditedTimestamp 
        // ========================

        Schema::create('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('prj_id')->primary(); //XX00
            $table->string('prj_name');
            $table->string('prj_desc');
            $table->string('start_date');
            $table->string('end_date');
            $table->foreignId('organization')->nullable()->constrained(table: 'organizations', column: 'org_id');
            $table->timestamps(); // this will add 'created_at' and 'updated_at' columns
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
