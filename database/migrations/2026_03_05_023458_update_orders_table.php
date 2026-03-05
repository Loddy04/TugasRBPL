<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            // biarkan nullable supaya tidak error
            $table->string('order_code')->nullable()->unique()->after('id');

            $table->enum('status', [
                'pending',
                'accepted',
                'rejected',
                'rekap'
            ])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn('order_code');
        });
    }
};
