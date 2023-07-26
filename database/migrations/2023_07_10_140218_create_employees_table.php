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
            $table->string('name', 64);
            $table->string('email')->unique();
            $table->string('position', 64);
            $table->date('birthday');
            $table->string('address', 128);
            $table->string('address2', 128)->nullable();
            $table->string('city', 64);
            $table->string('country', 64);
            $table->string('cp', 16);
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
