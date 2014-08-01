<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoursesCreatefk extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4kacd_courses', function(Blueprint $table)
		{
			// Table Schema
			$table->foreign('subject_id')->references('id')->on('t4kacd_subjects');
			$table->foreign('course_type_id')->references('id')->on('t4kacd_course_type');
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
			// Undo Changes
			$table->dropForeign('t4kacd_courses_subject_id_foreign');
			$table->dropForeign('t4kacd_courses_course_type_id_foreign');
		});
	}

}
