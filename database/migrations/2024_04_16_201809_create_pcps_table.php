<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */

    public function up(): void
    {
        Schema::create('pcps', function (Blueprint $table) {
            $table->id();
            $table->string('registrationNumber')->nullable();
            $table->string('taxStatus')->nullable();
            $table->string('taxDueDate')->nullable();
            $table->string('motStatus')->nullable();
            $table->string('make')->nullable();
            $table->string('yearOfManufacture')->nullable();
            $table->string('engineCapacity')->nullable();
            $table->string('co2Emissions')->nullable();
            $table->string('fuelType')->nullable();
            $table->string('markedForExport')->nullable();
            $table->string('colour')->nullable();
            $table->string('typeApproval')->nullable();
            $table->string('dateOfLastV5CIssued')->nullable();
            $table->string('motExpiryDate')->nullable();
            $table->string('wheelplan')->nullable();
            $table->string('monthOfFirstRegistration')->nullable();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('vehicle_value')->nullable();
            $table->string('owned_since')->nullable();
            $table->string('pcp_taken_out')->nullable();
            $table->string('dealers_name')->nullable();
            $table->string('lenders_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcps');
    }
};
