@extends('layouts.Edum')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')

    <div>
        <h2>@lang('movies.movies')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{--  --}}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.movie.index') }}">@lang('movies.movies')</a></li>
        <li class="breadcrumb-item">@lang('site.show')</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ $movie->poster_path }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-10">
                        <h2>{{ $movie->title }}</h2>
                        @foreach ($movie->genres as $genre)
                            <h5 class="d-inline-block"><span class="badge badge-primary">{{ $genre->name }}</span></h5>
                        @endforeach
                        <p style="font-size: 16px;">{{ $movie->description }}</p>
                        <div class="d-flex mb-2">
                            <i class="fa fa-star text-warning" style="font-size: 35px;"></i>
                            <h3 class="m-0 mx-2">{{ $movie->vote }}</h3>
                            <p class="m-0 align-self-center">@lang('movies.by') {{ $movie->vote_count }}</p>
                        </div>
                        <p><span class="font-weight-bold">@lang('movies.language')</span>: en</p>
                        <p><span class="font-weight-bold">@lang('movies.release_date')</span>: {{ $movie->release_date }}</p>

                        <hr>

                        <div class="row " id='images_container'>
                            @foreach ($movie->images as $image)
                                <div class="col-md-3 my-2">
                                    <a href="{{$image->image_path}}">
                                        <img src="{{ $image->image_path }}" class="img-fluid" alt="">
                                    </a>
                                </div><!-- end of col -->
                            @endforeach
                        </div><!-- end of row -->
                        <hr>
                        <div class="row">
                            @foreach ($movie->actors as $actor)
                                <div class="col-md-2 my-2">
                                    <a href="{{ route('admin.movie.index', ['actor_id' => $actor->id]) }}">
                                        <img src="{{ $actor->image_path }}" class="img-fluid" alt="">
                                    </a>
                                </div><!-- end of col -->
                            @endforeach
                        </div><!-- end of row -->
                    </div><!-- end of col  -->
                </div><!-- end of row -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->

@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js" integrity="sha512-C1zvdb9R55RAkl6xCLTPt+Wmcz6s+ccOvcr6G57lbm8M2fbgn2SUjUJbQ13fEyjuLViwe97uJvwa1EUf4F1Akw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$('#images_container').magnificPopup({
  delegate: 'a', // child items selector, by clicking on it popup will open
  type: 'image' ,
  gallery:{
        enabled: true,
    },
  zoom: {
    enabled: true, // By default it's false, so don't forget to enable it

    duration: 300, // duration of the effect, in milliseconds
    easing: 'ease-in-out'},

  // other options
});
</script>
@endpush
