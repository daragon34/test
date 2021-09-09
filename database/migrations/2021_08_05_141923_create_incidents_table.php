<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('prioridad', 1);//un único caracter para enviar a la BD.            
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('category_id')->nullable();            
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');            
            $table->unsignedBigInteger('project_id')->nullable();  ;            
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('level_id')->nullable();            
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->unsignedBigInteger('client_id');            
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');//quien atiende la incidencia
            $table->unsignedBigInteger('support_id')->nullable();  ;            
            $table->foreign('support_id')->references('id')->on('users')->onDelete('cascade');//quien registra la incidencia
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
        Schema::dropIfExists('incidents');
    }
}
