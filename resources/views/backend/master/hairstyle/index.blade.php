@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management'))

@section('page-header')
    <h1>
        Hairstyles
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            @include('backend.master.hairstyle.partials.header-buttons')
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
                        <th class="visible-lg">Hairstyle Preview</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($hairstyles as $hairstyle)
                        <tr>
                            <td>{!! $hairstyle->name !!}</td>
                            <td>{!! $hairstyle->description !!}</td>
                            @if(access()->hasRole('Administrator'))
                                <td>{!! $hairstyle->owner->name !!}</td>
                            @endif
                            <td class="visible-lg" width="150px">
                                <img class="img-responsive " src="{!! url('/uploads/hairstyles/'.$hairstyle->image) !!}" />
                            </td>
                            <td class="visible-lg">{!! $hairstyle->created_at->diffForHumans() !!}</td>
                            <td class="visible-lg">{!! $hairstyle->updated_at->diffForHumans() !!}</td>
                            <td>
                                @if($hairstyle->default && !access()->hasRole('Administrator'))
                                    Default
                                @else
                                    {!! $hairstyle->action_buttons !!}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $hairstyles->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $hairstyles->total()) }}
            </div>

            <div class="pull-right">
                {!! $hairstyles->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop