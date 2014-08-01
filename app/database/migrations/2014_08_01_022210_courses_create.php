<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoursesCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4kacd_courses', function(Blueprint $table)
		{
			// Create table
		    $table->create();
		     
		    // Table schema
		    $table->increments('id');
			$table->integer('subject_id')->unsigned();
			$table->integer('course_type_id')->unsigned();
			$table->integer('class');
			$table->boolean('is_private');
			$table->text('title');
			$table->text('desc');
					     
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
		Schema::table('t4kacd_courses', function(Blueprint $table)
		{
			// Undo changes
			$table->drop();
		});
	}

}
