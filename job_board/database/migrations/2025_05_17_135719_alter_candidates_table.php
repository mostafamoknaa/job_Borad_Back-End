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
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('Nationality')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('bio')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('image');
            $table->dropColumn('Nationality');
            $table->dropColumn('gender');
            $table->dropColumn('marital_status');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('bio');
        });
    }
};
