@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))

@section('page-header')
    <h1>
        API Key Management
        <small>Change Subscription Plan</small>
    </h1>
@endsection

@section('content')
    {!! Form::model($apikey,['route' => ['admin.reseller.apikey.change',$apikey->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) !!}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Change Subscription Plan</h3>

            <div class="box-tools pull-right">
                @include('backend.reseller.apikey.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">


            <div class="form-group">
                {!! Form::label('client_id', 'Client', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <p class="form-control-static">
                        {!! $apikey->clients->clients->name !!}
                    </p>
                </div>
            </div><!--form control-->


            <div class="form-group">
                {!! Form::label('imei', 'IMEI', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <p class="form-control-static">
                        {!! $apikey->imei !!}
                    </p>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('api', 'API Key', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <p class="form-control-static">
                        {!! $apikey->api !!}
                    </p>
                </div>
            </div><!--form control-->
            <div class="form-group">
                {!! Form::label('currentplan', 'Current Plan', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <p class="form-control-static">
                        {!! $subinfo['name'] !!}
                    </p>
                </div>
            </div><!--form control-->
            <div class="form-group">
                {!! Form::label('plan', 'Change to Plan', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select name="plan" class="form-control">

                        @foreach ($plans as $plan)
                            <option value="{!! $plan->key !!}">{!! $plan->name !!}</option>
                        @endforeach
                    </select>
                </div>
            </div><!--form control-->


        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.reseller.apikey.index')}}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
            </div>

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('buttons.general.crud.update') }}" />
            </div>
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->

    {!! Form::close() !!}
@stop

@section('after-scripts-end')
    {!! Html::script('js/backend/access/permissions/script.js') !!}
    {!! Html::script('js/backend/access/users/script.js') !!}
@stop