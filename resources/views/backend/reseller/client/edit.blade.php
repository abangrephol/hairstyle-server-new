@extends ('backend.layouts.master')

@section ('title', 'Client Management | Edit Client')

@section('page-header')
    <h1>
        Client Management
        <small>Edit Client</small>
    </h1>
@endsection

@section('content')
    {!! Form::model($user, ['route' => ['admin.reseller.client.update', $client->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) !!}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Client</h3>

            <div class="box-tools pull-right">
                @include('backend.reseller.client.partials.header-buttons')
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

            @if(access()->hasRole('Administrator'))
                <div class="form-group">
                    {!! Form::label('group', 'Reseller', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        <select name="reseller_id" class="form-control">

                            @foreach ($resellers as $reseller)
                                <option value="{!! $reseller->id !!}" {!! $reseller->id == $client->reseller_id ? 'selected' : '' !!}>{!! $reseller->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div><!--form control-->
            @endif

        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.reseller.client.index')}}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
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