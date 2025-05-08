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
        Schema::create('variant_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->comment('ID sản phẩm');
            $table->string('name', 250)->comment('Tên biến thể sản phẩm');
            $table->integer('quantity')->default(0)->comment('Số lượng sản phẩm trong kho');
            $table->unsignedInteger('color_id')->comment('ID màu sắc');
            $table->unsignedInteger('size_id')->comment('ID kích thước');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_products');
    }
};
