<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Objeto extends Model
{
    use HasFactory;

    protected $fillable = ["nome", "descricao", "entregue", "local_id", "imagem_objeto"];

    /**
     * Retorna uma lista de objetos cadastrados para um local
     *
     * @return BelongsTo
     */
    public function pertenceAUmLocal(): BelongsTo
    {
        return $this->belongsTo(Local::class);
    }
}
