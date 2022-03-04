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
                <li class="breadcrumb-item active">{{ $layoutTitle }} Index
                </li>
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
                            <a href="{{route('parcels.create')}}"
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
                // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
                    "url": "{{route('parcels.DTHandler')}}",
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
                // "order": [[5, 'desc']],
                "dom": 'Blfrtp',
                // "buttons": [
                //     {
                //         extend: 'excelHtml5',
                //         // text: 'Export XLSX',
                //     },
                //     {
                //         extend: 'pdfHtml5',
                //         // text: 'Export PDF',
                //         orientation: 'landscape',//landscape give you more space
                //         // pageSize: 'A0',//A0 is the largest A5 smallest(A0,A1,A2,A3,legal,A4,A5,letter))
                //     }
                // ],
                "columns": [
                    {"data": "id"},
                    {"data": "pick"},
                    {"data": "deliver"},
                    {
                        "data": "id",
                        // name: 'isActive',
                        render: function (data, type, row) {
                            var edit = '<a href="{{route('parcels.edit', [':id'])}}" data-original-title="" title=""><i class="fa fa-pencil font-medium-3 mr-2"></i></a>';
                            return edit.replace(':id', data);
                        }
                    }
                    // {
                    //     "data": "id",
                    //     render: function (data, type, row) {
                    //         var div = $('<div></div>');
                    //
                    //         if (row.blacklisted) {
                    //             div.append('<button type="button" class="btn btn-sm btn-danger mb-1 blacklist" value="' + blacklist_value_true + '">' + blacklist_text_true + '</button>');
                    //         } else {
                    //             div.append('<button type="button" class="btn btn-sm btn-success mb-1 blacklist" value="' + blacklist_value_false + '">' + blacklist_text_false + '</button>');
                    //         }
                    //         div.append('<input type="hidden" value="' + row['msisdn'] + '" />');
                    //         return div.html();
                    //     },
                    //     orderable: false
                    // }
                ],
                orderable: false
                // ,drawCallback: function () {
                //
                // }
            });
        });
    </script>
@endsection
