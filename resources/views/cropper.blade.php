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
@if (Session::get('preview')) 
<p><b>Previews:</b></p>
    
    <div class="row">
        <div class="col-12">
            <div class="previews">
                @foreach(unserialize(Session::get('preview')) as $previmg)
                    <a href="{{ $previmg }}" target="_blank"><img src="{{ $previmg }}" alt="preview" class="thumbnail"></a>&nbsp;  
                @endforeach
            </div>
        </div>
    </div>
<br>
<a href="{{ Session::get('zipurl') }}"><i class="icon-download-solid"></i>&nbsp;Download</a>
<hr>
@endif
@if(!$presets->isEmpty())
<div class="row">
    <div class="col-12">
        <div class="presets">
            <p><label>Create from preset (optional):</label><br>
            <i>scroll to see all of your presets</i></p>
            <div class="presetsScroller">
                @foreach ($presets as $pst)
                <div><a href class="pres" data-mode="{{ $pst->mode }}" data-x="{{ $pst->xval }}" data-y="{{ $pst->yval }}" data-position="{{ $pst->position }}" data-width="{{ $pst->width }}" data-height="{{ $pst->height }}" data-name="{{ $pst->presetName }}">{{ $pst->presetName }}</a></div>
                @endforeach
            </div>
            <hr>
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-sm-12">
      <form method="POST" action="create" id="cropForm" enctype="multipart/form-data" accept-charset="UTF-8">
        {{ csrf_field() }}
        
        <p class="uploader-button"><input class="form-control-file" type="file" id="img" name="img[]" multiple required onchange="javascript:updateList('img','fileList')" value="{{ old('img[]') }}"><i>(.jpg, .png, .gif)</i></p>
        <div id="fileList"></div>
        <div class="form-group">
        <div class="form-row">
          <div class="form-group col-md-12">
            <p><label for="width">How do you want to resize:</label><br>
            <select name="mode" id="mode">
                <option value="crop">crop</option>
                <option value="fit">fit</option>
                <option value="resize">resize</option>
            </select>
            </p>

            <div class="croptions">
                <p><label for="xval">X value (optional):</label><br>
                <i>X-Coordinate of the top-left corner of the rectangular cutout. By default the rectangular part will be centered on the current image.</i>
                <input type="text" class="form-control" id="xval" name="xval" value="{{ old('xval') }}" maxlength="50"></p>
                <p><label for="yval">Y value (optional):</label><br>
                <i>Y-Coordinate of the top-left corner of the rectangular cutout. By default the rectangular part will be centered on the current image.</i>
                <input type="text" class="form-control" id="yval" name="yval" value="{{ old('yval') }}" maxlength="50"></p>   
                <hr>         
            </div>
            <div class="fitions">
                <hr>
                <p><label for="products">Position (optional):</label><br/>
                <span class="callout"><i>Choose a position to select an anchor point for the resize. If you don't select a position, it will resize using the center of the image as the anchor.</i></span></p>
                <select name="position" id="position">
                    <option value="">select a position...</option>
                    <option value="top-left">top-left</option>
                    <option value="top">top</option>
                    <option value="top-right">top-right</option>
                    <option value="left">left</option>
                    <option value="center">center</option>
                    <option value="right">right</option>
                    <option value="bottom-left">bottom-left</option>
                    <option value="bottom">bottom</option>
                    <option value="bottom-right">bottom-right</option>
                </select>
                <hr>
            </div>

            <p><label for="width"><span class="asterisk">*</span>Width:</label>
            <input type="text" class="form-control" id="width" name="width" value="{{ old('width') }}" maxlength="50" required>
            <span class="callout"><i>(use 'auto' for auto width)</i></span>
            </p>
            <p><label for="height"><span class="asterisk">*</span>Height:</label>
            <input type="text" class="form-control" id="height" name="height" value="{{ old('height') }}" maxlength="50" required>
            <span class="callout"><i>(use 'auto' for auto height)</i></span>
            </p>

            <p>
                <input type="checkbox" name="savePreset" id="savePreset" value="savePreset">&nbsp;&nbsp;<b>Save as preset?</b>
            </p>

            <div class="preset">
                <p><label for="presetName">Preset Name:</label>
                <input type="text" class="form-control" id="presetName" name="presetName" value="{{ old('presetName') }}" maxlength="50">
                <span class="callout"><i>You can save your settings for next time. Just give the preset a name.</i></span>
                </p>
            </div>

          </div>
        </div>
        <input type="hidden" name="user" id="user" value="{{Session()->get('email')}}">
        <button type="submit" class="btn btn-primary">Resize</button>&nbsp;&nbsp;<a href="/" onclick="return confirm('Are you ready to clear Cropper and upload another image?')" class="btn btn-outline-primary">Clear Cropper</a>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </div>
      </form>
    </div>
  </div>

@endsection

@else
    <script type="text/javascript">
        window.location = "/";
    </script>
@endif
