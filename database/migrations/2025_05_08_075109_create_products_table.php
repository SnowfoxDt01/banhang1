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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_category_id')->comment('ID danh mục sản phẩm');
            $table->string('name', 250);
            $table->text('description')->nullable()->comment('Mô tả sản phẩm');
            $table->bigInteger('base_price')->default(0)->comment('Giá chưa giảm của sản phẩm');
            $table->bigInteger('sale_price')->default(0)->comment('Giá đã giảm của sản phẩm');
            $table->boolean('is_new')->default(0)->comment('0: Hàng mới, 1: Hàng còn trong kho');
            $table->integer('view')->default(0)->comment('Số lượt xem sản phẩm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
