<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function create()
    {
        return view('category');
    }


    public function store(Request $request,Colocation $colocation)
    {
        $request->validate([
            'name' => 'string|max:256',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'colocation_id' => $colocation->id
        ]);

        return redirect()->back()->with('success', 'Catégorie créée avec succès !');
    }
}
