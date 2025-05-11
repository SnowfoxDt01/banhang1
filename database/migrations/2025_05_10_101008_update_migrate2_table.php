<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('variant_products', function (Blueprint $table) {
            $table->decimal('variant_price', 15, 2)->after('product_id')->nullable(); // hoặc không nullable tùy bạn
        });
    }

    public function down()
    {
        Schema::table('variant_products', function (Blueprint $table) {
            $table->dropColumn('variant_price');
        });
    }

};
