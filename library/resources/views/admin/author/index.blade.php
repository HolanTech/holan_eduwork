@extends('layouts.admin')
@section('header','Author')
@section('content')
            <div class="row">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ url('authors/create') }}"class="btn btn-sm btn-primary pull-right">Create new Author</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Id</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">E-mail</th>
                                        <th class="text-center">Phone Number</th>
                                        <th class="text-center">Adress</th>
                                        <th class="text-center">Created at</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($authors as $key => $author)
                                   
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $author->name }}</td>
                                        <td>{{ $author->email }}</td>
                                        <td>{{ $author->phone_number }}</td>
                                        <td>{{ $author->address }}</td>
                                        <td class="text-center">{{ date('H:i:s-d/M/Y',strtotime($author->created_at)) }}  </td>
                                        

                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
    

@endsection