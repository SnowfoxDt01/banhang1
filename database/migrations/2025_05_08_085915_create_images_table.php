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
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->comment('ID sản phẩm');
            $table->unsignedInteger('variant_product_id')->nullable()->comment('ID biến thể sản phẩm');
            $table->string('image')->comment('Đường dẫn đến hình ảnh');
            $table->string('alt')->nullable()->comment('Mô tả hình ảnh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
