<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Item extends Model
{
    public $fillable = ['user_id', 'long_url', 'short_code'];
}