@extends('layouts.Edum')
@section('content')
<div class="">
    <div>
        <h2>Moveis</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">Moveis</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="tile ">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            @if (auth()->user()->hasPermission('delete_roles'))
                            <form method="post" action="{{ route('admin.roles.bulk_delete') }}"
                                style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i
                                        class="fa fa-trash"></i> @lang('site.bulk_delete')</button>
                            </form><!-- end of form -->
                            @endif
                        </div>
                    </div><!-- end of row -->
                    <div class="row">
                        <div class="col-md-3">
                            <label>search </label>
                            <div class="form-group">
                                <input type="text" id="data-table-search" class="form-control" autofocus
                                    placeholder="@lang('site.search')">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Genres</label>
                                <select class="form-control" name="" id="genres">
                                    @foreach ($genres as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Actor</label>
                                <select class="form-control " name="actors" id="actors">
                                    @foreach ($actors as $actor)
                                    <option value="{{$actor->id}}">
                                        {{$actor->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="">Type</label>
                              <select class="form-control" name="" id="type">
                                <option value=""> all</option>
                                <option value="up_comming"> Up Comming </option>
                                <option value="now_playing"> now Playing</option>
                              </select>
                            </div>
                        </div>
                    </div><!-- end of row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table datatable" id="roles-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="animated-checkbox">
                                                    <label class="m-0">
                                                        <input type="checkbox" id="record__select-all">
                                                        <span class="label-text"></span>
                                                    </label>
                                                </div>
                                            </th>
                                            </th>
                                            <th>@lang('movies.poster')</th>
                                            <th>@lang('movies.title')</th>
                                            <th>@lang('genres.genres')</th>
                                            <th>@lang('movies.vote')</th>
                                            <th>@lang('movies.vote_count')</th>
                                            <th>@lang('movies.release_date')</th>
                                            <th>@lang('site.action')</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                </table>
                            </div><!-- end of table responsive -->
                        </div><!-- end of col -->

                    </div><!-- end of row -->

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div>
    </div><!-- end of row -->

    @endsection

    @push('scripts');
    <script src="{{ asset('admin_assets/js/custom/index.js')}}"></script>
    <script src="//code.jquery.com/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>
        // alert('worgiing');
        let genres =  @json(request()->genre_id);
        let actor =@json(request()->actor_id);
        let type;
        console.log(genres);
        let MovieTable = $('#roles-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.movie.data') }}',
                data:function(d){
                    d.genre_id = genres;
                    d.actor_id = actor;
                    d.type = type;
                }
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'poster', name: 'poster', searchable: false, sortable: false, width: '10%'},
                {data: 'title', name: 'title', width: '15%'},
                {data: 'genres', name: 'genres', searchable: false},
                {data: 'vote', name: 'vote', searchable: false},
                {data: 'vote_count', name: 'vote_count', searchable: false},
                {data: 'release_date', name: 'release_date', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '30%'},
],
            // order: [[3, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            MovieTable.search(this.value).draw();
        });

        $('#genres').on('change' , function(){
            genres = $(this).val();
            MovieTable.ajax.reload();
        });

        $('#type').on('change' , function(){
            type = $(this).val();
            MovieTable.ajax.reload();
        })
        $('#actors').on('change' , function(){
            // alert('change');
            actor = $(this).val();
            MovieTable.ajax.reload();
        })

        $('#actors').select2({
            ajax: {
    url: '{{route('admin.movie.index')}}',
    dataType: 'json',
    data: function (params) {
        return  query = {
        search: params.term,
        }
    },
    processResults: function (data) {
      // Transforms the top-level key of the response object from 'items' to 'results'
    return {
        results: data
    };
    }
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
        });
    </script>

    @endpush
