<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('best_selling')->default(false);

            // 5 images
            $table->string('img_1')->nullable();
            $table->string('img_2')->nullable();
            $table->string('img_3')->nullable();
            $table->string('img_4')->nullable();
            $table->string('img_5')->nullable();

            // 5 category foreign keys
            $table->unsignedBigInteger('category_1_id')->nullable();
            $table->unsignedBigInteger('category_2_id')->nullable();
            $table->unsignedBigInteger('category_3_id')->nullable();
            $table->unsignedBigInteger('category_4_id')->nullable();
            $table->unsignedBigInteger('category_5_id')->nullable();


            $table->unsignedBigInteger('subcategory_1_id')->nullable();
            $table->unsignedBigInteger('subcategory_2_id')->nullable();
            $table->unsignedBigInteger('subcategory_3_id')->nullable();
            $table->unsignedBigInteger('subcategory_4_id')->nullable();
            $table->unsignedBigInteger('subcategory_5_id')->nullable();


            $table->text('features')->nullable();
            $table->text('specification')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();


            for ($i = 1; $i <= 5; $i++) {
                $table->foreign("category_{$i}_id")->references('id')->on('categories')->onDelete('set null');
                $table->foreign("subcategory_{$i}_id")->references('id')->on('subcategories')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
