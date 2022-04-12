<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';

    protected $fillable = ['name', 'department'];



    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function workers(){
        return $this->hasMany(Worker::class);
    }

}
