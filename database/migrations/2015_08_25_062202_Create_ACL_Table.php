<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateACLTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('acl_permission')) {
            Schema::create('acl_permission', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('group_id');
                $table->string('menu_text', 50);
                $table->string('link', 255);
                $table->string('icon', 100)->nullable();
                $table->string('acl_key', 255);
                $table->smallInteger('parent_menu')->default(0);
                $table->smallInteger('ordering');
                $table->smallInteger('adding')->default(0);
                $table->smallInteger('edit')->default(0);
                $table->smallInteger('view')->default(0);
                $table->smallInteger('trash')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (Schema::hasTable('acl_permission')) {
            Schema::drop('acl_permission');
        }
    }
}
