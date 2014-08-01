<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chapters extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4kacd_chapters', function(Blueprint $table)
		{
			// Create table
			$table->create();
			 
			// Table schema
			$table->increments('id');
			$table->integer('course_id')->unsigned();
			$table->integer('chapter_number')->unsigned();
			$table->text('title');
			$table->text('summary');
			
			// Foreign Keys
			$table->foreign('course_id')->references('id')->on('t4kacd_courses');
			
			// Table administration
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
		Schema::table('t4kacd_chapters', function(Blueprint $table)
		{
			// Undo changes
			$table->drop();
		});
	}

}
