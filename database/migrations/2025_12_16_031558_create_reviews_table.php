<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->string('id', 20)->primary(); 
            // Ganti foreignId menjadi string
            $table->string('intern_id', 20);
            $table->foreign('intern_id')->references('id')->on('interns')->onDelete('cascade');
            
            $table->string('nama_reviewer');
            $table->string('asal_kampus');
            $table->date('tgl_review');
            $table->integer('rating')->default(5);
            $table->text('content');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};