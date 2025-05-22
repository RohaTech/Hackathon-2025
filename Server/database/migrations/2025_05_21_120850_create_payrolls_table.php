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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->integer('working_days')->default(0);
            $table->decimal('earned_salary', 10, 2)->default(0);
            $table->json('allowances')->nullable();
            $table->decimal('other_commissions', 10, 2)->default(0);
            $table->decimal('gross_pay', 10, 2)->default(0);
            $table->decimal('taxable_income', 10, 2)->default(0);
            $table->decimal('income_tax', 10, 2)->default(0);
            $table->decimal('employee_pension', 10, 2)->default(0);
            $table->decimal('employer_pension', 10, 2)->default(0);
            $table->decimal('loan_or_penality', 10, 2)->default(0);
            $table->decimal('total_deductions', 10, 2)->default(0);
            $table->string('month');
            $table->decimal('net_pay', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
