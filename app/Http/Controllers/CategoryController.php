<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;


class CategoryController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function manageCategory()
    {

        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title','id')->all();

        return view('categoryTreeview',compact('categories','allCategories'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function addCategory(Request $request)
    {
        $this->validate($request, [
        		'title' => 'required',
        	]);

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
       
        Category::create($input);

        return back()->with('success_add', 'New Category added successfully.');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function deleteCategory(Request $request)
    {
        $this->validate($request, [
        		'id' => 'required',
        	]);

        $id = $request->get('id');
        Category::destroy($id);

        return back()->with('success_delete', 'Category deleted successfully.');
    }


    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function editCategory(Request $request)
    {
        $this->validate($request, [
                'id_edit' => 'required',
        		'title_edit' => 'required',
        	]);

        $id = $request->get('id_edit');
        $category = Category::find($id);
        $category->title = $request->get('title_edit');
        $category->save();

        return back()->with('success_edit', 'Edit Category successfully.');
    }


}