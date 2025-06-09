<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePaymentStatusEnumInPaymentsTable extends Migration
{
    public function up(): void
    {
        // Nếu cột cũ không phải enum, bạn nên drop và tạo lại
        Schema::table('shop_order', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });

        Schema::table('shop_order', function (Blueprint $table) {
            $table->enum('payment_status', [
                'confirming',
                'confirmed',
                'preparing',
                'shipping',
                'delivered',
                'completed',
                'canceled',
                'pending'
            ])->default('pending');
        });
    }

    public function down(): void
    {
        Schema::table('shop_order', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });

        Schema::table('shop_order', function (Blueprint $table) {
            $table->string('payment_status')->default('pending');
        });
    }
}
