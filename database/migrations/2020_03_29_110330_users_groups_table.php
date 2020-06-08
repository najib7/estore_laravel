<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersGroupsTable extends Migration
{

    // 3 tables : users groups, users privileges and table for many to many relationship

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('name');
            $table->boolean('is_admin')->default(0);
        });

        Schema::create('users_privileges', function(Blueprint $table) {
            $table->increments('id');
            $table->string('privilege');
            $table->string('model')->default('other');
        });

        Schema::create('group_privilege', function(Blueprint $table) {
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('privilege_id');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('users_groups')->onDelete('cascade');
            $table->foreign('privilege_id')->references('id')->on('users_privileges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_privilege');
        Schema::dropIfExists('users_privileges');
        Schema::dropIfExists('users_groups');
    }
}
