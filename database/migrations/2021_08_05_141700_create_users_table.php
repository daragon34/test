<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('rol')->default(2);//0: Admin; 1: Soporte; 2: Cliente.
            $table->unsignedBigInteger('selected_project_id')->nullable();            
            $table->foreign('selected_project_id')->references('id')->on('projects')->onDelete('cascade');            
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->unsignedBigInteger('category_id')->nullable();            
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
