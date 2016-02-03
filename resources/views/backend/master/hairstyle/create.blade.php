@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))

@section('page-header')
    <h1>
        Frames Management
        <small>Create Frame</small>
    </h1>
@endsection

@section('content')
    {!! Form::open(['route' => 'admin.master.hairstyle.store','files'=>true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Create Frame</h3>

            <div class="box-tools pull-right">
                @include('backend.master.hairstyle.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">

            <div class="form-group">
                {!! Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Hairstyle name']) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('description', 'Description', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control' , 'placeholder' => 'Description']) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('image', 'Hairstyle Image', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::file('image', ['id'=>'image','class' => 'form-control' , 'placeholder' => 'Description']) !!}
                    <div id="singlePreview" class="clearfix"></div>
                </div>
            </div><!--form control-->

            <div class="form-group">
                {!! Form::label('midoint', 'Hair Midpoint', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-2">
                    {!! Form::text('Xpoint', null, ['id'=>'Xpoint', 'class' => 'form-control', 'readonly']) !!}
                </div>
                <div class="col-lg-2">
                    {!! Form::text('Ypoint', null, ['id'=>'Ypoint','class' => 'form-control', 'readonly']) !!}
                </div>
            </div><!--form control-->

            <div class="form-group">
                <label class="col-lg-2 control-label">Category</label>
                <div class="col-lg-10">
                    <select name="category_id" class="form-control">

                        @foreach ($categories as $category)
                            <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                        @endforeach
                    </select>
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
    {!! Html::script('js/backend/master/jquery.pointr.js') !!}
    <script>
        jQuery(document).ready(function($) {
            // Single Image
            // we wait for the file input to change
            $('#image').on('change', function(event) {
                // we fetch the file data
                var image = this.files[0]; // not $(this)

                //now, we need to empty the preview div because if not, the image selected will append to what was there alread.

                $('#singlePreview').html(''); //we set the innerHTML of the div to null

                var reader = new FileReader(); // the jQuery FileReader class
                reader.onload = function(e){ // whatever we want FileReader to do, wee need to do that when it loads
                    $('<img id="imagePreview" src="' + e.target.result + '" class="img-responsive" alt="Loading..">').appendTo($('#singlePreview'));

                    $("#imagePreview").pointr({
                        callback: function (x, y) {
                            $("#Xpoint").val(x.toFixed(6));
                            $("#Ypoint").val(y.toFixed(6));
                        }
                    });
                    //	What we just did:
                    //	we fetched the base64 data of the image (e.target.result)
                    //	and assigned to a new img element's src attribute
                    //	then appended it to the preview div.
                    //	for more info on FileReader() and jQuery's appendTo() please check the links in the articla.
                }
                reader.readAsDataURL(image); // this gives our file to the FileReader() and uses the onload function to do our bidding.
            });

        });

    </script>
@stop