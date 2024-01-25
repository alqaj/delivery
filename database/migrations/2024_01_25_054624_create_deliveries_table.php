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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->bigInteger('destinasi_id');
            $table->string('destinasi',50);
            $table->string('dock',50);
            $table->string('cycle',2);
            $table->string('logistic',50);
            $table->timestamp('start');
            $table->timestamp('end')->nullable();
            $table->integer('total_delivery')->default(0);
            $table->string('photo',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
