@extends ('backend.layouts.master')

@section ('title', 'Reseller Management | Edit Reseller')

@section('page-header')
    <h1>
        Reseller Management
        <small>Edit Reseller</small>
    </h1>
@endsection

@section('content')
    {!! Form::model($user, ['route' => ['admin.reseller.users.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) !!}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Reseller</h3>

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

            @if ($user->id != 1)
                <div class="form-group">
                    <label class="col-lg-2 control-label">{{ trans('validation.attributes.backend.access.users.active') }}</label>
                    <div class="col-lg-1">
                        <input type="checkbox" value="1" name="status" {{$user->status == 1 ? 'checked' : ''}} />
                    </div>
                </div><!--form control-->

                <div class="form-group">
                    <label class="col-lg-2 control-label">{{ trans('validation.attributes.backend.access.users.confirmed') }}</label>
                    <div class="col-lg-1">
                        <input type="checkbox" value="1" name="confirmed" {{$user->confirmed == 1 ? 'checked' : ''}} />
                    </div>
                </div><!--form control-->
            @endif
        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.reseller.users.index')}}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
            </div>

            <div class="pull-right">
                <input type="submit" class="btn btn-success btn-xs" value="{{ trans('buttons.general.crud.update') }}" />
            </div>
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->

    @if ($user->id == 1)
        {!! Form::hidden('status', 1) !!}
        {!! Form::hidden('confirmed', 1) !!}
        {!! Form::hidden('assignees_roles[]', 1) !!}
    @endif

    {!! Form::close() !!}
@stop

@section('after-scripts-end')
    {!! Html::script('js/backend/access/permissions/script.js') !!}
    {!! Html::script('js/backend/access/users/script.js') !!}
@stop