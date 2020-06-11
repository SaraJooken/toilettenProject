<?php

namespace App\Http\Controllers;

use App\Review;
use App\Toilet;
use Illuminate\Http\Request;

class ToilettenController extends Controller
{
    public function findToilet(Request $request){
        $toiletten = Toilet::all();

        $longitude = $request->get('longitude');
        $lattitude = $request->get('lattitude');
        foreach($toiletten as $toilet){
            $toilet['distance'] = $this->distance($lattitude, $toilet->lat, $longitude, $toilet->long);

            $teBetalen = 0;
            if($toilet->reviews()){
                $reviews = Review::where('toilet_id','=',$toilet->id)->get();
                foreach($reviews as $review){
                    $review->payment = 1 ? $teBetalen +=1 : $teBetalen += 0;
                }
            }
            $toilet['payment'] = $teBetalen;
        }
        $toilettenSorted = $toiletten->where('distance','<', '5000');

        return $toilettenSorted;
    }

    public function distance($lattitude1, $lattitude2, $longitude1, $longitude2){
        $radius = 6371000;
        $lat1 = $lattitude1 * pi()/180;
        $lat2 = $lattitude2 * pi()/180;
        $diffLat = ($lattitude2 - $lattitude1) * pi()/180;
        $diffLon = ($longitude2 - $longitude1) * pi()/180;

        $a = sin($diffLat/2) * sin($diffLat / 2 )+ cos($lat1) * cos($lat2) * sin($diffLon/2) * sin($diffLon/2);
        $c = 2* atan2(sqrt($a), sqrt(1-$a));
        $d = $radius * $c;
        return $d;
    }

    public function findCleanToilet(Request $request){
        $toiletten = $this->findToilet($request);
        $toilettenSorted = $toiletten->sortByDesc('rating');
        return view('toiletten', compact('toilettenSorted'));
    }

    public function findNearToilet(Request $request){
        $toilettenSorted = $this->findToilet($request);
        $toilettenSorted = $toilettenSorted->sortBy('distance');
        return view('toiletten', compact('toilettenSorted'));
    }
}
