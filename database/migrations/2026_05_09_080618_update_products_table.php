<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {



            $table->string('slug')
    ->nullable()
    ->unique()
    ->after('name');

            $table->boolean('is_active')
                ->default(true)
                ->after('price');

            $table->integer('stock')
                ->default(0)
                ->after('is_active');

            $table->json('gallery')
                ->nullable()
                ->after('image');

            $table->softDeletes();

        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn([
                'slug',
                'is_active',
                'stock',
                'gallery',
                'deleted_at',
            ]);

        });
    }
};;
