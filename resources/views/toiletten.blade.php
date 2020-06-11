@extends('layouts.app')

@section('title')
    Toiletten
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-md-1 d-flex flex-column align-items-center my-5">
                <h1 class="display-4 my-5">Dichtsbijzijnde toiletten</h1>
                <p>Hieronder vindt u de toiletten in de buurt. Klik op de knop om een review na te laten of om de reviews te lezen.</p>
                <div class="d-flex">
                    <form action="{{action('ToilettenController@findNearToilet')}}" method="POST" enctype="multipart/form-data" class="my-5 mr-3">
                        @csrf
                        @method('POST')
                        <input type="hidden" class="lattitude" name="lattitude">
                        <input type="hidden" class="longitude" name="longitude">
                        <button type="submit" class="btn btn-secondary">Filter op afstand</button>
                    </form>
                    <form action="{{action('ToilettenController@findCleanToilet')}}" method="POST" enctype="multipart/form-data" class="my-5">
                        @csrf
                        @method('POST')
                        <input type="hidden" class="lattitude" name="lattitude">
                        <input type="hidden" class="longitude" name="longitude">
                        <button type="submit" class="btn btn-secondary">Filter op rating</button>
                    </form>
                </div>
                @php($dichtste = $toilettenSorted->first())
                <div class="card" style="width: 28rem;">
                    <div class="card-body">
                        <h5 class="card-title">Het {{ Request::is('*clean') ? 'properste' : 'dichtsbijzijnde'}} toilet ligt op {{number_format(round($dichtste->distance, 2), 2, ',', ' ')}} meter.</h5>
                        <p class="card-text">
                            <span class="mr-3">Rating van dit toilet:</span>
                            @if($dichtste->rating != null)
                                @php($y=0)
                                @for($x = 1; $x <= $dichtste->rating; $x++ )
                                    @php($y += 1)
                                    <i class="fas fa-star ster"></i>
                                @endfor
                                @for($x = $y+1; $x <= 5; $x++)
                                    <i class="far fa-star ster"></i>
                                @endfor
                            @else
                                Nog geen rating
                            @endif

                        </p>
                        <p class="card-text">{{$dichtste->product_description}}</p>
                        <p class="card-text">{{$dichtste->payment >=1 ? 'Het toilet is mogelijk te betalen.' : ''}}</p>
                        <p class="font-weight-bold"> Adres: {{$dichtste->street . ' ' . $dichtste->house_number .' '. $dichtste->box_number . ' in ' .$dichtste->city_name}}</p>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-dark" href="{{route('createReview', $dichtste->id)}}">Schrijf review</a>
                            <a class="btn btn-dark" href="{{route('readReview', $dichtste->id)}}">Lees reviews</a>
                        </div>
                    </div>
                </div>
                {{--<div class="my-5" id="googleMap"></div>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2 my-5">
                <h5>Andere toiletten in de buurt:</h5>
                <div class="accordion" id="accordionToilets">
                    @php($tel = 0)
                    @foreach($toilettenSorted->slice(1) as $toilet)
                        @php($tel += 1)
                        <div class="card">
                        <div class="card-header" id="{{'heading'.$tel}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed text-dark" type="button" data-toggle="collapse" data-target="{{'#collapse'.$tel}}" aria-expanded="true" aria-controls="{{'collapse'.$tel}}">
                                    Op {{number_format(round($toilet->distance, 2), 2, ',', ' ')}} meter
                                </button>
                            </h2>
                        </div>

                        <div id="{{'collapse'.$tel}}" class="collapse" aria-labelledby="{{'heading'.$tel}}" data-parent="#accordionToilets">
                            <div class="card-body">
                                <p class="card-text">
                                    <span class="mr-3">Rating van dit toilet:</span>
                                    @if($toilet->rating != null)
                                        @php($i=0)
                                        @for($x = 1; $x <= $toilet->rating; $x++ )
                                            @php($i += 1)
                                            <i class="fas fa-star ster"></i>
                                        @endfor
                                        @for($x = $i+1; $x <= 5; $x++)
                                            <i class="far fa-star ster"></i>
                                        @endfor
                                    @else
                                        Nog geen rating
                                    @endif

                                </p>
                                <p class="card-text">{{$toilet->product_description}}</p>
                                <p class="card-text">{{$toilet->payment >=1 ? 'Het toilet is mogelijk te betalen.' : ''}}</p>
                                <p class="font-weight-bold"> Adres: {{$toilet->street . ' ' . $toilet->house_number .' '. $toilet->box_number . ' in ' .$toilet->city_name}}</p>
                                <div class="d-flex">
                                    <a class="btn btn-dark mr-4" href="{{route('createReview', $toilet->id)}}">Schrijf review</a>
                                    <a class="btn btn-dark" href="{{route('readReview', $toilet->id)}}">Lees reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
