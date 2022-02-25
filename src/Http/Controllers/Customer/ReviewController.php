<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function postReview(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'massage' => 'required',
        ]);

        $review = new Review();
        $review->title = $request->title;
        $review->massage = $request->massage;
        $review->rating = $request->rating;
        $review->product_id = $request->id;
        $review->customer_id = auth('customer')->user()->id;
        $review->status = 0;
        $review->save();

        return redirect()->back()->with('success', 'Successfully Review Submit!');
    }
}
