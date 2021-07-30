<?php

use  Illuminate\Database\Eloquent\Model;

class Data extends Model{
  protected $table='data';
  protected $fillable=['idRecord','code','startDate','endDate','nr1','percent','nr2','expireDate'];
}
