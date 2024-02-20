<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotor extends Model
{
    use HasFactory;
    protected $table = 'promotores';

    protected $fillable = [
        'nome',
    ];

    public function promotorias()
    {
        return $this->hasMany(Promotoria::class);
    }
}
