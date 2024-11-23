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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->enum('property_category',['apartment','land'])->nullable();
            $table->enum('sale_type',['sell','rent'])->nullable();
            $table->string('asset_location')->nullable();
            $table->enum('ad_provider_role', ['admin','agent'])->default('admin');
            $table->string('co_ordinates')->nullable();
            $table->string('asset_status')->default('deactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
