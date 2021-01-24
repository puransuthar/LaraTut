<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\AjaxImage;

class AjaxImageUploadController extends Controller
{
    public function ajaxImageUpload(){
        return view('ajaxImageUpload');
    }
    public function ajaxImageUploadPost(Request $request){
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png|max:2048'
        ]);
        if($validation->passes()){
            $new = new AjaxImage;
            $image = $request->file('image');
            $new_name = rand() . "." . $image->getClientOriginalExtension(); 
            $image->move(public_path("images"), $new_name);
            $title = $request->input('title');
            $new->title = $title;
            $new->image = $new_name;
            $new->save();
            return response()->json([
                'message' =>  'Image Uploaded Successfully',
                'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
                'class_name' => 'alert-success'
            ]);
        }
        else{
            return response()->json([
                'message' =>  $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name' => 'alert-danger' 
            ]);
        }
    }
}
