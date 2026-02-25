<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //


    public function store(Request $request, $colocation)
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
