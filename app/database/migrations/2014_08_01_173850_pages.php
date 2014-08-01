<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4kacd_pages', function(Blueprint $table)
		{
			// Create table
			$table->create();
			
			// Table schema
			$table->increments('id');
			$table->integer('chapter_id')->unsigned();
			$table->integer('page_number')->unsigned();
			$table->text('title');
			$table->text('content');
			$table->text('style');
				
			// Foreign Keys
			$table->foreign('chapter_id')->references('id')->on('t4kacd_chapters');
				
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
		Schema::table('t4kacd_pages', function(Blueprint $table)
		{
			// Undo changes
			$table->drop();
		});
	}

}
