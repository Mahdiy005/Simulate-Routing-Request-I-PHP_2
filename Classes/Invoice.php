<?php

namespace App\Classes;

class Invoice
{

  public static function index(): string {
    return 'index from invoice';
  }

  public static function create(): string {
    return 'Create invoice';
  }
}
