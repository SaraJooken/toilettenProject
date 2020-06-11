@extends('layouts.app')

@section('title')
    Lees reviews
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-md-1 d-flex flex-column align-items-center my-5">
                <h1 class="display-4 my-5">Lees de reviews</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2 my-5">
                @if($reviews)
                    @if(count($reviews)!=0)
                        <div class="row">
                            <div class="col-12 my-5">
                                <a class="btn btn-outline-dark border-dark" href="{{route('createReview', $toiletId)}}">Schrijf review</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Naam</th>
                                            <th scope="col">Rating properheid</th>
                                            <th scope="col">Rating toegankelijkheid</th>
                                            <th scope="col">Te betalen?</th>
                                            <th scope="col">Review</th>
                                            <th scope="col">Geschreven op</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reviews as $review)
                                            <tr>
                                                <th scope="row">{{$review->name}}</th>
                                                <td>
                                                    @php($tel=0)
                                                    @for($x = 1; $x <= $review->rating_clean; $x++ )
                                                        @php($tel += 1)
                                                        <i class="fas fa-star ster"></i>
                                                    @endfor
                                                    @for($x = $tel+1; $x <= 5; $x++)
                                                        <i class="far fa-star ster"></i>
                                                    @endfor
                                                </td>
                                                <td>
                                                    @php($i=0)
                                                    @for($x = 1; $x <= $review->rating_accessible; $x++ )
                                                        @php($i += 1)
                                                        <i class="fas fa-star ster"></i>
                                                    @endfor
                                                    @for($x = $i+1; $x <= 5; $x++)
                                                        <i class="far fa-star ster"></i>
                                                    @endfor
                                                </td>
                                                <td>{{$review->payment === true ? 'Ja' : 'Nee'}}</td>
                                                <td>{{$review->body}}</td>
                                                <td>{{$review->created_at->diffForHumans()}}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $reviews->links() }}
                            </div>
                        </div>
                    @else
                        <h4>Er zijn nog geen reviews.</h4>
                        <a class="btn btn-dark" href="{{route('createReview', $toiletId)}}">Schrijf review</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
