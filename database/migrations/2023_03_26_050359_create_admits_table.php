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
        Schema::create('admits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mail');
            $table->string('phone');
            $table->string('roll')->nullable();
            $table->string('reg')->nullable();
            $table->string('board')->nullable();
            $table->string('session')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admits');
    }
};
