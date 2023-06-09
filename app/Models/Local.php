<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Local extends Model
{
    use HasFactory;

    protected $table = "locais";

    protected $fillable = [
        "nome", "endereco", "contato", "descricao", "imagem_local", "user_id"
    ];

    /**
     * Retorna o local cadastrado pelo usuário logado
     *
     * @return HasOne
     */
    public function pertenceAUmUsuario(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Retorna os objetos cadastraoos para um local
     *
     * @return HasMany
     */
    public function possuiNObjetos(): HasMany
    {
        return $this->hasMany(Objeto::class);
    }
}
