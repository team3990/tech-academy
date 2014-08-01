<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourseUserCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4kacd_course_user', function(Blueprint $table)
		{
			// Create table
		    $table->create();
		     
		    // Table schema
		    $table->increments('id');
			$table->integer('course_id')->unsigned();
			$table->integer('user_id')->unsigned();
			
			// Foreign Keys
			$table->foreign('course_id')->references('id')->on('t4kacd_courses');
			$table->foreign('user_id')->references('id')->on('t4kglo_users');
					     
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
		Schema::table('t4kacd_course_user', function(Blueprint $table)
		{
			// Undo Changes
			$table->drop();
		});
	}

}
