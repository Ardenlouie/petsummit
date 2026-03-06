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
        Schema::create('summit_2026_test', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('control_number')->unique();
            $table->json('pets')->nullable();
            $table->text('spend')->nullable();
            $table->json('store')->nullable();
            $table->text('bath')->nullable();
            $table->json('product')->nullable();
            $table->json('brand')->nullable();
            $table->json('switch')->nullable();
            $table->integer('attendance')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summit_2026_test');
    }
};
