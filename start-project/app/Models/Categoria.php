<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    // Relacionamento com os gastos
    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }
}
