<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id') // имя колонки
            ->constrained('categories') //с какой таблицей связан
            ->cascadeOnDelete(); // каскадное удаление
            $table->string('title', 255);
            $table->boolean('isPrivate')->default(false);
            $table->enum('status', ['active', 'blocked', 'draft'])->default('active');
            $table->string('image')->nullable(true);
            $table->text('text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
};
