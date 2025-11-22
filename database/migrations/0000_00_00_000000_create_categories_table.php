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
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('parent_id')->constrained('categories', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('icon')->nullable()->default('fa fa-sitemap');
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['parent_id', 'name'], 'categories_unique');
        });

        Schema::create('categorizables', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('category_id');
            $table->uuidMorphs('categorizable');
            $table->timestamps();

            $table->unique(['category_id', 'categorizable_type', 'categorizable_id'], 'categorizable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorizables');
        Schema::dropIfExists('categories');
    }
};
