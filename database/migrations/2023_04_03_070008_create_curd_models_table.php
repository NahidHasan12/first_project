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
        Schema::create('curd_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('roll')->nullable();
            $table->string('reg')->nullable();
            $table->string('department')->nullable();
            $table->string('number');
            $table->string('mail');
            $table->string('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curd_models');
    }
};
