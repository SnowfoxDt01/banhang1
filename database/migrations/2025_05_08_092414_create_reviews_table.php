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
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->comment('ID sản phẩm');
            $table->unsignedInteger('user_id')->comment('ID người dùng');
            $table->integer('rating')->default(0)->comment('Đánh giá sản phẩm từ 1 đến 5');
            $table->text('comment')->nullable()->comment('Nhận xét của người dùng về sản phẩm');
            $table->boolean('is_approved')->default(0)->comment('0: Chưa duyệt, 1: Đã duyệt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
