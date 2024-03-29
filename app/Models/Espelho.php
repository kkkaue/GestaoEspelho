<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espelho extends Model
{
    use HasFactory;

    protected $table = 'espelhos';

    protected $fillable = [
        'periodo_inicio',
        'periodo_fim',
    ];

    /**
     * Converte o id para string
     * @param $value
     * @return string
     */
    public function getIdAttribute($value)
    {
        return (string)$value;
    }

    /**
     * Busca as promotorias vinculadas ao espelho
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promotorias(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Promotoria::class);
    }
}
