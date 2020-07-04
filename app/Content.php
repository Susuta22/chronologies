<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Chronology;
use App\User;
use App\Content;

class Content extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'age' => 'integer',
        'event' => 'required|max:1000',
        'chronology_id' => 'required',
        'owner_id' => 'required',
    );
    
    public function chronology()
    {
        return $this->belongsTo(Chronology::class);
    }
    
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
