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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');

            // Form fields (from view)
            $table->tinyInteger('rating')->unsigned()->comment('1–5 stars');
            $table->string('name');                     // reviewer display name
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->text('review');                     // review body

            // Media (stored as JSON array of file paths)
            $table->json('media')->nullable();          // images / videos

            // Moderation
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};