@extends('layouts.admin')
@section('header','Book')
@section('content')

<div id="controller">
    <div class="row">
        <div class="col-md-5 offset-md-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" autocomplete="off" placeholder="Search from title">
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary">Create New Book</button>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12" v-for="book in books">
        <div class="info-box">
            <div class="info-box-content">
            <span class="info-box-text h3">@{{ book.title }}@{{ (book.qty) }}</span>
                <span class="info-box-number">Rp.@{{ book.price }},-</span>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')


<script type="text/javascript">
    var actionUrl = '{{ url('books') }}';
    var apiUrl = '{{ url('api/books') }}';

    var app = new Vue({
        el: '#controller',
        data: {
            books: [],
        },
        mounted: function() {
            this.get_books();
        },
        methods: {
            get_books() {
                const _this = this;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(data) {
                        _this.books = JSON.parse(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        }
    });
</script>
@endsection
