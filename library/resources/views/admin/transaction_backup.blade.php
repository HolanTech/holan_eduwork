@extends('layouts.admin')
@section('header', 'transactions')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    @role('admin')
        <div id="controller">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Add New
                                Transaction</a>
                        </div>

                        <div class="card-body" p-0>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>Date Start</th>
                                        <th>Date End</th>
                                        <th>Name</th>
                                        <th>Duration</th>
                                        <th>Books Total</th>
                                        <th>Price Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" :action="actionUrl" autocomplete="off" @submit="submitForm($event, data.id)">
                            <div class="modal-header">

                                <h4 class="modal-title">Transaction</h4>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @csrf

                                <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                                <div class="form-group">
                                    <label>Member</label>
                                    <select class="form-control select2" name="name" style="width: 100%;">
                                        <option value="">-Select Member</option>

                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->name }}</option
                                                :value="data.name">
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Date Start</label>
                                    <input type="date" class="form-control" name="date_start":value="data.date_start">
                                </div>
                                <div class="form-group">
                                    <label>Date_End</label>
                                    <input type="date" class="form-control" name="date_end":value="data.date_end">
                                </div>
                                <div data-select2-id="">
                                    <label>Book</label>
                                    <div class="select2-primary">
                                        <select name="book" class="select2" multiple="multiple"
                                            data-placeholder="Select Books" data-dropdown-css-class="select2-primary"
                                            style="width: 100%;">
                                            <option value="">-Select Book</option>

                                            @foreach ($books as $book)
                                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" id="saveBtn">Simpan</button>
                            </div>
                    </div>
                </div>
            </div>
        @endrole
    @endsection

    @section('js')

        < !--DataTables & Plugins-->
            <script script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
            <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
            <script type="text/javascript">
                var actionUrl = "{{ url('transactions') }}";
                var actionapi = "{{ url('api/transactions') }}";

                var columns = [

                    {
                        data: 'date_start',
                        class: 'text-center',
                        orderable: true
                    },
                    {
                        data: 'date_end',
                        class: 'text-left',
                        orderable: true
                    },
                    {
                        data: 'name',
                        class: 'text-left',
                        orderable: false
                    },
                    {
                        data: 'duration',
                        class: 'text-center',
                        orderable: false
                    },
                    {
                        data: 'qty',
                        class: 'text-left',
                        orderable: false
                    },
                    {
                        data: 'total_transaction',
                        class: 'text-center',
                        orderable: false
                    },
                    {
                        data: 'status',
                        class: 'text-center',
                        orderable: false
                    },
                    {
                        render: function(index, row, data, meta) {
                            return `
                    <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event, ${meta.row})">Edit</a>
                  
                    <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event,${data.id})">Delete</a>
                `;
                        },
                        orderable: false,
                        width: '200px',
                        class: 'text-center'
                    },
                ];

                var controller = new Vue({
                    el: '#controller',
                    data: {
                        datas: [],
                        data: {},
                        actionUrl: actionUrl,
                        apiUrl: actionapi,
                        editStatus: false
                    },
                    mounted: function() {
                        this.datatable();
                    },
                    methods: {
                        datatable: function() {
                            var _this = this;
                            _this.table = $('#datatable').DataTable({
                                ajax: {
                                    url: _this.apiUrl,
                                    type: 'GET'
                                },
                                columns: columns
                            }).on('xhr', function() {
                                _this.datas = _this.table.ajax.json().data;
                            });
                        },
                        addData() {
                            this.data = {};
                            this.actionUrl = '{{ url('transactions') }}';
                            this.editStatus = false;
                            $('#modal-default').modal();
                        },
                        editData(event, row) {
                            this.data = this.datas[row];
                            this.editStatus = true;
                            $('#modal-default').modal();
                        },
                        // detailData(event, id) {
                        //     this.data = this.datas[id];
                        //     this.editStatus = true;
                        //     $('#modal-default').modal();
                        // },
                        deleteData(event, id) {
                            if (confirm("Are you sure ?")) {
                                $(event.target).parents('tr').remove();
                                axios.post(this.actionUrl + '/' + id, {
                                    _method: 'DELETE'
                                }).then(response => {
                                    alert('Data has been remove');
                                });
                            }
                        },
                        submitForm(event, id) {
                            event.preventDefault();
                            const _this = this;
                            var actionUrl = !this.editStatus ? this.actionUrl : this.actionUrl + '/' + id;
                            axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {
                                $('#modal-default').modal('hide');
                                _this.table.ajax.reload();
                            })

                        }

                    }
                });
            </script>
            <script>
                $(function() {
                    //Initialize Select2 Elements
                    $('.select2').select2()

                    //Initialize Select2 Elements
                    $('.select2bs4').select2({
                        theme: 'bootstrap4'
                    })
                })
            </script>
            <script>
                $(function() {
                    $("#datatable").DataTable();
                })
            </script>
        @endsection
