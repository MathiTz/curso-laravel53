<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Product;

class ProdutoController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos produtos';

        $products = $this->product->all();

        return view('painel.products.index', compact('products', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar novo produto';

        $categories = ['eletronicos', 'moveis','limpeza', 'banho'];

        return view('painel.products.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* dd($request->all());
        dd($request->only(['name', 'number']));
        dd($request->except(['_token', 'category']));
        dd($request->input('name')); */

        $dataForm = $request->all();

        $dataForm['active'] = !isset($dataForm['active']) ? 0 : 1;

        $this->validate($request, $this->product->rules);

        $insert = $this->product->create($dataForm);

        if($insert)
        {
            return redirect()->route('produtos.index');
        } else
        {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tests()
    {
        /*
        $insert = $this->product->create([
            'name'          => 'Nome do produto2',
            'number'        => 123456,
            'active'        => false,
            'category'      => 'eletronicos',
            'description'   => 'Description vem aqui',
        ]);

        if($insert){
            return 'Inserido com sucesso';
        } else {
            return ' Fala ao inserir';
        }
        */



        /*$prod = $this->product;
        $prod->name = 'Nome do Produto';
        $prod->number = 123123;
        $prod->active = true;
        $prod->category = 'eletronicos';
        $prod->description = 'Description do produto aqui';
        $insert = $prod->save();
        if($insert){
            return 'Inserido com sucesso';
        } else {
            return ' Fala ao inserir';
        }*/
        /*
        $prod = $this->product->findOrFail(5);
        $prod->name = 'Update';
        $prod->number = 79789;
        $prod->active = true;
        $prod->category = 'eletronicos';
        $prod->description = 'DescUpdate';
        $update = $prod->save();
        if($update){
            return 'Atualizado com sucesso';
        } else {
            return ' Falha ao atualizar';
        }
        */

        $update = $this->product->where('number', 123456)->update([
            'name'          => 'Nome do update',
            'number'        => 123456,
            'active'        => false,
            'category'      => 'eletronicos',
            'description'   => 'Description vem aqui',
        ]);
        if($update){
            return 'Atualizado com sucesso2';
        } else {
            return ' Falha ao atualizar';
        }


    }
}
