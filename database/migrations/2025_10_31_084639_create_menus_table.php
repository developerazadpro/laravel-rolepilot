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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Display name e.g., Dashboard, Users
            $table->string('route')->nullable(); // route name e.g., users.index
            $table->string('icon')->nullable(); // optional SVG or class
            $table->foreignId('parent_id')->nullable()->constrained('menus')->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->string('permission_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
