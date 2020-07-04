<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Chronology;
use App\Contents;

class Chronology extends Model
{
    protected $fillable = ['title', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
