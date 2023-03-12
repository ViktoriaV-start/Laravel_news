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
        Schema::table('news', function (Blueprint $table) {
            $table->foreignId('source_id')->default('1') // имя колонки
            ->after('text') // где расположить новую колонку
            ->constrained('sources'); //с какой таблицей связан

    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign('source_id'); // удаление ключа и столбца
            $table->dropColumn('source_id');
        });
    }
};
