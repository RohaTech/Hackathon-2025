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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('email')->unique();
            $table->enum('employement_type', ['full_time', 'part_time']);
            $table->enum('position', ['ceo','coo','cto','ciso','director','dept_lead','normal_employee']);
            $table->string('employement_date');
            $table->decimal('basic_salary', 10, 2);
            $table->foreignId('bank_account_id')->constrained('accounts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
