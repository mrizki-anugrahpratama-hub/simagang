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
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();

            $table->string('user_id', 20)->nullable()->index(); // Siapa yang ubah
            $table->string('action'); // Create, Update, Delete, Import
            $table->string('subject_type')->nullable(); // Model apa (App\Models\Intern)

            $table->string('subject_id', 20)->nullable()->index(); // ID data yang diubah
            $table->text('description'); // Penjelasan singkat
            $table->json('changes')->nullable(); // Data sebelum & sesudah (Old vs New)
            $table->timestamps();

            // Relasi manual karena user_id adalah string
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_logs');
    }
};
