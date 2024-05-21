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
        Schema::create('loss_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loss_id');
            $table->unsignedBigInteger('details_inv_id');
            $table->integer('amount_lost');
            $table->foreign('loss_id')->references('id')->on('losses')->onDelete('cascade');
            $table->foreign('details_inv_id')->references('id')->on('inventory_details')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loss_details');
    }
};
