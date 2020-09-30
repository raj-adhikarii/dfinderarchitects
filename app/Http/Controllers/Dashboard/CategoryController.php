<?php

namespace App\Http\Controllers\Dashboard;

use Session;
use Validator;
use App\Project;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::with('children')->whereNull('parent_id')->orderBy('name')->get();
        return view('dashboard.categories.all',compact('categories'));
    }

    public function getAddCategory()
    {
        $categories = Category::whereNull('parent_id')->orderBy('name')->get();
        return view('dashboard.categories.add', compact('categories'));
    }

    public function postNewCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric'
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }

        if( Category::create($request->all()) ){
            Session::flash('success','Successfully saved.');
            return redirect()->route('categories');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('categories');
        }
    }

    public function getEditCategory($id)
    {
        $category = Category::findOrFail($id);
        if( !is_null($category) ){
            $categories = Category::whereNull('parent_id')->orderBy('name')->get();
            return view('dashboard.categories.edit',compact('categories', 'category'));
        }else{
            return abort(404);
        }
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'cate_id' => 'required|integer',
            'name'      => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric'
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }

        $category = Category::findOrFail($request['cate_id']);
        if( $category->update($request->all()) ){
            Session::flash('success','Successfully updated.');
            return redirect()->route('categories');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('categories');
        }
    }

    public function deleteCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cate_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            Session::flash('error',$error);
            return back()->withErrors($validator)->withInput();
        }

        $category = Category::findOrFail($request['cate_id']);

        $sub_categories = Category::where('parent_id', $request->cate_id)->get();
        if(!$sub_categories->isEmpty()) {
            Session::flash('error','Couldnot delete. This category has sub categories. First delete sub categories.');
            return redirect()->route('categories');
        }

        $projects = Project::where('cate_id', $request->cate_id)->get();
        if(!$projects->isEmpty()) {
            Session::flash('error','Couldnot delete. Some Projects are using this category.');
            return redirect()->route('categories');
        }

        if( $category->delete() ){
            Session::flash('success','Successfully deleted.');
            return redirect()->route('categories');
        }else{
            Session::flash('error','Error while saving data. Please try again later.');
            return redirect()->route('categories');
        }
    }
}
