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
        Schema::create('banners', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->enum('placement', ['homepage_hero', 'homepage_secondary', 'category_page', 'all_products', 'checkout']);
        $table->string('image');
        $table->enum('status', ['active', 'draft', 'inactive'])->default('active');
        $table->unsignedTinyInteger('sort_order')->default(0);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
