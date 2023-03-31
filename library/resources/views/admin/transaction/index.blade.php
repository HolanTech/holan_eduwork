@extends('layouts.admin')
@section('header', 'Transaction')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    <div id="controller">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="width: 100%">
                        <div class="row">
                            <div class="col-md-10">
                                <a href="{{ route('transactions.create') }}"
                                    class="btn btn-sm btn-primary pull-right">Create New Transaction</a>
                            </div>
                            {{-- star-tambhakan filter berdasarkan status dan tanggal pinjam --}}
                            <div class="col-md-2">
                                <select class="form-control" name="filterStatus">
                                    <option value="2">All</option>
                                    <option value="0">Finished</option>
                                    <option value="1">Unfinished</option>
                                </select>
                            </div>

                            {{-- //end-tambhakan filter berdasarkan status dan tanggal pinjam jika di inpout tanggal ,maka memanggil data dari kolom date start --}}
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body" style="width: 100%">
                        <table id="dataTables" class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Date start</th>
                                    <th>Date End</th>
                                    <th>Name</th>
                                    <th>Period of loan(Days)</th>
                                    <th>total books</th>
                                    <th>total price</th>
                                    <th>status</th>
                                    <th class="text-right">action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script type="text/javascript">
        var actionUrl = `{{ url('transactions') }}`;
        var apiUrl = `{{ url('api/transactions') }}`;

        var columns = [{
                data: 'date_start',
                class: 'text-center',
                orderable: true,
                render: function(data, type, row) {
                    return moment(data).format('DD MMM YYYY');
                }
            },
            {
                data: 'date_end',
                class: 'text-center',
                orderable: true,
                render: function(data, type, row) {
                    return moment(data).format('DD MMM YYYY');
                }
            },
            {
                data: 'name',
                class: 'text-center',
                orderable: true,

            },
            {
                data: 'period',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'total_book',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'total_price',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'status_transaction',
                class: 'text-center',
                orderable: true
            },
            {
                render: function(index, row, data, meta) {
                    return `
    <a href="{{ url('/transactions/${data.transaction_id}/edit') }}" class="btn btn-warning btn-sm">
        Edit
    </a>
    <a href="{{ url('/transactions/${data.transaction_id}/show') }}" class="btn btn-primary btn-sm">
        Detail
    </a>
    <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.transaction_id})">
        Delete
    </a>`;
                },
                orderable: false,
                width: "200px",
                class: "text-center"
            },
        ];
        var controller = new Vue({
            el: '#controller',
            data: {
                datas: [],
                data: {},
                actionUrl,
                apiUrl,
            },
            mounted: function() {
                this.datatable();
            },
            methods: {
                datatable() {
                    const _this = this;
                    _this.table = $('#dataTables').DataTable({
                        ajax: {
                            url: _this.apiUrl,
                            type: 'GET',
                        },
                        columns: columns
                    }).on('xhr', function() {
                        _this.datas = _this.table.ajax.json().data;
                    });
                },
                addData() {
                    this.data = {};
                },
                deleteData(event, id) {
                    if (confirm("Are you sure?")) {
                        $(event.target).parents('tr').remove();
                        axios.post(this.actionUrl + '/' + id, {
                            _method: 'DELETE'
                        }).then(response => {
                            alert('Data has been remove');
                        });
                    }
                },
            }
        });
        // bind event untuk filter status dan tanggal pinjam
        $(document).ready(function() {
            // filter status
            $("select[name='filterStatus']").on("change", function() {
                controller.table.draw();
            });
            // filter tanggal pinjam
            $("select[name='filterDate']").on("change", function() {
                controller.table.draw();
            });
        });

        // membuat custom filter pada datatable
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var status = $("select[name='filterStatus']").val();


            // cek status
            if (status == "0") {
                if (data[6] == "Finished") {
                    return true;
                }
                return false;
            } else if (status == "1") {
                if (data[6] == "Unfinished") {
                    return true;
                }
                return false;
            }

            return true;



        });
    </script>


@endsection
