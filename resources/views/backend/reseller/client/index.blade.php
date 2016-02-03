@extends ('backend.layouts.master')

@section ('title', 'App Clients')

@section('page-header')
    <h1>
        App Clients
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Active Clients</h3>
            <div class="box-tools pull-right">
                @include('backend.reseller.client.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.access.users.table.name') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.email') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{!! $client->clients->name !!}</td>
                            <td>{!! $client->clients->email !!}</td>
                            <td class="visible-lg">{!! $client->created_at->diffForHumans() !!}</td>
                            <td class="visible-lg">{!! $client->updated_at->diffForHumans() !!}</td>
                            <td>{!! $client->action_buttons !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $clients->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $clients->total()) }}
            </div>

            <div class="pull-right">
                {!! $clients->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop