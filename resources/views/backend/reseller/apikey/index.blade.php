@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management'))

@section('page-header')
    <h1>
        API Key Management
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Active API Key</h3>
            @include('backend.reseller.apikey.partials.header-buttons')
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>IMEI</th>
                        <th>API</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($apikeys as $apikey)
                        <tr>
                            <td>{!! $apikey->clients->clients->name !!}</td>
                            <td>{!! $apikey->imei !!}</td>
                            <td>{!! $apikey->api !!}</td>
                            <td class="visible-lg">{!! $apikey->created_at->diffForHumans() !!}</td>
                            <td class="visible-lg">{!! $apikey->updated_at->diffForHumans() !!}</td>
                            <td>{!! $apikey->action_buttons !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $apikeys->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $apikeys->total()) }}
            </div>

            <div class="pull-right">
                {!! $apikeys->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop