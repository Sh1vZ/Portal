<?php

use  Illuminate\Database\Eloquent\Model;

class Admin extends Model{
  protected $table='admins';
  protected $fillable=['username','password'];
}

