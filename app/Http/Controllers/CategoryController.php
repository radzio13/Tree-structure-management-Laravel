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

     /*
    public function sortCategory()
    {
        $categories = Category::where('parent_id', '=', 0)->get()->sortBy(function ($categ) {
            return $categ->title;
        });
        $allCategories = Category::pluck('title','id')->all();

        //return view('categoryTreeview',compact('categories','allCategories'));
        
        //$categories = Category::orderBy('title', 'ASC')->get();
        //$allCategories = Category::pluck('title','id')->all();
        //return redirect()->back()->with('success_sort', 'Pomyślnie sort  kategorię.')->with(compact('categories','allCategories'));
        return view('categoryTreeview',compact('categories','allCategories'));
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function addCategory(Request $request)
    {
        $this->validate($request, [
        		'nazwa' => 'required|max:255|regex:/(^([a-zA-z ]+)(\d+)?$)/', //Na początku małe i duże litery + spacje dowolną ilość razy oraz max jeden ciąg cyfr
        	]);

        //$input = $request->all();
        $input['title'] = $request->get('nazwa');
        $input['parent_id'] = $request->get('parent_id');
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
       
        Category::create($input);

        return back()->with('success_add', 'Pomyślnie dodano nową kategorię.');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function deleteCategory(Request $request)
    {
        $this->validate($request, [
        		'kategoria' => 'required',
        	]);

        $id = $request->get('kategoria');
        Category::destroy($id);

        return back()->with('success_delete', 'Pomyślnie usunięto kategorię.');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function editCategory(Request $request)
    {
        $this->validate($request, [
                'kategoria_do_edycji' => 'required',
        		'nowa_nazwa' => 'required|max:255|regex:/(^([a-zA-z ]+)(\d+)?$)/', //Na początku małe i duże litery + spacje dowolną ilość razy oraz max jeden ciąg cyfr
        	]);

        $id = $request->get('kategoria_do_edycji');
        $category = Category::find($id);
        $category->title = $request->get('nowa_nazwa');
        $category->save();

        return back()->with('success_edit', 'Pomyślnie edytowano kategorię.');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function transferCategory(Request $request)
    {
        $this->validate($request, [
                'kategoria_do_przeniesienia' => 'required',
        		'nowa_kategoria' => 'required',
        	]);

        $id = $request->get('kategoria_do_przeniesienia');
        $parent_id = $request->get('nowa_kategoria');

        if($id == $parent_id)
        {
            return back()->with('error_transfer', 'Dotychczasowa kategoria i nowa kategoria muszą się różnić.');
        }
        else
        {
            $category = Category::find($id);
            $category->parent_id = $parent_id;
            $category->save();
    
            return back()->with('success_transfer', 'Pomyslnie przeniesiono kategorię.');
        }
        
    }


}