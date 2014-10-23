<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubtracks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4kacd_subtracks', function(Blueprint $table)
		{
			// Create table
			$table->create();
			 
			// Table schema
			$table->increments('id');
			$table->integer('track_id')->unsigned();
			$table->string('title');
			$table->integer('number');
			$table->integer('level')->unsigned();
			
			// Foreign keys & indexes
			$table->foreign('track_id')->references('id')->on('t4kacd_tracks');
			
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
		Schema::table('t4kacd_subtracks', function(Blueprint $table)
		{
			// Undo changes
			$table->drop();
		});
	}

}
