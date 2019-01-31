<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Product;
use App\Http\Requests\Painel\ProductFormRequest;
use \Validator;
class ProdutoController extends Controller
{
    private $product;
    private $totalPage = 3;

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

        $products = $this->product->paginate($this->totalPage);

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

        return view('painel.products.create-edit', compact('title', 'categories'));
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

        $validator = Validator::make($request->all(), [
            'name'          => 'required|min:3|max:100',
            'number'        => 'required|numeric',
            'category'      => 'required|',
            'description'   => 'min:3|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

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
        $product = $this->product->findOrFail($id);

        $title = 'Produto: '.$product->name;

        return view('painel.products.show', compact('product', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->findOrFail($id);

        $title = 'Editar Produto: '.$product->name;

        $categories = ['eletronicos', 'moveis','limpeza', 'banho'];

        return view('painel.products.create-edit', compact('title', 'categories', 'product'));
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
            $dataForm = $request->all();

            $product = $this->product->findOrFail($id);

            $dataForm['active'] = !isset($dataForm['active']) ? 0 : 1;

            $validator = Validator::make($request->all(), [
                'name'          => 'required|min:3|max:100',
                'number'        => 'required|numeric',
                'category'      => 'required|',
                'description'   => 'min:3|max:1000',
            ]);

            if ($validator->fails())
            {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $update = $product->update($dataForm);

            if ($update)
                return redirect()->route('produtos.index');
            else
                return redirect()
                    ->route('produtos.edit', $id)
                    ->with(['errors'  => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);

        $delete = $product->delete();

        if ($delete)
        {
            return redirect()->route('produtos.index');
        }
        else
        {
            return redirect()->back()->with(['errors' => 'Falha ao deletar']);
        }
    }

    public function tests()
    {

    }
}
