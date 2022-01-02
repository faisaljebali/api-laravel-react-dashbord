<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emploi', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->integer('isActive')->default(1);
            $table->string('location')->nullable();
            $table->string('skills')->nullable();
            $table->text('description');
            $table->text('tasks')->nullable();
            $table->string('url')->nullable();
            $table->integer('isRemote')->default(0);
            $table->string('min_experience')->nullable();
            $table->integer('numEmp')->default(1);
            $table->string('typeEmploi')->nullable();
            $table->string('typeContrat')->nullable();
            $table->string('experience')->nullable();
            $table->integer('numViewd')->default(0);
            $table->string('info')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->bigInteger('company_id')->unsigned();
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
        Schema::dropIfExists('emploi');
    }
}
