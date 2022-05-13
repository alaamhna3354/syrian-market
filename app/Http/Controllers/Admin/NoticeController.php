<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;
use Validator;
class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::orderBy('id','DESC')->paginate(config('basic.paginate'));
        return view('admin.pages.notice.show', compact('notices'));
    }

    public function create()
    {
        return view('admin.pages.notice.add');
    }

    public function store(Request $request)
    {
        $purifyData = Purify::clean($request->all());
        $rules = [
            'title' => 'sometimes|required',
            'highlight_text' => 'sometimes|required',
            'status' => 'sometimes|required',
            'details' => 'sometimes|required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $notice = new Notice();
        $notice->title = $purifyData['title'];
        $notice->highlight_text = $purifyData['highlight_text'];
        $notice->status = $purifyData['status'];
        $notice->details = $purifyData['details'];
        $notice->save();

        return back()->with('success', 'Notice has been saved');
    }
    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        return view('admin.pages.notice.edit', compact('notice'));
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'title' => 'sometimes|required',
            'highlight_text' => 'sometimes|required',
            'status' => 'sometimes|required',
            'details' => 'sometimes|required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $purifyData = Purify::clean($request->all());

        $notice = Notice::findOrFail($id);
        $notice->title = $purifyData['title'];
        $notice->highlight_text = $purifyData['highlight_text'];
        $notice->status = $purifyData['status'];
        $notice->details = $purifyData['details'];
        $notice->update();

        return back()->with('success', 'Notice has been updated');

    }

    public function delete(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);
        $notice->delete();
        return back()->with('success', 'Notice has been deleted');
    }
}
