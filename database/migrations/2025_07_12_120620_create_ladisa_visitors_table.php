<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLadisaVisitorsTable extends Migration
{
    public function up(): void
    {
        Schema::create('ladisa_visitors', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ladisa_visitors');
    }
}
