<?php
namespace App\Uploaders;

use Illuminate\Support\Facades\Storage;

class addImg
{
  public function execute($img){
      $fii = 1;
      if(Storage::disk('local')->has('/public/uploads/'.$img->getClientOriginalName())){
        $i_extension = $img->getClientOriginalExtension();
        $i_filename = str_replace(".".$i_extension,"", $img->getClientOriginalName());
        while(Storage::disk('local')->has('/public/uploads/'.$i_filename.".".$i_extension)){
          $fii++;
          $i_filename = str_replace(".".$i_extension, "", $img->getClientOriginalName());
          $i_filename = $i_filename.$fii;
        }
        $i_filename = $i_filename.".".$i_extension;
      }else{
        $i_filename = $img->getClientOriginalName();
      }
      
      $img->storeAs('/public/uploads', $i_filename);
      return $i_filename;
  }
}
?>
