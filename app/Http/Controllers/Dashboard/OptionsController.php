<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\OptionsRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductPriceValidation;
use App\Http\Requests\ProductStockRequest;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Option;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use DB;

class OptionsController extends Controller
{

    public function index()
    {
         $options = Option::with(['product' => function ($prod) {
            $prod->select('id');
        }, 'attribute' => function ($attr) {
            $attr->select('id');
        }])->select('id', 'product_id', 'attribute_id', 'price')->paginate(PAGINATION_COUNT);

      return   view('dashboard.options.index', compact('options'));
    }

    public function create()
    {
        $data = [];
        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('dashboard.options.create', $data);
    }

    public function store(OptionsRequest $request)
    {


        DB::beginTransaction();

        //validation
        $option = Option::create([
            'attribute_id' => $request->attribute_id,
            'product_id' => $request->product_id,
            'price' => $request->price,
        ]);
        //save translations
        $option->name = $request->name;
        $option->save();
        DB::commit();

        return redirect()->route('admin.options')->with(['success' => 'تم ألاضافة بنجاح']);
    }

    

    public function getPrice($product_id)
    {

        return view('dashboard.products.prices.create')->with('id', $product_id);
    }

    public function saveProductPrice(ProductPriceValidation $request)
    {

        try {

            Product::whereId($request->product_id)->update($request->only(['price', 'special_price', 'special_price_type', 'special_price_start', 'special_price_end']));

            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {

        }
    }


    public function getStock($product_id)
    {

        return view('dashboard.products.stock.create')->with('id', $product_id);
    }

    public function saveProductStock(ProductStockRequest $request)
    {


        Product::whereId($request->product_id)->update($request->except(['_token', 'product_id']));

        return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);

    }

    public function addImages($product_id)
    {
        return view('dashboard.products.images.create')->withId($product_id);
    }

    //to save images to folder only
    public function saveProductImages(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = uploadImage('products', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    public function saveProductImagesDB(ProductImagesRequest $request)
    {

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

        } catch (\Exception $ex) {

        }
    }

    public function edit($id)
    {
     
        $products= Product::active()->select('id')->get();
        $attributes = Attribute::select('id')->get();
        //get specific categories and its translations
        $option= Option::orderBy('id', 'DESC')->find($id);

        if (!$option)
            return redirect()->route('admin.options')->with(['error' => 'هذا الخيار غير موجود ']);

        return view('dashboard.options.edit', compact('option','products','attributes'));

    }


    public function update($id, OptionsRequest $request)
    {
        


            $option= Option::orderBy('id', 'DESC')->find($id);

            if (!$option)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا الخيار غير موجود']);

                DB::beginTransaction();

                //validation
                $option->update([
                    'attribute_id' => $request->attribute_id,
                    'product_id' => $request->product_id,
                    'price' => $request->price,
                ]);
                //save translations
                $option->name = $request->name;
                $option->save();
                DB::commit();
        
                return redirect()->route('admin.options')->with(['success' => 'تم التحديث بنجاح']);

    }


    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $category = Category::orderBy('id', 'DESC')->find($id);

            if (!$category)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

            $category->delete();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
