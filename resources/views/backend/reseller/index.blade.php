@extends ('backend.layouts.master')

@section ('title', 'Resellers')

@section('page-header')
    <h1>
        Resellers
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Active Resellers</h3>
            <div class="box-tools pull-right">
                @include('backend.reseller.partials.header-buttons')
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
                    @foreach ($users as $user)
                        <tr>
                            <td>{!! $user->name !!}</td>
                            <td>{!! $user->email !!}</td>
                            <td class="visible-lg">{!! $user->created_at->diffForHumans() !!}</td>
                            <td class="visible-lg">{!! $user->updated_at->diffForHumans() !!}</td>
                            <td>{!! $user->action_buttons !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $users->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $users->total()) }}
            </div>

            <div class="pull-right">
                {!! $users->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop