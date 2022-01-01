<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('domaine')->nullable();
            $table->string('description')->nullable();
            $table->string('url')->nullable();
            $table->string('logo')->nullable();
            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->string('lat')->nullable();
            $table->string('lag')->nullable();
            $table->string('country')->nullable();
            $table->string('yearStart')->nullable();
            $table->integer('numberOfEmployees')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->integer('isPublic')->default(1);
            $table->string('industry_id')->nullable();
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
        Schema::dropIfExists('company');
    }
}
