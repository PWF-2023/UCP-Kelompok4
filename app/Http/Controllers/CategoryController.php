<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        //dd($todos);
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function edit(Category $category)
    {
        if (auth()->user()->id == $category->user_id) {
            // dd($todo);

            return view('category.edit', compact('category'));
        }

        return redirect()->route('category.index')->with('danger', 'You are not authorized to edit this todo!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // Practical
        // $todo->title = $request->title;
        // $todo->save();

        //Eloquent Way - Readable
        $category->update([
            'title' => ucfirst($request->title),
        ]);
        return redirect()->route('category.index')->with('success', 'Todo Updated Successfully!');
    }

    public function destroy(Category $category)
    {
        if (auth()->user()->id == $category->user_id) {
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Todo Deleted Successfully!');
        } else {
            return redirect()->route('category.index')->with('danger', 'You are not authorized to delete this todo!');
        }
    }

    public function store(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // Practical
        // $todo = new Todo;
        // $todo->title = $request->title;
        // $todo->user_id = auth()->user()->id;
        // $todo->save();

        // Query Builder way
        // DB::table('todos)->insert([
        // 'title' => $request->title,
        // 'user_id' => auth()->user()->id,
        // 'created_at' => now(),
        // 'updated_at' => now(),
        // ])

        // Eloquent Way - Readable

        $category = Category::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('category.index')->with('success', 'Todo created successfully!');
    }
}
