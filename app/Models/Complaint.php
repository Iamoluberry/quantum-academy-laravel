<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
      'first_name',
      'last_name',
      'email',
      'phone_number',
      'reason_for_complaint',
        'description'
    ];


}
