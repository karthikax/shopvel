<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstallTables extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('options', function (Blueprint $table) {
			$table->increments('option_id');
			$table->string('option_name', 64)->unique();
			$table->longText('option_value');
		});

		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('username')->unique();
			$table->string('email')->unique();
			$table->string('password', 64 );
			$table->string('role');
			$table->string('name');
			$table->integer('activated');
			$table->rememberToken();
			$table->timestamps();
		});

		Schema::create('products', function (Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('author');
			$table->string('name')->unique();
			$table->string('title');
			$table->longText('content');
			$table->string('status', 20);
			$table->string('type', 20);
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
		Schema::drop('options');
		Schema::drop('users');
		Schema::drop('products');
	}
}
