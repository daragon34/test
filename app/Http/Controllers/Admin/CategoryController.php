<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function store(Request $request){
        $this->validate($request, ['nombre' => 'required'],
                                    ['nombre.required'=>'El nombre de la categoría no debe quedar vacío'],
                                    ['descripcion' => 'required'],
                                    ['descripcion.required'=>'La descripción de la categoría no debe quedar en blanco']);
        
        Category::create($request->all());
        
        return back();
    }

    public function update(Request $request){
        $this->validate($request, 
            ['nombre' => 'required'],
            ['nombre.required'=>'El nombre de la categoría no debe quedar vacío'],
            ['descripcion' => 'required'],
            ['descripcion.required'=>'La descripción de la categoría no debe quedar en blanco']
        );
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);
        $category->nombre = $request->input('nombre');
        $category->descripcion = $request->input('descripcion');
        $category->save();

        return back();
    }

    public function delete($id){
        Category::find($id)->delete();
        return back();
    }

}
