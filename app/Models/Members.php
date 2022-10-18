<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Group;


class Members extends Model
{
    use HasFactory;
    protected $table = 'member';
    protected $primaryKey = 'id';

    public function getGroup(){

        // return $this->hasOne('App\Models\Group', 'id');
           return $this->hasOne(Group::class, 'id');
        // return $this->hasOne(Phone::class);
    }
}
