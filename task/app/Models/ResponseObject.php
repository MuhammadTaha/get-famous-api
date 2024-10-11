<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseObject extends Model
{
    use HasFactory;

    public string $message;
    public bool $error;
    public Object $data;

}
