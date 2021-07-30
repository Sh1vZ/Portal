<?php

require '../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropIfExists('admins');
Capsule::schema()->create('admins', function ($table) {
  $table->increments('id');
  $table->string('username')->unique();
  $table->string('password');
  $table->timestamps();
});

Capsule::schema()->dropIfExists('users');
Capsule::schema()->create('users', function ($table) {
  $table->increments('id');
  $table->string('username')->unique();
  $table->string('password');
  $table->timestamps();
});

Capsule::schema()->dropIfExists('data');
Capsule::schema()->create('data', function ($table) {
  $table->increments('id');
  $table->integer('idRecord');
  $table->string('code');
  $table->date('startDate');
  $table->date('endDate');
  $table->integer('nr1');
  $table->string('percent')->default('%');
  $table->integer('nr2');
  $table->date('expireDate');
  $table->timestamps();
});