<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table
                ->foreign('gym_id')
                ->references('id')
                ->on('gyms')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('trainer_id')
                ->references('id')
                ->on('trainers')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['gym_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['trainer_id']);
        });
    }
};
