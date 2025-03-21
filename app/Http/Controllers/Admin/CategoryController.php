<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $searchName = $request->input('searchname');

        $query = Category::query();
        if (!empty($searchName)) {
            $query->where('name', 'LIKE', '%' . $searchName . '%');
        }

        $categories = $query->orderBy('name', 'asc')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $categorie = new Category();
        $categorie->name = $request->name;
        $categorie->description = $request->description;
        $categorie->save();

        notyf()->success("Created Category Successfully!");

        return to_route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();


        notyf()->success("Updated Category Successfully!");

        return to_route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {


            $category->delete();

            notyf()->success('Deleted Category Successfully!');
            return response(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger("categorie Language Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
