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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id()->comment('id');
            $table->foreignId('invoice_id')->comment('invoice_id')->constrained('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_barang')->comment('id_barang')->constrained('barangs')->onUpdate('cascade');
            $table->integer('qty')->comment('quantity');
            $table->bigInteger('harga')->comment('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
