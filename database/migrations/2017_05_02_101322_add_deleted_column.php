<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('blocks', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
