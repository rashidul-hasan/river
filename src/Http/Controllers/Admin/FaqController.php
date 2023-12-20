<?php

namespace Rashidul\River\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Rashidul\River\Constants;

use Rashidul\River\Models\ContactForm;
use Rashidul\River\Models\ContactFormField;

use Rashidul\River\Models\Faq;


class FaqController
{
    public function index()
    {
        $all = Faq::all();

        $buttons = [
            ['Add New Question', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
            
        ];
        $data = [
            'title' => 'FAQ',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.faq.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required', //TODO no space, valid blade file name
        ]);

        $questions = $request->get('question');
        $questions = explode(",", $questions);
        $file = null;
        foreach ($questions as $question) {
            $file = Faq::create([
                'question' => $question,
            ]);
        }

        Cache::forget(Constants::CACHE_KEY_DATATYPES);
        return redirect(route('river.faq.edit', $file->id))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        $file = Faq::find($id);


        $data = [
            'title' => 'Edit Faq: ' . $file->name,
            'type' => $file
        ];

        return view('river::admin.faq.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            
        ]);

        $file = Faq::find($id);
        $file->question = $request->get('question');
        $file->answer = $request->get('answer');
        $file->sort_order = $request->get('sort_order');
        $file->is_active = $request->get('is_active');
        $file->type = $request->get('type');
        $file->save();

        Cache::forget(Constants::CACHE_KEY_DATATYPES);
        return redirect()->back()->with('success', 'Updated');
    }


    public function destroy($id)
    {
        $file = Faq::find($id);
        $file->delete();

        return redirect(route('river.faq.index'))
            ->with('success', 'Deleted!');
    }
}
