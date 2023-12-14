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
        Schema::create('tokos', function (Blueprint $table) {
            $table->id()->comment('id');
            $table->string('nama_toko', 60)->comment('nama toko');
            $table->string('kode_toko', 6)->comment('kode toko');
            $table->string('alamat_toko', 50)->comment('alamat toko');
            $table->enum('status', ['Active','Inactive'])->default('Active')->comment('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokos');
    }
};
