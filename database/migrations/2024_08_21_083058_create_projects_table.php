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
            // $table->unsignedBigInteger('prj_id')->primary(); //XX00
            // $table->string('prj_name');
            // $table->text('prj_desc');
            // $table->date('start_date');
            // $table->date('end_date');
            // $table->foreignId('ID')->constrained('organizations')->onDelete('cascade');
            // $table->timestamps(); // this will add 'created_at' and 'updated_at' columns


            $table->id('prj_id');
            $table->string('prj_name');
            $table->text('prj_desc');
            $table->date('start_date');
            $table->date('end_date');
            
            // Define org_id as unsignedBigInteger to match with organizations' primary key
            $table->unsignedBigInteger('org_id');
            
            // Set foreign key constraint correctly
            $table->foreign('org_id')->references('org_id')->on('organizations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
