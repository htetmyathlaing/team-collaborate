<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_title','file_name','file_type','user_id', 'group_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
