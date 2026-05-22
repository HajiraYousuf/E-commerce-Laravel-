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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('email');
            $table->string('avatar')->nullable();
            $table->string('action');
            $table->string('module');
            $table->string('ip')->nullable();
            $table->string('device')->nullable();
            $table->string('status');
            $table->date('date');
            $table->time('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
