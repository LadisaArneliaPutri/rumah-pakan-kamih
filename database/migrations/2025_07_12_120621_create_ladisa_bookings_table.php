<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLadisaBookingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('ladisa_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('ladisa_visitors')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('ladisa_rooms')->onDelete('cascade');
            $table->date('checkin');
            $table->date('checkout');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ladisa_bookings');
    }
}
