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
        Schema::create('repair_spare_part', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repair_id');
            $table->unsignedBigInteger('spare_part_id');
            $table->integer('quantity');
            $table->foreign('repair_id')->references('id')->on('repairs')->onDelete('cascade');
            $table->foreign('spare_part_id')->references('id')->on('sparePart')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_spare_part');
    }
};
