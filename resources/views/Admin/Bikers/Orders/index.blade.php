@extends('Admin.Layouts.master')
@section('title'){{ $layoutTitle }}@endsection
@section('breadcrumb_header')
    <h3 class="content-header-title mb-0">{{ $layoutTitle }}</h3>
    <div class=" breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">{{ $layoutTitle }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/fonts/simple-line-icons/style.min.css">

    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/')}}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">

@endsection

@section('content')
    <!--Basic Table Starts-->
    <section id="simple-table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $layoutTitle}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-block">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Pick From</th>
                                    <th>Deliver To</th>
                                    <th>Current Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('assets/admin/')}}/app-assets/vendors/js/tables/jquery.dataTables.min.js"
            type="text/javascript"></script>

    <script
        src="{{asset('assets/admin/')}}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"
        type="text/javascript"></script>

    <script
        src="{{asset('assets/admin/')}}/app-assets/js/scripts/tables/datatables-extensions/datatables-sources.min.js"
        type="text/javascript"></script>
    <script>
        $(function () {
            var operatorData = $('.table').DataTable({
                'paging': true,
                'searching': true,
                'ordering': false,
                'info': true,
                'autoWidth': false,
                "serverSide": true,
                "processing": true,
                'language': {
                    "loadingRecords": "&nbsp;",
                    "processing": "Loading...",
                    "emptyTable": "No Data"
                },
                "ajax": {
                    "url": "{{route('biker.orders.DTHandler')}}",
                    "type": "POST",
                    "data": {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                "pageLength": 25,
                "scrollX": true,
                scrollY: 550,
                scrollCollapse: true,
                "rowId": "id",
                "dom": 'Blfrtp',
                "columns": [
                    {'data': 'id'},
                    {
                        render: function (data, type, row) {
                            return row['parcel']['pick'];
                        }
                    },
                    {
                        render: function (data, type, row) {
                            return row['parcel']['deliver'];
                        }
                    },
                    {
                        render: function (data, type, row) {
                            return row['status'];
                        }
                    },
                    {
                        "data": "id",
                        render: function (data, type, row) {
                            var cancel = '';
                            if (row['canBeCanceled']) {
                                cancel = '<button type="button" class="btn mr-1 mb-1 btn-danger btn-sm" data-toggle="modal" data-target="#order' + data + '">Cancel</button>'
                                cancel += '<div class="modal fade text-xs-left" id="order' + data + '" tabindex="-1" role="dialog" aria-hidden="true">';
                                cancel += ' <div class="modal-dialog modal-sm" role="document">'
                                    + '<div class="modal-content">'
                                    + '<div class="modal-header">'
                                    + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>'
                                    + '<h4 class="modal-title">Confirmation</h4>'
                                    + '</div><div class="modal-body">'
                                    + '<h5>Are you sure you want to cancel order #' + data + '</h5></div>'
                                    + '<div class="modal-footer">'
                                    + '<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>'
                                    + '<button type="button" class="btn btn-outline-primary cancelOrder" data-dismiss="modal" value="' + data + '">Yes</button>'
                                    + '</div></div></div>';
                            }
                            return cancel;
                        }
                    }
                ],
                orderable: false,
                drawCallback: function () {
                    $('.cancelOrder').on('click', function () {
                        var target = $(this);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('biker.orders.cancel') }}",
                            data: {
                                'id': target.val(),
                                '_token': '{{ csrf_token() }}'
                            },

                            success: function (data) {
                                if (data['status'] === true) {
                                    toastr.success('{{ \App\Abstraction\Classes\Common\FeedbackMessages::TOASTR_SUCCESS }}');
                                } else {
                                    toastr.error('{{ \App\Abstraction\Classes\Common\FeedbackMessages::TOASTR_ERROR }}');
                                }
                                $('.modal-backdrop').remove();
                                setTimeout(function () {
                                    location.reload();
                                }, 700);

                            }
                        });
                    });
                }
            });
        });
    </script>
@endsection
