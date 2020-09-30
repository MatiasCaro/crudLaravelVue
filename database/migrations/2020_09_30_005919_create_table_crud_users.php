<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCrudUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_crud_users', function (Blueprint $table) {
            $table->id();
            $table->string('rut', 12);
            $table->string('nombre');
            $table->date('f_naci');
            $table->string('genero', 1);
            $table->string('email');
            $table->integer('fono');
            $table->string('direccion');
            $table->string('region');
            $table->string('comuna');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_crud_users');
    }
}
