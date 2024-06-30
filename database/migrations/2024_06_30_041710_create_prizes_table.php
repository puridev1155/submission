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
        Schema::create('prizes', function (Blueprint $table) {
            $table->id();
            $table->integer('vol')->nullable();
            $table->string('award')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->char('phone', 13)->unique();
            $table->string('wip')->nullable();
            $table->integer('agree')->default(1);
            $table->integer('success')->default(0);
            $table->integer('counts')->nullable(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prizes');
    }
};
