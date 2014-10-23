<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4kacd_tracks', function(Blueprint $table)
		{
			// Create table
			$table->create();
			 
			// Table schema
			$table->increments('id');
			$table->integer('subject_id')->unsigned();
			$table->string('title');
			$table->integer('number');
			
			// Foreign keys & indexes
			$table->foreign('subject_id')->references('id')->on('t4kacd_subjects');
			
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
		Schema::table('t4kacd_tracks', function(Blueprint $table)
		{
			// Undo changes
			$table->drop();
		});
	}

}
