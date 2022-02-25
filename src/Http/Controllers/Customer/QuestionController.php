<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function postQuestion(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'product_id' => 'required',
        ]);

        $review = new Question();
        $review->question = $request->question;
        $review->customer_id = auth('customer')->user()->id;
        $review->product_id = $request->product_id;
        $review->save();

        return redirect()->back()->with('success', 'Thank you for your question. It has been submitted to the webmaster for approval.');
    }
}
