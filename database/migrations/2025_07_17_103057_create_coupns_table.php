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
        Schema::create('coupns', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->unique();
            $table->integer('discount');
            $table->integer('get')->default(1);
            $table->integer('fixed_price');
            $table->string('user_id', 150)->default('');
            $table->timestamp('expire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupns');
    }
};
