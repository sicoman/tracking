<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Location.
 *
 * @package namespace App\Entities;
 */
class Location extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'locations';

    //protected $guard = 'driver';

    protected $geometry = ['location'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'driver_id',
        'location',
        'time',
        'insertion_id'
    ];

    public function setIdAttribute()
    {
        $this->id = self::getID();
    }

    private static function getID()
    {
        $seq = DB::getCollection('counters')->findOneAndUpdate(
            ['id' => 'id'],
            ['$inc' => ['seq' => 1]],
            ['new' => true, 'upsert' => true, 'returnDocument' => FindOneAndUpdate::RETURN_DOCUMENT_AFTER]
        );
        return $seq->seq;
    }

}
