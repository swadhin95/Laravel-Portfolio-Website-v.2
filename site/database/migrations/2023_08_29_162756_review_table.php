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
            
Schema::create('review',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name',length:200);
            $table->string('des',length:2000);
            $table->string('img',length:500);
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
