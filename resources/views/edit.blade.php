@extends ('layout')

@if (Session()->get('loggedIn'))

@section ('content')

  <div class="row">
    <div class="col-sm-10">
    <h4>Crop, resize, scale to fit, do magic...</h4>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <hr>
    <div>
</div>
@if (!empty($preview)) 
<p><b>Preview:</b></p>
<div class="row">
    <div class="col-12">
        <p><a href="{{$preview}}" target="_blank"><img src="{{$preview}}" alt="preview"></a></p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <p><a href="/download/{{$preview}}" target="_blank"><i class="icon-download-solid"></i> Download</a></p>
    </div>
</div>
<hr>
@endif
@if(!$presets->isEmpty())
<div class="row">
    <div class="col-12">
        <div class="presets">
            <p><label>Remove presets:</label><br>
            <i>scroll to see all of your presets. </i></p>
            <div class="presetsScroller full">
                    @foreach ($presets as $pst)
                    <div><a href="/delete/{{ $pst->id }}"><i class="icon-times-circle-solid" title="delete preset"></i></a>&nbsp;&nbsp;&nbsp;<a href class="pres" data-mode="{{ $pst->mode }}" data-x="{{ $pst->xval }}" data-y="{{ $pst->yval }}" data-position="{{ $pst->position }}" data-width="{{ $pst->width }}" data-height="{{ $pst->height }}" data-name="{{ $pst->presetName }}">{{ $pst->presetName }}</a></div>
                    @endforeach
            </div>
            <br>
            <p><a href="/" onclick="if(!confirm('This will clear Cropper. Are you sure you\'re ready to leave this page?)){return false};" class="btn btn-secondary btn-sm">I'm Done</a></p>
        </div>
    </div>
</div>
@else
    <script type="text/javascript">
        window.location = "/";
    </script>
@endif

@endsection


@else
    <script type="text/javascript">
        window.location = "/";
    </script>
@endif
