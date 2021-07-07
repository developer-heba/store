<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductPriceValidation;
use App\Http\Requests\ProductStockRequest;
use App\Http\Requests\SliderImagesRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Tag;
use Illuminate\Http\Request;
use DB;
use Facade\FlareClient\Stacktrace\File;

class SliderController extends Controller
{


    public function addImages()
    {

         $images = Slider::all();
        return view('dashboard.sliders.images.create', compact('images'));
    }

    //to save images to folder only
    public function saveSliderImages(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = uploadImage('sliders', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    public function saveSliderImagesDB(SliderImagesRequest $request)
    {

        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Slider::create([
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->back()->with(['success' => ' هناك خطا ما ']);
        }
    }
    public function destroy($id)
    {

   $image=Slider::find($id);
   if($image){

    if(file_exists(public_path('assets/images/sliders/'.$image->photo))){
        unlink(public_path('assets/images/sliders/'.$image->photo));
      } 
    $image->delete();
    return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);
     
   }
}


}
