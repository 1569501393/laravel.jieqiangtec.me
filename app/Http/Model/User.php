<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Http\Model
 */
class User extends Model
{
    protected $table="user";
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}
