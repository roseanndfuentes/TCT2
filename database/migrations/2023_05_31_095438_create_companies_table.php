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
        Schema::create('companies', function (Blueprint $table) {
            
            $table->id();
            $table->string('logo')->nullable();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->boolean('basic_document_due_diligence')->default(true);
            $table->boolean('data_validation')->default(true);
            $table->string('per_company_in_review_amount')->default('51');
            $table->string('per_unit_work_amount')->default('25');
            $table->string('minimum_consumable_fee')->default('1800');
            $table->string('dvr_one')->default('9'); //1-60
            $table->string('dvr_two')->default('7.50'); //61-150
            $table->string('dvr_three')->default('6'); //151-400
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
