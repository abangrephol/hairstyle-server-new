@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))

@section('page-header')
    <h1>
        Frames Management
        <small>Create Frame</small>
    </h1>
@endsection

@section('content')
    {!! Form::open(['route' => 'admin.master.frame.store','files'=>true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Create Frame</h3>

            <div class="box-tools pull-right">
                @include('backend.master.frame.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">

            <div class="form-group">
                {!! Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Frame name']) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('description', 'Description', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control' , 'placeholder' => 'Description']) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('image_layout', 'Frame Layout', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::file('image_layout', ['class' => 'form-control' , 'placeholder' => 'Description']) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('image_background', 'Frame Background', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::file('image_background', ['class' => 'form-control' , 'placeholder' => 'Description']) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('image_foreground', 'Frame Foreground', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::file('image_foreground', ['class' => 'form-control' , 'placeholder' => 'Description']) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('image_preview', 'Frame Preview', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::file('image_preview', ['class' => 'form-control' , 'placeholder' => 'Description']) !!}
                </div>
            </div><!--form control-->

            @if(access()->hasRole('Administrator'))
                <div class="form-group">
                    <label class="col-lg-2 control-label">Default</label>
                    <div class="col-lg-1">
                        <input type="checkbox" value="1" name="default" checked="checked" />
                    </div>
                </div><!--form control-->


                <div class="form-group">
                    <label class="col-lg-2 control-label">Reseller<br/>
                        <small>(If Default is Off)</small>
                    </label>
                    <div class="col-lg-10">
                        <select name="user_id" class="form-control">

                            @foreach ($resellers as $reseller)
                                <option value="{!! $reseller->id !!}">{!! $reseller->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div><!--form control-->
            @else

                {!! Form::hidden('user_id', access()->id()) !!}
            @endif

        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.master.frame.index')}}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
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