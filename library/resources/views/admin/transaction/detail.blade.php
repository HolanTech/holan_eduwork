@extends('layouts.admin')

@section('header', 'Transaction')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6 mx-auto">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detail Transaction</h3>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-4"><label>Member Name:</label></div>
                        <div class="col-sm-8">
                            <h5 class="font-weight-bold">{{ $transactionDetails->member->name }}</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4"><label>Date Start:</label></div>
                        <div class="col-sm-8">
                            <h5 class="font-weight-bold">{{ $transactionDetails->date_start }}</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4"><label>Book:</label></div>
                        <div class="col-sm-8">
                            <ul class="list-unstyled">
                                @foreach ($books as $book)
                                    <li>{{ $book->title }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4"><label>Status:</label></div>
                        <div class="col-sm-8">
                            <h5 class="font-weight-bold">{{ validate_transactionStatus($transactionDetails->status) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('/transactions') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Styling -->
<style>
    .card-header {
        background-color: #2b579a;
        color: #ffffff;
    }

    .card-footer {
        background-color: #2b579a;
    }

    .card-footer a {
        color: #ffffff;
    }
</style>
<!-- Scripting -->
@push('scripts')
    <script>
        // JavaScript code goes here
    </script>
@endpush

<!-- Additional meta tags -->
@push('meta')
    <meta name="description" content="Transaction details page">
@endpush

<!-- Title -->
@section('title', 'Transaction Details')
