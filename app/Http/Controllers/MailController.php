<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
  public function send()
  {
    Mail::send(['text' => 'mail'], ['name' => 'Yabu'], function($message) {

      $message->to('yammo0051@gmail.com', 'to Yabu')->subject('test');
      $message->from('yammo0051@gmail.com', 'to Yabu');

    });
  }
}
