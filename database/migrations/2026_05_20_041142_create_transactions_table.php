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
         Schema::create('transactions', function (Blueprint $table) {

            $table->id();
            $table->string('transaction_id')->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_avatar')->nullable();
            $table->string('product_name');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->string('status')->default('Pending');
            $table->timestamp('transaction_date');
            $table->timestamps();
            $table->index('transaction_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
