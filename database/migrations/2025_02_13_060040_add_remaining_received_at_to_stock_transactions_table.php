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
        Schema::table('stock_transactions', function (Blueprint $table) {
            // Kolom 'remaining' hanya berlaku untuk transaksi "Masuk"
            $table->integer('remaining')->default(0)->after('quantity');
            // Kolom 'received_at' untuk menyimpan waktu penerimaan secara lebih detail
            $table->timestamp('received_at')->nullable()->after('remaining');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_transactions', function (Blueprint $table) {
            $table->dropColumn(['remaining', 'received_at']);
        });
    }
};
