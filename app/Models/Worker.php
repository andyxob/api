<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $table = "workers";
    protected $fillable = [
        'name',
        'surname',
        'shop',
        'journal'];



    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public  function journal(){
        return $this->hasOne(Journal::class);
    }
}
