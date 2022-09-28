<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLocationsTable.
 */
class CreateLocationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $collection) {
            $collection->increments('id');
            $collection->unsignedBigInteger('driver_id');
            $collection->enum('status', ['Ideal', 'Riding', 'Waiting']);
            $collection->point('location');
            $collection->timestamp('time');
            $collection->uuid('insertion_id');

            $collection->geospatial('location', '2dsphere');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locations');
	}
}
