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
                Schema::create('services', function (Blueprint $table) {

        $table->id();

        $table->foreignId('motorbike_id')->constrained();

        $table->foreignId('contract_id')->constrained();

        $table->text('description');

        $table->decimal('cost');

        $table->date('service_date');

        $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
