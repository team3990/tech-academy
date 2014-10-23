<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCoursesNumber extends Migration {

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
			$table->integer('number')->after('title');
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
			$table->dropColumn('number');
		});
	}

}
