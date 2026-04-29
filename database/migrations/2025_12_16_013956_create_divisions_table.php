<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // fungsi untuk buat table database
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('nama_divisi');              // Nama Bagian/kompetensi
            $table->string('competency')->nullable();
            $table->string('icon_type')->default('admin');
            $table->string('color_scheme')->default('blue');
            $table->integer('total_quota')->default(0);
            $table->integer('used_quota')->default(0);
            $table->date('updated_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};