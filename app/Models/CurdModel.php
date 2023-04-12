<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurdModel extends Model
{
    use HasFactory;
    /**
     * This attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded=[];
}
