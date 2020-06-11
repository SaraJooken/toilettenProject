@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-md-1 my-5">
                <h1 class="display-4 text-center">Toiletten in je buurt</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-2">
                <p>Vind het dichtsbijzijnde openbare toilet.</p>
                <form action="{{action('ToilettenController@findNearToilet')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" class="lattitude" name="lattitude">
                    <input type="hidden" class="longitude" name="longitude">
                    <button type="submit" class="btn btn-dark btn-lg"><i class="fal fa-toilet mr-2"></i> Zoek toiletten!</button>
                </form>
                {{--<vind-toilet></vind-toilet>--}}
            </div>
        </div>
    </div>
@endsection
