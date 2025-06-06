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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250)->comment('Tên danh mục sản phẩm');
            $table->text('description')->nullable()->comment('Mô tả danh mục sản phẩm');
            $table->string('image')->nullable()->comment('Hình ảnh đại diện cho danh mục sản phẩm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
