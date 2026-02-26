<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // siapa yang buat order
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // bukti pembayaran
            $table->string('payment_proof');

            // total keseluruhan order
            $table->decimal('total', 15, 2);

            // status default
            $table->string('status')
                ->default('Menunggu Konfirmasi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
