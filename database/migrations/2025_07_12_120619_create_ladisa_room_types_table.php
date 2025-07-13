<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLadisaRoomTypesTable extends Migration
{
    public function up(): void
    {
        Schema::create('ladisa_room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // contoh: Deluxe, Standard
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ladisa_room_types');
    }
}
