<?php

use  Illuminate\Database\Eloquent\Model;

class Audit extends Model{
  protected $table='audits';
  protected $fillable=['username','role','action'];
}