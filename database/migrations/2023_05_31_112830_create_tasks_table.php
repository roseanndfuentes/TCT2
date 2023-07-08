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
        Schema::create('tasks', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('segment_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('is_document_review_reference')->default(false);
            $table->boolean('count_per_company_review')->default(false);
            $table->boolean('review_starter')->default(false);
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
