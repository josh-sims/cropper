<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\ImageManagerStatic as Image;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Uploaders\addImg;
use App\preset;


class CropperController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function __construct()
  	{
  		Image::configure(array('driver' => 'imagick'));
  	}

	public function index()
	{
		$presets = preset::all()->where('user', Session()->get('email'));
		return view('cropper', compact('presets'));

	}


	public function download($file){
		$file = 'public/tmp/'.$file;
		return Storage::download($file);
	}


	public function imgfix(Request $request)
	{


		$presets = preset::where('presetName', $request->presetName)->first();	

		if(!is_numeric($request->width)){
			return Redirect::back()->withErrors(['Width must be a number']);
		}
		if($request->width < 1){
			return Redirect::back()->withErrors(['Width must be a positive number']);
		}

		if(!is_numeric($request->height)){
			return Redirect::back()->withErrors(['Height must be a number']);
		}
		if($request->height < 1){
			return Redirect::back()->withErrors(['Height must be a positive number']);
		}

		if($request->xval){
			if(!is_numeric($request->xval)){
				return Redirect::back()->withErrors(['X Value must be a number']);
			}
			if($request->xval < 1){
				return Redirect::back()->withErrors(['X Value must be a positive number']);
			}
		}

		if($request->yval){
			if(!is_numeric($request->yval)){
				return Redirect::back()->withErrors(['Y Value must be a number']);
			}
			if($request->yval < 1){
				return Redirect::back()->withErrors(['Y Value must be a positive number']);
			}
		}	

		$preview = array();
		$imgcount = count($request->img);



		for($i=0; $i < $imgcount; $i++){
			$file = new addImg();
	      	$fn = (string)$file->execute($request->img[$i]);
	      	$extension = explode(".", $fn);
	      	for($ii=0;$ii<count($extension);$ii++){
	      		$fe = $extension[$ii]; 
	      	}
	      	$img = Image::make('storage/uploads/'.$fn);

	      	switch($request->mode){
	      		case 'crop':
				$img->crop($request->width, $request->height, $request->xval, $request->yval);
				break;

	      		case 'fit':
	      		if($request->position){
	      			$pos = $request->position;
	      		}else{
	      			$pos = 'center';
	      		}
	      		$img->fit($request->width, $request->height, function ($constraint) {
	    			$constraint->upsize();
				},$pos);
	      		break;
				
				case 'resize':
				if($request->width == 'auto'){
					$img->resize(null, $request->height, function ($constraint) {
					    $constraint->aspectRatio();
					});
				}else if($request->height == 'auto'){
					$img->resize($request->width, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				}else{
					$img->resize($request->width, $request->height);
				}
				break;
	      	}

	      	$now = Carbon::now()->format('Y-m-d-H-i-s');
    		$img->save( 'storage/tmp/'.$fn.$now.'.'.$fe);
    		array_push($preview, 'storage/tmp/'.$fn.$now.'.'.$fe);
    	}

    	$now = Carbon::now()->format('Y-m-d-H-i-s');

		Zipper::make('storage/compressed/'.$now.'.zip')->add($preview)->close();
		$zipurl = 'storage/compressed/'.$now.'.zip';
    	$preview = serialize($preview);

    	if(($request->presetName) && (is_null($presets))){

			$preset = new preset;

			$preset->presetName = $request->presetName;
			$preset->mode = $request->mode;
			$preset->width = $request->width;
			$preset->height = $request->height;
			$preset->xval = $request->xval;
			$preset->yval = $request->yval;
			$preset->position = $request->position;
			$preset->user = $request->user;

			$preset->save();

		}

    	return redirect(route('login'))->with('preview', $preview)->with('zipurl', $zipurl);
	}

	public function editPresets(){
		$presets = preset::all()->where('user', Session()->get('email'));
    	return view('edit', compact('presets'));
	}

	public function destroyPreset($id){
		$preset = preset::find($id);
      	$preset->delete();
      	$presets = preset::all()->where('user', Session()->get('email'));
    	return redirect('/edit/presets');

	}

	
}
