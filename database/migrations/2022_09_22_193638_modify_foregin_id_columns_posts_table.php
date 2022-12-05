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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->dropForeign('posts_photo_id_foreign');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');

            $table->dropForeign('posts_category_id_foreign');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users');

            $table->dropForeign('posts_photo_id_foreign');
            $table->foreign('photo_id')->references('id')->on('photos');

            $table->dropForeign('posts_category_id_foreign');
            $table->foreign('category_id')->references('id')->on('categories');


        });
    }
};
