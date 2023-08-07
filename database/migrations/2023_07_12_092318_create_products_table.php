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
            $table->id();
            $table->string("product_name");
            $table->integer("product_price");
            $table->integer('product_type')->comment('ProductTypeEnum');
            $table->string("product_info");
            $table->string("license_type")->unique();
            $table->string("product_img")->nullable();
            $table->string("product_vid")->nullable();
            $table->string("product_description")->nullable();
            $table->integer("product_view")->default(0);
            $table->integer("product_bought")->default(0);
            $table->foreignId('type_id')->constrained('product_type');
            $table->string('download_url');
            $table->integer("is_show")->default(0);
            $table->foreignId('author_id')->constrained('users');
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
