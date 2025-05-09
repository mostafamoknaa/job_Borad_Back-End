<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('employers')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->Enum('type', ['full-time', 'part-time', 'contract', 'internship', 'temporary', 'freelance']);
            $table->string('title');
            $table->text('description');
            $table->text('responsibilities');
            $table->text('qualifications');
            $table->string('salary_range')->nullable();
            $table->text('benefits')->nullable();
            $table->string('location');
            $table->date('application_deadline');
            $table->enum('status', ['pending', 'approved', 'rejected', 'archived'])->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
