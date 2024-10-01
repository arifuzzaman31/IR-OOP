<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircularTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('circular', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->integer('template_id')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->json('jury_members')->nullable();
            $table->unsignedInteger('cover_image_id')->nullable();
            $table->date('deadline')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circular');
    }
};
