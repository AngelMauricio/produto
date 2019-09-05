<?php

namespace App;

use Storage;
use Illuminate\Database\Eloquent\Model;

class ProdutoImagem extends Model
{
    protected $fillable = ['produto_id', 'imagem_arquivo'];
    protected $guarded = ['imagem_id', 'created_at', 'updated_at'];
    protected $table = 'produto_imagens';
    protected $primaryKey = 'imagem_id';

    public function delete() {
        Storage::delete('produtos/' . $this->imagem_arquivo);
        return parent::delete();
    }
}
