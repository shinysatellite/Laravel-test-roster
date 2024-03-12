<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('dc')->nullable();
            $table->integer('ci')->nullable();
            $table->integer('co')->nullable();
            $table->string('activity');
            $table->string('remark');
            $table->string('from');
            $table->string('to');
            $table->string('std');
            $table->string('sta');
            $table->string('ac')->nullable();
            $table->integer('blh')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
