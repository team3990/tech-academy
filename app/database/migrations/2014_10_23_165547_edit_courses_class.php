<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCoursesClass extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4kacd_courses', function(Blueprint $table)
		{
			// Edit table schema
			$table->dropColumn('class');
			$table->dropColumn('subject_id');
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
			$table->integer('class');
		});
	}

}
