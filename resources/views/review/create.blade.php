@extends('layouts.app')

@section('title')
    Schrijf review
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-md-1 d-flex flex-column align-items-center my-5">
                <h1 class="display-4 my-5">Schrijf een review</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2 my-5">
                @include('includes.form_error')
                <form action="{{action('ReviewController@store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="toilet_id" value="{{$toilet_id}}">
                    <div class="form-group">
                        <label for="name">Naam:</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-row">
                        <div class='rating-stars col-md-6 '>
                            <label for="stars" class="mb-3">Properheid:</label>
                            <ul id='stars' class="m-0">
                                <li class='star' title='Slecht' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Ok' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Goed' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Super' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                            <input type="hidden" name="rating_clean" id="ratingSterren">
                            <div class='success-box rounded'>
                                <div class='clearfix'></div>
                                <div class='text-message'></div>
                                <div class='clearfix'></div>
                            </div>
                        </div>
                        <div class='rating-stars col-md-6 '>
                            <label for="stars2" class="mb-3">Toegankelijkheid:</label>
                            <ul id='stars2' class="m-0">
                                <li class='star' title='Slecht' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Ok' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Goed' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Super' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                            <input type="hidden" name="rating_accessible" id="ratingSterren2">
                            <div class='success-box2 rounded'>
                                <div class='clearfix'></div>
                                <div class='text-message'></div>
                                <div class='clearfix'></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="payment">
                            <label class="custom-control-label" for="customSwitch1">Te Betalen?</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body">Review:</label>
                        <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <input type="submit" value="Review aanmaken" class="btn btn-dark">
                </form>
            </div>
        </div>
    </div>
@endsection

