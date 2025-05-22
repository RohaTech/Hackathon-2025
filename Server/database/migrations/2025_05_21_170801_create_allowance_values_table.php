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
        Schema::create('allowance_values', function (Blueprint $table) {
            $table->id();
            $table->string('allowances_name');
            $table->decimal('ceo')->nullable();
            $table->decimal('coo')->nullable();
            $table->decimal('cto')->nullable();
            $table->decimal('ciso')->nullable();
            $table->decimal('director')->nullable();
            $table->decimal('dept_lead')->nullable();
            $table->decimal('normal_employee')->nullable();
            $table->decimal('positioned')->nullable();
            $table->decimal('non_positioned')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowance_values');
    }
};
