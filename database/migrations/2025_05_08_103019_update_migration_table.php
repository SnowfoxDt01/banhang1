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
        // Thêm khóa ngoại từ bảng products → product_categories
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('product_category_id')
                  ->references('id')
                  ->on('product_categories')
                  ->onDelete('cascade');
        });

        // Thêm khóa ngoại từ bảng variant_products → products, colors, sizes
        Schema::table('variant_products', function (Blueprint $table) {
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');

            $table->foreign('color_id')
                  ->references('id')
                  ->on('colors')
                  ->onDelete('cascade');

            $table->foreign('size_id')
                  ->references('id')
                  ->on('sizes')
                  ->onDelete('cascade');
        });

        // Thêm khóa ngoại từ bảng images → products, variant_products
        Schema::table('images', function (Blueprint $table) {
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');

            $table->foreign('variant_product_id')
                  ->references('id')
                  ->on('variant_products')
                  ->onDelete('cascade');
        });

        // Thêm khóa ngoại từ bảng reviews → users, products
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
        });

        // Thêm cột role vào bảng users
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('role')
                  ->default(1)
                  ->comment('0: Admin, 1: Client')
                  ->after('password');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Gỡ bỏ khóa ngoại trước khi rollback cột
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_category_id']);
        });

        Schema::table('variant_products', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['color_id']);
            $table->dropForeign(['size_id']);
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['variant_product_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }

};
