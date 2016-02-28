@extends ('backend.layouts.master')

@section ('title', 'Client Management | Edit Client')

@section('page-header')
    <h1>
        Subscription Plan
        <small>Edit Plan</small>
    </h1>
@endsection

@section('content')
    {!! Form::model($plan, ['route' => ['admin.reseller.subscription.plan.update', $plan->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) !!}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Client</h3>

            <div class="box-tools pull-right">
                @include('backend.reseller.subscriptionplan.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                {!! Form::label('key', 'Unique ID', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-4">
                    {!! Form::text('key', null, ['class' => 'form-control', 'placeholder' => 'Unique ID']) !!}
                </div>
            </div><!--form control-->
            <div class="form-group">
                {!! Form::label('name', 'Plan Name', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-5">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.name')]) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('interval', 'Plan Interval', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-5">
                    {!! Form::select('interval',['weekly'=>'Weekly' , 'monthly'=>'Monthly' , 'quarterly'=>'Quarterly (3 Months)','yearly'=>'Yearly'],null,['class' => 'form-control']) !!}

                </div>
            </div><!--form control-->
            <div class="form-group">
                {!! Form::label('amount', 'Price', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-4">
                    {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Price']) !!}
                    <p class="help-block">Type Plan price in cent.</p>
                </div>

            </div><!--form control-->
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

    {!! Form::close() !!}
@stop

@section('after-scripts-end')
    {!! Html::script('js/backend/access/permissions/script.js') !!}
    {!! Html::script('js/backend/access/users/script.js') !!}
@stop