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
        Schema::create('returs', function (Blueprint $table) {
            $table->id()->comment('id');
            $table->foreignId('id_toko')->comment('id toko')->constrained('tokos')->onUpdate('cascade');
            $table->foreignId('no_faktur')->comment('nomor faktur')->constrained('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_retur', 12)->comment('nomor retur');
            $table->date('tanggal')->comment('tanggal');
            $table->string('alasan_retur', 15)->nullable()->comment('alasan retur');
            $table->string('note', 100)->nullable()->comment('note');
            $table->integer('total')->comment('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returs');
    }
};
