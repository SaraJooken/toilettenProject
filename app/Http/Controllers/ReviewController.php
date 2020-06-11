<?php

namespace App\Http\Controllers;

use App\Review;
use App\Toilet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $toilet_id = $id;
        return view('review.create', compact('toilet_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'toilet_id'=>'required',
            'name'=>'required|string',
            'rating_clean'=>'required|integer',
            'rating_accessible'=>'required|integer',
        ]);
        $review = new Review;
        $review['toilet_id'] = $request->get('toilet_id');
        $review['name'] = Str::title($request->get('name'));
        $review['rating_clean'] = $request->get('rating_clean');
        $review['rating_accessible'] = $request->get('rating_accessible');
        $review['payment'] = $request->has('payment');
        $review['body'] = $request->get('body');
        $review->save();



        $ratingReviewsAccessible = Review::where('toilet_id','=',$review['toilet_id'])->pluck('rating_accessible');
        $ratingReviewsClean = Review::where('toilet_id','=',$review['toilet_id'])->pluck('rating_clean');
        $ratingReviews = collect([$ratingReviewsClean->avg(), $ratingReviewsAccessible->avg()]);

        $avgRating= $ratingReviews->avg();
        $review->toilet()->update(['rating'=>$avgRating]);

        return redirect('/review/show/'. $request->get('toilet_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reviews = Review::where('toilet_id','=',$id)->paginate(10);
        $toiletId = $id;
        return view('review.show', compact('reviews', 'toiletId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
