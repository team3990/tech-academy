<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCoursesSubtracks extends Migration {

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
			$table->integer('subtrack_id')->unsigned()->after('subject_id')->nullable();
			$table->foreign('subtrack_id')->references('id')->on('t4kacd_subtracks');
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
			$table->dropColumn('subtrack_id');
		});
	}

}
