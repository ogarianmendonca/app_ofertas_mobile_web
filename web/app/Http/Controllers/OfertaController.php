<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oferta;
use Illuminate\Http\Response;

/**
 * Class OfertaController
 * @package App\Http\Controllers
 */
class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ofertas = Oferta::all();

        return view('ofertas.index', compact('ofertas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ofertas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        if($request->hasFile('imagem')){
            $imagem = $request->file('imagem');
            $ext = $imagem->guessClientExtension();
            $diretorio = "img/";
            $nomeImg = 'img_' . rand(111,999) . '.' . $ext;
            $imagem->move($diretorio, $nomeImg);
            $dados['imagem'] = $diretorio . $nomeImg;
        }

        $dados['valor_formatado'] = 'R$ '. number_format($dados['valor'], 2, ",", ".");

        Oferta::create($dados);
        \Session::flash('flash_message', 'Oferta cadastrada com sucesso');
        return redirect()->route('ofertas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $oferta = Oferta::find($id);

        return view('ofertas.edit', compact('oferta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->all();     

        if($request->hasFile('imagem')){
            $imagem = $request->file('imagem');
            $ext = $imagem->guessClientExtension();
            $diretorio = "img/";
            $nomeImg = 'img_' . rand(111,999) . '.' . $ext;
            $imagem->move($diretorio, $nomeImg);
            $dados['imagem'] = $diretorio . $nomeImg;
        }

        $dados['valor_formatado'] = 'R$ '. number_format($dados['valor'], 2, ",", ".");

        Oferta::find($id)->update($dados);
        \Session::flash('flash_message', 'Oferta editada com sucesso');
        return redirect()->route('ofertas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Oferta::find($id)->delete();
        \Session::flash('flash_message', 'Oferta excluída com sucesso');
        return redirect()->route('ofertas.index');
    }
}
