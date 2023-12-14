<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Rashidul\River\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ContactFormController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'ContactForm',
        ];

        $value = ContactForm::all();

        return view('river::admin.dashboard.index', $data, compact('value'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'string|required',
        ]);

        ($request->is_active == 1) ? $is_active = 1 : $is_active = 0;

        ContactForm::create([
            'name' => $request->name,
            'slug' =>  Str::slug($request->name, '_'),
            'is_active' => $is_active
        ]);

        return redirect()->back()->with('success', 'Created!');
    }

    public function destroy($id)
    {
        $data = ContactForm::find($id);
        $data->delete();

        return redirect()->back()->with('success', 'deleted!');
    }

    public function update($id)
    {
        $data = ContactForm::find($id);
        return view('river::admin.dashboard.contact_update', compact('data'));
    }

    public function update_store(Request $request, ContactForm $contactForm)
    {
        $request->validate([
            'name' => 'required',

        ]);

        ($request->is_active == 1) ? $is_active = 1 : $is_active = 0;
        DB::table('river_contact_form')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'is_active' => $is_active
            ]);
        return redirect()->back()->with('success', 'Updated!');
    }
}
