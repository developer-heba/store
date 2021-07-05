<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductPriceValidation;
use App\Http\Requests\ProductStockRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use DB;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::select('id','slug','price', 'created_at')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $data = [];
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();


        return view('dashboard.products.create', $data);
    }

   /* public function store(GeneralProductRequest $request)
    {


        DB::beginTransaction();

        //validation

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        $product = Product::create([
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,
            'is_active' => $request->is_active,
        ]);
        //save translations
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->save();

        //save product categories

        $product->categories()->attach($request->categories);

        //save product tags

        DB::commit();
        return redirect()->route('admin.products')->with(['success' => 'تم ألاضافة بنجاح']);

    }*/


    
   //to save images to folder only
   public function saveProductImages(Request $request ){

    $file = $request->file('dzfile');
    $filename = uploadImage('products', $file);

    return response()->json([
        'name' => $filename,
        'original_name' => $file->getClientOriginalName(),
    ]);

}
//store all data
public function storeall(GeneralProductRequest $request)
{
    DB::beginTransaction();

    if (!$request->has('is_active'))
        $request->request->add(['is_active' => 0]);
    else
        $request->request->add(['is_active' => 1]);
 //prices

   if (!$request->has('price'))
      $price=null;
    else
    $price=  $request->price;

     //special_price

   if (!$request->has('special_price'))
   $special_price=null;
 else
 $special_price=  $request->special_price;

    //special_price_type

    if (!$request->has('special_price_type'))
    $special_price_type=null;
  else
  $special_price_type=  $request->special_price_type;

    //special_price_start

    if (!$request->has('special_price_start'))
    $special_price_start=null;
  else
  $special_price_start=  $request->special_price_start;


  
    //special_price_end

    if (!$request->has('special_price_end'))
    $special_price_end=null;
  else
  $special_price_end=  $request->special_price_end;

   //manage_stock
   if (!$request->has('sku'))
   $sku=null;
 else
 $sku=  $request->sku;


 if (!$request->has('manage_stock'))
 $manage_stock=0;
else
$manage_stock= $request->manage_stock;


if (!$request->has('in_stock'))
$in_stock=0;
else
$in_stock=  $request->in_stock;

if (!$request->has('qty'))
$qty=null;
else
$qty=  $request->qty;


    $product = Product::create([
        'slug' => $request->slug,
        'brand_id' => $request->brand_id,
        'is_active' => $request->is_active,
        'price' =>$price,
        'special_price'=>$special_price,
        'special_price_type'=>$special_price_type,
        'special_price_start'=>$special_price_start,
        'special_price_end'=>$special_price_end,
        'sku'=>$sku,
        'manage_stock'=>$manage_stock,
        'in_stock'=>$in_stock,
        'qty'=>$qty
    ]);
    //save translations
    $product->name = $request->name;
    $product->description = $request->description;
    $product->short_description = $request->short_description;
    $product->save();

   
    
    //save product images
    if($product->save()){
         //save product categories

    $product->categories()->attach($request->categories);

    //save product tags
    $product->tags()->attach($request->tags);

        if($request->has('document')&& count($request->document) > 0){
        foreach ($request->document as $image) {
                Image::create([
                    'product_id' => $product->id,
                    'photo' => $image,
                ]);
      

        }
        }


    }
    

    DB::commit();
    return redirect()->route('admin.products')->with(['success' => 'تم ألاضافة بنجاح']);


}


  /*  public function getPrice($product_id){

        return view('dashboard.products.prices.create') -> with('id',$product_id) ;
    }

    public function saveProductPrice(ProductPriceValidation $request){

        try{

            Product::whereId($request -> product_id) -> update($request -> only(['price','special_price','special_price_type','special_price_start','special_price_end']));

            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);
        }catch(\Exception $ex){

        }
    }

*/

    /*public function getStock($product_id){

        return view('dashboard.products.stock.create') -> with('id',$product_id) ;
    }

    public function saveProductStock (ProductStockRequest $request){


            Product::whereId($request -> product_id) -> update($request -> except(['_token','product_id']));

            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);

    }

    public function addImages($product_id){
        return view('dashboard.products.images.create')->withId($product_id);
    }*/

 

  public function saveProductImagesDB(ProductImagesRequest $request){

        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Image::create([
                        'product_id' => $request->product_id,
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);

        }catch(\Exception $ex){

        }
    }
    public function updateProductImagesDB(ProductImagesRequest $request,$id){
      
                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        try {
          
                if($request->has('document')&& count($request->document) ==1){
                    $image= Image::find($id);
                    if($image){
                        $image->update( ['photo' =>$request->document[0]]);
                    }
            
                    }
             
                    return $request;
            return redirect()->back();

        }catch(\Exception $ex){

        }
    }

    public function edit($id)
    {

        $data = [];
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();
        //get specific categories and its translations
        $data['product'] = Product::orderBy('id', 'DESC')->find($id);

        if (!$data['product'])
            return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);

        return view('dashboard.products.edit', $data);

    }


    public function update($id, Request $request)
    {
       
       

            $product =Product::find($id);

            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود']);
                DB::beginTransaction();

                if (!$request->has('is_active'))
                    $request->request->add(['is_active' => 0]);
                else
                    $request->request->add(['is_active' => 1]);
             //prices
            
               if (!$request->has('price'))
                  $price=null;
                else
                $price=  $request->price;
            
                 //special_price
            
               if (!$request->has('special_price'))
               $special_price=null;
             else
             $special_price=  $request->special_price;
            
                //special_price_type
            
                if (!$request->has('special_price_type'))
                $special_price_type=null;
              else
              $special_price_type=  $request->special_price_type;
            
                //special_price_start
            
                if (!$request->has('special_price_start'))
                $special_price_start=null;
              else
              $special_price_start=  $request->special_price_start;
            
            
              
                //special_price_end
            
                if (!$request->has('special_price_end'))
                $special_price_end=null;
              else
              $special_price_end=  $request->special_price_end;
            
               //manage_stock
               if (!$request->has('sku'))
               $sku=null;
             else
             $sku=  $request->sku;
            
            
             if (!$request->has('manage_stock'))
             $manage_stock=0;
            else
            $manage_stock= $request->manage_stock;
            
            
            if (!$request->has('in_stock'))
            $in_stock=0;
            else
            $in_stock=  $request->in_stock;
            
            if (!$request->has('qty'))
            $qty=null;
            else
            $qty=  $request->qty;
            
            
              $updateproduct=$product->update([
                    'slug' => $request->slug,
                    'brand_id' => $request->brand_id,
                    'is_active' => $request->is_active,
                    'price' =>$price,
                    'special_price'=>$special_price,
                    'special_price_type'=>$special_price_type,
                    'special_price_start'=>$special_price_start,
                    'special_price_end'=>$special_price_end,
                    'sku'=>$sku,
                    'manage_stock'=>$manage_stock,
                    'in_stock'=>$in_stock,
                    'qty'=>$qty
                ]);
                //save translations
                $product->name = $request->name;
                $product->description = $request->description;
                $product->short_description = $request->short_description;
                $product->save();
     
               
                
                //save product images
                if($product->save()&& $updateproduct){
                     //save product categories
            
                $product->categories()->attach($request->categories);
            
                //save product tags
                $product->tags()->attach($request->tags);

                if($request->has('image_id')){
                    if($request->has('document')&& count($request->document) ==1){
                        $image= Image::find($request->image_id);
                        if($image){
                            $image->update( ['photo' =>$request->document[0]]);
                        }
                
                        }
            
                }else{
                    if($request->has('document')&& count($request->document) > 0){
                        foreach ($request->document as $image) {
                                Image::create([
                                    'product_id' => $product->id,
                                    'photo' => $image,
                                ]);
                      
                
                        }
                        }

                }
                   
DB::commit();
            return redirect()->route('admin.products')->with(['success' => 'تم ألتحديث بنجاح']);
        
    }
}



    public function deleteProductImage($id)
    {

        try {
           
            //get specific categories and its translations
            $image = Image::orderBy('id', 'DESC')->find($id);

            if (!$image){
                return redirect()->back();
            }
            $image->delete();
        
        } catch (\Exception $ex) {
            
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
