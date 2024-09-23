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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id')->nullable();
            $table->unsignedBigInteger('circular_id')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('cover_image_id')->nullable();
            $table->string('title', 999)->nullable();
            $table->string('author_name')->nullable();
            $table->date('date')->nullable();
            $table->json('form_data')->nullable();
            $table->string('slug')->nullable();
            $table->json('jury_members')->nullable();
            $table->string('approval_status')->default("Pending"); // Pending, Processing, Reviewed, Published, Draft, Revision
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebooks');
    }
};
