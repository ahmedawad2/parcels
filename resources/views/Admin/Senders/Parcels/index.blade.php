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
                        <div class="heading-elements">
                            <a href="{{route('sender.parcels.create')}}"
                               class="btn btn-blue">Add {{Str::singular($layoutTitle)}}</a>
                        </div>
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
    <!--Basic Table Ends-->
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
                    "url": "{{route('sender.parcels.DTHandler')}}",
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
                    {"data": "id"},
                    {"data": "pick"},
                    {"data": "deliver"},
                    {
                        "data": "id",
                        render: function (data, type, row) {
                            return row['status'];
                        }
                    },
                    {
                        "data": "id",
                        render: function (data) {
                            var edit = '<a href="{{route('sender.parcels.edit', [':id'])}}" data-original-title="" title=""><i class="fa fa-pencil font-medium-3 mr-2"></i></a>';
                            return edit.replace(':id', data);
                        }
                    }
                ],
                orderable: false
            });
        });
    </script>
@endsection
