<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_name');
            $table->timestamps();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_text');
            $table->string('menu_icon')->nullable();
            $table->integer('menu_parent')->nullable()->default(0);
            $table->string('menu_url')->default('#');
            $table->string('menu_classname')->nullable();
            $table->integer('menu_order')->nullable();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->timestamps();
            $table->primary(['menu_id', 'group_id']);
        });

        Schema::table('roles', function ($table) {
            $table->foreign('menu_id')
                    ->references('id')->on('menus')
                    ->onDelete('cascade');
            $table->foreign('group_id')
                    ->references('id')->on('groups')
                    ->onDelete('cascade');
        });

        Schema::table('users', function ($table) {
            $table->foreign('group_id')
                    ->references('id')->on('groups')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function ($table) {
            $table->dropForeign(['menu_id']);
            $table->dropForeign(['group_id']);
        });
        Schema::table('users', function ($table) {
            $table->dropForeign(['group_id']);
        });
        Schema::drop('roles');
        Schema::drop('groups');
        Schema::drop('menus');
    }
}
