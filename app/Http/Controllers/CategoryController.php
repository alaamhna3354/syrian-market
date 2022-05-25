<?php

namespace App\Http\Controllers;

use App\Http\Traits\Upload;
use App\Models\Category;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use Upload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.pages.services.show-category', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.services.category');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $req = (new \Stevebauman\Purify\Purify)->clean($request->except('_token', '_method'));

        $rules = [
            'category_title' => 'required',
            'category_description' => 'nullable',
            'type' => 'required',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpeg','jpg','png'])]
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $cat = new Category();
        if ($request->hasFile('image')) {
            try {
                $cat->image = $this->uploadImage($request['image'], config('location.category.path'), config('location.category.size'));
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }

        $cat->category_title = $req['category_title'];
        $cat->category_description = $req['category_description'];
        $cat->status = $req['status'];
        $cat->type = $req['type'];
        if ($req['type'] == "BALANCE" || $req['type'] == "OTHER"){
            if ($req['special_field'] != ""){
                $cat->special_field = $req['special_field'];
            }else{
                $cat->special_field = null;
            }
        }else{
            $cat->special_field = null;
        }


        $cat->save();
        return back()->with('success', 'Successfully Updated');
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $categories = Category::where('category_title', 'LIKE', "%{$request->data}%")->get()->pluck('category_title');
        return response()->json($categories);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.pages.services.edit-category', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $catData = Purify::clean($request->all());
        $cat = Category::find($request->id);

        $rules = [
            'category_title' => 'required',
            'category_description' => 'nullable',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpeg','jpg','png'])]
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            try {
                $old = $cat->image;
                $cat->image = $this->uploadImage($request->image, config('location.category.path'), config('location.category.size'), $old);
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }

        $cat->category_title = $catData['category_title'];
        $cat->category_description = $catData['category_description'];
        $cat->status = $catData['status'];
        if ($catData['type'] == "BALANCE" || $catData['type'] == "OTHER"){
            if ($catData['special_field'] != ""){
                $cat->special_field = $catData['special_field'];
            }else{
                $cat->special_field = null;
            }
        }else{
            $cat->special_field = null;
        }
        $cat->type = $catData['type'];
        $cat->save();
        return back()->with('success', 'Successfully Updated');
    }


    public function categoryActive(Request $request)
    {
        $category = Category::all();
        foreach ($category as $cate) {
            $re = Category::find($cate->id);
            $re->status = 1;
            $re->save();
        }
        return back()->with('success', 'Successfully Updated');
    }


    public function categoryDeactive(Request $request)
    {
        $category = Category::all();
        foreach ($category as $cate) {
            $re = Category::find($cate->id);
            $re->status = 0;
            $re->save();
        }
        return back()->with('success', 'Successfully Updated');
    }


    public function statusChange(Request $request, $id)
    {
        $cat = Category::find($id);
        if ($cat['status'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $cat->status = $status;
        $cat->save();
        return back()->with('success', 'Successfully Updated');
    }


    public function search(Request $request)
    {
        $search = $request->all();
        $categories = Category::when(isset($search['category_title']), function ($query) use ($search) {
            return $query->where('category_title', 'LIKE', "%{$search['category_title']}%");
        })->when(isset($search['status']), function ($query) use ($search) {
            return $query->where('status', $search['status']);
        })->get();
        $categories->append($search);
        return view('admin.pages.services.show-category', compact('categories'));
    }

    //multiple active check
    public function activeMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User Id!!');
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $categoryes = Category::whereIn('id', $ids);
                $categoryes->update([
                    'status' => 1,
                ]);
            }
            session()->flash('success', 'User Active Updated Successfully!!');
            return response()->json(['success' => 1]);
        }

    }

    //multiple inactive check
    public function deactiveMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User Id!!');
            return response()->json(['error' => 1]);
        } else {
            $ids = explode(",", $request->strIds);
            if (count($ids) > 0) {
                $categoryes = Category::whereIn('id', $ids);
                $categoryes->update([
                    'status' => 0,
                ]);
            }
            session()->flash('success', 'User Active Updated Successfully!!');
            return response()->json(['success' => 1]);
        }
    }
}
