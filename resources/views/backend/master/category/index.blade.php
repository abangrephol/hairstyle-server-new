@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management'))

@section('page-header')
    <h1>
        Categories
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            @include('backend.master.category.partials.header-buttons')
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.access.users.table.name') }}</th>
                        <th>Description</th>
                        @if(access()->hasRole('Administrator'))
                            <th>Owner</th>
                        @endif
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{!! $category->name !!}</td>
                            <td>{!! $category->description !!}</td>
                            @if(access()->hasRole('Administrator'))
                                <td>{!! $category->owner->name !!}</td>
                            @endif
                            <td class="visible-lg">{!! $category->created_at->diffForHumans() !!}</td>
                            <td class="visible-lg">{!! $category->updated_at->diffForHumans() !!}</td>
                            <td>
                                @if($category->default && !access()->hasRole('Administrator'))
                                    Default
                                @else
                                    {!! $category->action_buttons !!}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $categories->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $categories->total()) }}
            </div>

            <div class="pull-right">
                {!! $categories->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop