<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetRegistersTable extends Migration
{
    public function up()
    {
        Schema::create('asset_register', function (Blueprint $table) {
            $table->id(); // Automatically creates an unsignedBigInteger primary key called 'id'
            $table->foreignId('project_id')->nullable()->constrained('projects', 'prj_id')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users', 'user_id')->cascadeOnDelete();
            $table->string('asset_name');
            $table->text('asset_desc')->nullable();
            $table->string('asset_serial_no');
            $table->enum('asset_category', ['Process', 'Data & Information', 'Hardware', 'Software', 'Service', 'People', 'Premise']);
            $table->integer('asset_qty')->default(1);
            $table->string('asset_owner');
            $table->string('asset_location')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asset_register');
    }
}
