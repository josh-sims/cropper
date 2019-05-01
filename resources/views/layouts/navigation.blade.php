<div class="uix-nav">
  <div class="container">
  	@if (Session()->get('loggedIn'))
  	<div class="row">
      <div class="col-sm-8 order-sm-last text-right">
          @if(\Route::current()->getName() == 'login')
          <a href="/edit/presets" onclick="if(!confirm('This will clear Cropper. Are you sure you\'re ready to leave this page?)){return false};" class="btn btn-primary btn-sm">Edit Presets</a>
          @endif
      		<a href="{{ route('logout') }}" class="btn btn-logout btn-sm">logout</a>
      </div>
    </div>
    @endif
    <div class="row">
      <div class="order-sm-first uix-nav-logo">
        <div><i class="icon-crop-solid"></i><span class="uix-nav-heading"><a href="/">Cropper</a></span></div>
      </div>
    </div>
  </div>
</div>
