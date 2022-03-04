@extends(config('master.layouts.admin'))
@section('styles')
    <!-- BEGIN DATATABLE CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset(config('master.assets.admin.path'))}}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <!-- END DATATABLE CSS-->

@endsection

@section('scripts')
    <!-- BEGIN PAGE VENDOR JS DATATABLE JS-->
    <script src="{{asset(config('master.assets.admin.path'))}}/app-assets/vendors/js/tables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="{{asset(config('master.assets.admin.path'))}}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"
            type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN PAGE LEVEL JS DATATABLE JS-->
    <script src="{{asset(config('master.assets.admin.path'))}}/app-assets/js/scripts/tables/datatables/datatable-basic.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
@endsection