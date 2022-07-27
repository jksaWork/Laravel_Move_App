@extends('layouts.Edum')
@push('styles')
    <style>
        .lds-dual-ring {
  display: inline-block;
  width: 80px;
  height: 80px;
}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 8px;
  border-radius: 50%;
  border: 6px solid #fff;
  border-color: #143b64 transparent #143b64 transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
.loader{
    height: 100px;
    display: flex;
    width: 100%;
    height: 100%;
    align-items: center;
    justify-items: center;
    flex-direction: column;
}
.has_loader > :not(.loader){
    display: none;
}
.card{
    margin-top: 20px;
}
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-xl-6 col-xxl-6 col-sm-12">
            <div class="row">
                <div class="col-xl-6 col-xxl-6 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body has_loader">
                            <div class="loader">
                                <div class="lds-dual-ring"></div>
                            </div>
                            <div class="">
                            <h4 class="card-title">Actor</h4>
                            <h3 class="actor_head">3280</h3>
                            <div class="progress mb-2">
                                <div class="progress-bar progress-animated bg-primary" style="width: 80%"></div>
                            </div>
                            {{-- <small>80% Increase in 20 Days</small> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-6 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body has_loader">
                            <div class="loader">
                                <div class="lds-dual-ring"></div>
                            </div>
                            <h4 class="card-title">Movies</h4>
                            <h3 class="movie_head">245</h3>
                            <div class="progress mb-2">
                                <div class="progress-bar progress-animated bg-warning" style="width: 50%"></div>
                            </div>
                            {{-- <small>50% Increase in 25 Days</small> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-6 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body has_loader">
                            <div class="loader">
                                <div class="lds-dual-ring"></div>
                            </div>
                            <div class="">
                                <h4 class="card-title">Genre</h4>
                            <h3 class="genre_head">28</h3>
                            <div class="progress mb-2">
                                <div class="progress-bar progress-animated bg-red" style="width: 76%"></div>
                            </div>
                            {{-- <small>76% Increase in 20 Days</small> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-6 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body has_loader">
                            <div class="loader">
                                <div class="lds-dual-ring"></div>
                            </div>
                            <div class="">
                                <h4 class="card-title">Fees Collection</h4>
                            <h3>25160$</h3>
                            <div class="progress mb-2">
                                <div class="progress-bar progress-animated bg-success" style="width: 30%"></div>
                            </div>
                            <small>30% Increase in 30 Days</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-6">
            @include('admin._chart')
        </div>
    </div>
                    <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">


                            <div class="d-flex my-2">
                                <h4 class="mb-0">@lang('movies.top') @lang('movies.popular')</h4>
                                <a href="{{ route('admin.movie.index') }}" class="mx-2 mt-1">@lang('site.show_all')</a>
                            </div>

                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">@lang('movies.title')</th>
                                    <th>@lang('movies.vote')</th>
                                    <th>@lang('movies.vote_count')</th>
                                    <th>@lang('movies.release_date')</th>
                                </tr>

                                @foreach ($popularMovies as $index => $movie)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><a href="{{ route('admin.movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                        <td><i class="fa fa-star text-warning"></i> <span class="mx-2">{{ $movie->vote }}</span></td>
                                        <td>{{ $movie->vote_count }}</td>
                                        <td>{{ $movie->release_date }}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="d-flex my-2">
                                <h4 class="mb-0">@lang('movies.top') @lang('movies.now_playing')</h4>
                                <a href="{{ route('admin.movie.index', ['type' => 'now_playing']) }}" class="mx-2 mt-1">@lang('site.show_all')</a>
                            </div>
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">@lang('movies.title')</th>
                                    <th>@lang('movies.vote')</th>
                                    <th>@lang('movies.vote_count')</th>
                                    <th>@lang('movies.release_date')</th>
                                </tr>

                                @foreach ($nowPlayingMovies as $index => $movie)
                                    <tr>
                                        <td>{{ $index +  1 }}</td>
                                        <td><a href="{{ route('admin.movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                        <td><i class="fa fa-star text-warning"></i> <span class="mx-2">{{ $movie->vote }}</span></td>
                                        <td>{{ $movie->vote_count }}</td>
                                        <td>{{ $movie->release_date }}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <hr>

                            <div class="d-flex my-2">
                                <h4 class="mb-0">@lang('movies.top') @lang('movies.upcoming')</h4>
                                <a href="{{ route('admin.movie.index', ['type' => 'upcoming']) }}" class="mx-2 mt-1">@lang('site.show_all')</a>
                            </div>

                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">@lang('movies.title')</th>
                                    <th>@lang('movies.vote')</th>
                                    <th>@lang('movies.vote_count')</th>
                                    <th>@lang('movies.release_date')</th>
                                </tr>
                                @foreach ($upcomingMovies as $index => $movie)
                                    <tr>
                                        <td>{{ $index  +  1 }}</td>
                                        <td><a href="{{ route('admin.movie.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                        <td><i class="fa fa-star text-warning"></i> <span class="mx-2">{{ $movie->vote }}</span></td>
                                        <td>{{ $movie->vote_count }}</td>
                                        <td>{{ $movie->release_date }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div><!-- end of card body -->
                    </div><!-- end of card -->
                </div><!-- end of col -->
            </div><!-- end of row -->
    </div>
    </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function(){
            // alert('jsa');
            getStaticData();
            function getStaticData(){
                $.ajax(
                    {
                        url: '{{route('getStaticdata')}}',
                        method:'get',
                        success:function(data){
                            // alert(data);
                            console.log(data);
                            $('.has_loader').removeClass('has_loader');
                            $('.loader').hide();
                            $('.actor_head').text(data.actors_count);
                            $('.genre_head').text(data.genres_count);
                            $('.movie_head').text(data.movies_count);
                        },
                        error:(err) => alert(err),
                    }
                )
            }
        })
    </script>
@endpush
