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
        Schema::create('propertyfeatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('status');
            $table->string('area');
            $table->string('bed');
            $table->string('bath');
            $table->string('garage');
            $table->text('additional_features');
            $table->text('property_description');
            $table->foreign('property_id')->references('id')->on('properties');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('propertyfeatures');
    }
};
