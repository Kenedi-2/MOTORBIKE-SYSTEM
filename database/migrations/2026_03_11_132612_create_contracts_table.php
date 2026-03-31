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
                Schema::create('contracts', function (Blueprint $table) {

        $table->id();

        $table->foreignId('motorbike_id')->constrained();

        $table->foreignId('driver_id')->constrained();

        $table->foreignId('sponsor_id')->constrained();

        $table->date('start_date');

        $table->date('end_date');

        $table->decimal('daily_amount');

        $table->decimal('total_amount');

        $table->decimal('remaining_amount');

        $table->enum('status',['active','finished'])->default('active');

        $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
