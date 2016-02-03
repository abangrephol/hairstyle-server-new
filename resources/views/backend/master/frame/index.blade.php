@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management'))

@section('page-header')
    <h1>
        Frames
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            @include('backend.master.frame.partials.header-buttons')
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
                        <th class="visible-lg">Frame Preview</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($frames as $frame)
                        <tr>
                            <td>{!! $frame->name !!}</td>
                            <td>{!! $frame->description !!}</td>
                            @if(access()->hasRole('Administrator'))
                                <td>{!! $frame->owner->name !!}</td>
                            @endif
                            <td class="visible-lg" width="150px">
                                <img class="img-responsive " src="{!! url('/uploads/frames/'.$frame->image_preview) !!}" />
                            </td>
                            <td class="visible-lg">{!! $frame->created_at->diffForHumans() !!}</td>
                            <td class="visible-lg">{!! $frame->updated_at->diffForHumans() !!}</td>
                            <td>
                                @if($frame->default && !access()->hasRole('Administrator'))
                                    Default
                                @else
                                    {!! $frame->action_buttons !!}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $frames->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $frames->total()) }}
            </div>

            <div class="pull-right">
                {!! $frames->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop