<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetos', function (Blueprint $table) {
            $table->id();

            $table->string("nome", 255);
            $table->string("descricao", 255);
            $table->smallInteger("entregue");
            $table->text("imagem_objeto")->nullable();
            $table->unsignedBigInteger("local_id");
            $table->string("dono_nome", 255)->nullable();
            $table->string("dono_cpf", 255)->nullable();

            $table
                ->foreign("local_id")
                ->references("id")
                ->on("locais")
                ->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objetos');
    }
};
