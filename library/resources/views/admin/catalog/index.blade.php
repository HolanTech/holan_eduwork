@extends('layouts.admin')
@section('header', 'Catalog')
@section('content')

    @role('admin')
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('catalogs/create') }}"class="btn btn-sm btn-primary pull-right">Create new catalog</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Book Total</th>
                                    <th class="text-center">Created at</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($catalogs as $key => $catalog)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $catalog->name }}</td>
                                        <td class="text-center">{{ count($catalog->books) }}</td>
                                        <td class="text-center">{{ convert_date($catalog->created_at) }} </td>
                                        <td class="text-center">
                                            <a href="{{ url('catalogs/' . $catalog->id . '/edit') }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ url('catalogs/' . $catalog->id) }}"method="post">
                                                <input class="btn btn-danger btn-sm" type="submit" value="Delete"
                                                    onclick="return confirm ('are you sure ?')">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    @endrole

@endsection
