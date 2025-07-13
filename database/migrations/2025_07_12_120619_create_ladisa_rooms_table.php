<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLadisaRoomsTable extends Migration
{
    public function up(): void
    {
        Schema::create('ladisa_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('room_type_id')->constrained('ladisa_room_types')->onDelete('cascade');
            $table->string('harga'); // Harga dalam format manual seperti "Rp 525.000 NET/PAX"
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ladisa_rooms');
    }
}
