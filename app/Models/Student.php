<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;



class Student extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable  = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'phone_number',
        'class',
        'gender'
    ];

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function homework()
    {
        return $this->belongsToMany(Homework::class);
    }

    //get jwt identifier
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
