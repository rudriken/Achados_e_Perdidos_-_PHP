<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
	use HasFactory;

	protected $table = "locais";

	protected $fillable = [
		"nome", "endereco", "contato", "descricao", "imagem_local", "user_id"
	];

	public function pertenceAUmUsuario()
	{
		return $this->hasOne(User::class);
	}

	public function possuiNObjetos()
	{
		return $this->hasMany(Objeto::class);
	}
}
