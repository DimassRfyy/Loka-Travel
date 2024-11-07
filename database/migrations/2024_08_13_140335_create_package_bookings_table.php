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
        Schema::create('package_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('proof');
            $table->foreignId('usersfk')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('packagetoursfk')->references('id')->on('package_tours')->onDelete('cascade');
            $table->foreignId('packagebanksfk')->references('id')->on('package_banks')->onDelete('cascade');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('totalamount');
            $table->unsignedBigInteger('insurance');
            $table->unsignedBigInteger('tax');
            $table->unsignedBigInteger('subtotal');
            $table->boolean('ispaid');
            $table->date('startdate');
            $table->date('enddate');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_bookings');
    }
};
