<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{
    use HasFactory;

    protected $fillable = ["nome", "descricao", "entregue", "local_id", "imagem_objeto"];

    public function pertenceAUmLocal()
    {
        return $this->belongsTo(Local::class);
    }
}
