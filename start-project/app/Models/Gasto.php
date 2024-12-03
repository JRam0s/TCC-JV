<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    protected $fillable = ['categoria_id', 'valor', 'descricao'];

    // Relacionamento com a categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class, 'fpagamento_id', 'id');
    }


}
