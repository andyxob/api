<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $table =  'journals';

    protected $fillable = ['content'];



    public function worker(){
        return $this->belongsTo(Worker::class);

}
}
