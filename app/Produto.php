<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['produto_nome', 'produto_descricao', 'produto_preco'];
    protected $guarded = ['produto_id', 'created_at', 'updated_at'];
    protected $table = 'produtos';
    protected $primaryKey = 'produto_id';
}
