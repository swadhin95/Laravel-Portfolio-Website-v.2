<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('project_name');
	        $table->string('project_des');
            $table->string('project_link');
            $table->string('project_img');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
