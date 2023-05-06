<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('text');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('number_of_likes')->nullable();
            $table->string('user_image')->nullable()->default(null);
            $table->string('image')->nullable();
            $table->dateTime('time')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
