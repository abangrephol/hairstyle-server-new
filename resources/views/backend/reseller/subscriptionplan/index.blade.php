@extends ('backend.layouts.master')

@section ('title', 'App Clients')

@section('page-header')
    <h1>
        Subscription Plan
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Plan List</h3>
            <div class="box-tools pull-right">
                @include('backend.reseller.subscriptionplan.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ 'Unique ID' }}</th>
                        <th>{{ 'Plan Name' }}</th>
                        <th>{{ 'Plan Interval' }}</th>
                        <th>{{ 'Price' }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{!! $plan->key !!}</td>
                            <td>{!! $plan->name!!}</td>
                            <td>{!! ucwords($plan->interval) !!}</td>
                            <td>{!! 'SGD '.number_format(($plan->amount /100), 2, '.', ' ') !!}</td>
                            <td class="visible-lg">{!! $plan->created_at->diffForHumans() !!}</td>
                            <td class="visible-lg">{!! $plan->updated_at->diffForHumans() !!}</td>
                            <td>{!! $plan->action_buttons !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $plans->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $plans->total()) }}
            </div>

            <div class="pull-right">
                {!! $plans->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop