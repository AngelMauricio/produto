<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\ProdutoImagem;

class ProdutoImagemController extends Controller
{
    static function getFromProduct($product) {
        return ProdutoImagem::where('produto_id', $product->produto_id)->get();
    }

    public function store($produto_id, $file)
    {
        $newName = uniqid() . '.' . $file->getClientOriginalExtension();;
        Storage::put(
            'produtos/'.$produto_id,
            $file->storeAs('public/produtos', $newName)
        );

        $image = new ProdutoImagem;
        $image->produto_id = $produto_id;
        $image->imagem_arquivo = $newName;
        \Log::info($produto_id);
        \Log::info($newName);
        $image->save();
    }

    static function destroy($id)
    {
        $image = ProdutoImagem::findOrFail($id);
        $image->delete();
    }
}
