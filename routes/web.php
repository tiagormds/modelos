<?php

use App\Categoria;

Route::get('/', function () {
    $categorias = Categoria::all();

    foreach($categorias as $c){
        echo "id: ".$c->id.", ";
        echo "id: ".$c->nome."<br />";
    }
});

Route::get('/inserir/{nome}', function($nome){
    $cat = new Categoria();
    $cat->nome = $nome;
    $cat->save();
    return redirect("/");
});

Route::get('/categoria/{id}', function($id){
    $cat = Categoria::findOrFail($id);

        if(isset($cat)){
            echo "id: ".$cat->id.", ";
            echo "id: ".$cat->nome."<br />";
        }else{
            echo "Categoria não encontrada";
        }
});

Route::get('/atualizar/{id}/{nome}', function($id, $nome){
    $cat = Categoria::find($id);
    if(isset($cat)){
        $cat->nome = $nome;
        $cat->save();
        return redirect("/");
    }else{
        echo "<h1>Categoria não encontrada</h1>";
    }
});

Route::get('/remover/{id}', function($id){
    $cat = Categoria::find($id);
    if(isset($cat)){
        $cat->delete();
        return redirect("/");
    }else{
        echo "<h1>Categoria não encontrada</h1>";
    }
});

Route::get('/categoriaPorNome/{nome}', function ($nome){

    $categorias = Categoria::where('nome', 'like', $nome.'%')->get();

    //$categorias = Categoria::where('nome', $nome)->get();

    foreach ($categorias as $c){
        echo "id: ".$c->id.", ";
        echo "id: ".$c->nome."<br />";
    }
});

Route::get('categoriaPorId/{id}', function($id){
    $categorias = Categoria::where('id', '>=', $id)->get();

    foreach ($categorias as $c){
        echo "id: ".$c->id.", ";
        echo "id: ".$c->nome."<br />";
    }
});

Route::get('quantidadeDeCategorias/{id}', function($id){
    $categorias = Categoria::where('id', '>=', $id)->get();

    foreach ($categorias as $c){
        echo "id: ".$c->id.", ";
        echo "id: ".$c->nome."<br />";
    }

    $count = Categoria::where('id', '>=', $id)->count();
    echo "<h1>Count".$count."</h1>";
});

Route::get('/todas', function () {
    //Query que mostra todos os registros, até os que foram "apagados".
    $categorias = Categoria::withTrashed()->get();
    //$categorias = Categoria::onlyTrashed()->get();

    //COndição que filtra para mostrar só os que estão "apagados".
    foreach($categorias as $c){
        if($c->trashed()){
            echo "id: ".$c->id.", ";
            echo "id: ".$c->nome."<br />";
        }
    }
});

Route::get('/restaurar/{id}', function ($id) {
    //Query que mostra todos os registros, até os que foram "apagados".
    $categorias = Categoria::onlyTrashed()->find($id);
    //$categorias = Categoria::onlyTrashed()->get();

    if(isset($categorias)){
        $categorias->restore();
        echo "Categoria restaurada: ".$categorias->id."<br />";
    }else{
        echo "Categoria não encontrada";
    }
});


