<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {
    use HasFactory;
    protected $table = 'tweets';
    protected $hidden = [ 'number_of_likes' ];
    protected $guarded = [];

}
