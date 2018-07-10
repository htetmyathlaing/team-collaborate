<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','group_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
