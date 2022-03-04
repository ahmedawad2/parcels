@extends('Admin.Layouts.master')

@section('title'){{$layoutTitle.' | Create'}}@endsection

@section('breadcrumb_header')
    <h3 class="content-header-title mb-0">{{$layoutTitle}}</h3>
    <div class=" breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('parcels.index')}}">{{ $layoutTitle }}</a>
                </li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <section id="daterange">
        <div class="row">
            <div class="col-md-12">
                <!-- form card-->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $layoutTitle }}</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body collapse in">
                        <div class="card-block">


                            <form class="form" method="post"
                                  action="{{route('parcels.store')}}">
                                {{csrf_field()}}
                                <div class="form-body">
                                    <h4 class="form-section">{{ Str::singular($layoutTitle) }}</h4>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pick">Pick</label>
                                                <input name="pick" type="text" class="form-control" id="pick" value=""
                                                       required="required"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="deliver">Deliver</label>
                                                <input name="deliver" type="text" class="form-control" id="deliver" value=""
                                                       required="required"/>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="form-actions right">
                                        <a href="{{route('parcels.index')}}"
                                           class="btn btn-warning mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

