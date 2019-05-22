<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$arquivos = Product::all()->sortByDesc('id');
        //$categories = \Illuminate\Support\Facades\Storage::getFacadeApplication();
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0)
        {
            $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
            $nome = $_FILES['arquivo']['name'];
            $descricao = $request->descricao;
            
            $extensao = strrchr($nome, '.');

            $extensao = strtolower($extensao);

            if(strstr('.jpg;.jpeg;.gif;.png;.pdf;.doc;.docx;.ppt;.pptx;.xml;.xls;.xlsx;.txt;', $extensao))
            {		 
                $destino = 'assets/imgs/temp/' . $nome;
                // Faz o upload:
                //$upload = $request->arquivo->storeAs('categories', $nome);
                DB::table('files')->insert([
                    [   
                        'arquivo' => $request->arquivo,
                        'nome' => $nome,
                        'descricao' => $descricao,
                        'destino' => $destino
                    ]
                ]);

                //$query ="INSERT INTO arquivos VALUES('null','$nome','$destino', '$descricao')";
                //$inserir = mysqli_query($link, $query);
                        
                if( @move_uploaded_file( $arquivo_tmp, $arquivo  ))
                {
                    echo "<script>alert('Arquivo salvo com sucesso');window.location.href='novoArquivo.php';</script>";
                }
                else
                    echo "Erro ao salvar o arquivo. O arquivo pode não estar no formato permitido.";
            }
            else
                echo "Erro. O formato deste arquivo não é permitido.";
        }
        else
        {
            echo "Você não enviou nenhum arquivo!";
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

}
