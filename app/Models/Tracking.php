<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MongoDB\Operation\FindOneAndUpdate;

class Tracking extends Model
{
    protected $geometry = ['location'];

    protected $fillable = [
        'id',
        'driver_id',
        'location',
        'created_at',
        'updated_at'
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
