<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'dob',
        'phone',
        'email',
        'gender'
    ];

    public function getGenderNameAttribute($gender): string
    {
        return $gender==0?'Nam':'Nu';
    }
}
