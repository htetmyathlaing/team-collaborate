<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','user_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->using(UserGroup::class);
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
