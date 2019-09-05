<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Http\Controllers\ProdutoImagemController;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        \Log::info(__FUNCTION__);
        $produtos = Produto::all();
        return view('list', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info(__FUNCTION__);
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info(__FUNCTION__);
        $product = new Produto;
        $product->produto_nome = $request->produto_nome;
        $product->produto_descricao = $request->produto_descricao;
        $product->produto_preco = preg_replace( '/[^0-9]/', '', $request->produto_preco);
        $product->save();

        if ($request->newFile)
        foreach ($request->newFile as $file) {
            $image = new ProdutoImagemController;
            $image->store($product->produto_id, $file);
        }
        return redirect()->route('produto.index')->with('message', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        \Log::info(__FUNCTION__);
        $product = Produto::findOrFail($id);
        $images = ProdutoImagemController::getFromProduct($product);
        return view('view', compact('product', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        \Log::info(__FUNCTION__);
        $product = Produto::findOrFail($id);
        $images = ProdutoImagemController::getFromProduct($product);
        return view('edit', compact('product', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Log::info(__FUNCTION__);
        $product = Produto::findOrFail($id);
        $product->produto_nome = $request->produto_nome;
        $product->produto_descricao = $request->produto_descricao;
        $product->produto_preco = preg_replace( '/[^0-9]/', '', $request->produto_preco);
        $product->save();

        if ($request->deleteImage)
        foreach ($request->deleteImage as $id => $checked) {
            ProdutoImagemController::destroy($id);
        }

        if ($request->newFile)
        foreach ($request->newFile as $file) {
            $image = new ProdutoImagemController;
            $image->store($id, $file);
        }
        
        return redirect()->route('produto.index')->with('message', 'Produto alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Log::info('destroy');
        $product = Produto::findOrFail($id);
        $images = ProdutoImagemController::getFromProduct($product);

        if ($images)
        foreach ($images as $image) {
            $image->delete();
        }
        
        $product->delete();
        return redirect()->route('produto.index')->with('message', 'Produto excluído com sucesso!');
    }
}
