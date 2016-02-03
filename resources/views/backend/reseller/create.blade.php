@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))

@section('page-header')
    <h1>
        Reseller Management
        <small>Create Reseller User</small>
    </h1>
@endsection

@section('content')
    {!! Form::open(['route' => 'admin.reseller.users.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Create Reseller User</h3>

            <div class="box-tools pull-right">
                @include('backend.reseller.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                {!! Form::label('name', trans('validation.attributes.backend.access.users.name'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.name')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('email', trans('validation.attributes.backend.access.users.email'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.email')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('password', trans('validation.attributes.backend.access.users.password'), ['class' => 'col-lg-2 control-label', 'placeholder' => trans('validation.attributes.backend.access.users.password')]) !!}
                <div class="col-lg-10">
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('password_confirmation', trans('validation.attributes.backend.access.users.password_confirmation'), ['class' => 'col-lg-2 control-label', 'placeholder' => trans('validation.attributes.backend.access.users.password_confirmation')]) !!}
                <div class="col-lg-10">
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                <label class="col-lg-2 control-label">{{ trans('validation.attributes.backend.access.users.active') }}</label>
                <div class="col-lg-1">
                    <input type="checkbox" value="1" name="status" checked="checked" />
                </div>
            </div><!--form control-->

            <div class="form-group">
                <label class="col-lg-2 control-label">{{ trans('validation.attributes.backend.access.users.confirmed') }}</label>
                <div class="col-lg-1">
                    <input type="checkbox" value="1" name="confirmed" checked="checked" />
                </div>
            </div><!--form control-->

            <div class="form-group">
                <label class="col-lg-2 control-label">{{ trans('validation.attributes.backend.access.users.send_confirmation_email') }}<br/>
                    <small>{{ trans('strings.backend.access.users.if_confirmed_off') }}</small>
                </label>
                <div class="col-lg-1">
                    <input type="checkbox" value="1" name="confirmation_email" />
                </div>
            </div><!--form control-->

        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.reseller.users.index')}}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
            </div>

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('buttons.general.crud.create') }}" />
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