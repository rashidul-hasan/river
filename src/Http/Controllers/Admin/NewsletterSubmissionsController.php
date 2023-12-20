<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Rashidul\River\Models\NewsletterSubmissions;

class NewsletterSubmissionsController extends Controller
{
    public function index()
    {
        $value= NewsletterSubmissions::all();
        $data = [
            'title' => 'Newsletter Submissions',
            'value' => $value
        ];

         return view('river::admin.Newsletter_Submitions.index', $data);
    }

    public function store(Request $request){

        $this->validate($request, [
            'title' => 'required|email',
        ]);

        NewsletterSubmissions::create([
            'email' => $request->email
        ]);

        return redirect()->back();

    }
}
