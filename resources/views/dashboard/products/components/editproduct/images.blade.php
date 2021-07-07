<h4 class="form-section"><i class="ft-home"></i> صور المنتج </h4>

@if($product->images->first()!=null)
    <div class="row">
    @foreach ($product->images as $image)
    
    <div  class="image-{{$image->id}} col-3" style="margin-bottom:50px;margin-left:10px;margin-top:20px;border-radius:5px;"><img src="{{asset('assets/images/products/'.$image->photo)}}" width="200" height="200" style="display:block;">
        <a class="btn btn-outline-primary edit-image" 
         data-id='{{$image->id}}' style="width:100px;">
        تعديل الصورة
    </a>
        <a  class="btn btn-outline-primary  " href="{{asset('admin/products/images/delete/'.$image->id)}} "
        style="width:100px;">
        حذف الصورة
        </a>
  </div>
    @endforeach
    <div class="col-12">
    <div class="btn btn-outline-primary add-image  "
    data-id='{{$image->id}}' style="width:200px;margin-bottom:20px;">
   اضافة صورة جديدة
    </div>
    </div>
    <div class='col-12'>
    <div class="form-group dpf-edit" style="display:none;">
      <div id="dpz-multiple-files" class="dropzone dropzone-area">
          <div class="dz-message">يمكنك رفع اكثر من صوره هنا</div>
      </div>
      <br><br>
  </div>
    </div>
    @else
  
    <div class="form-group dpf-edit">
        <div id="dpz-multiple-files" class="dropzone dropzone-area">
            <div class="dz-message">يمكنك رفع اكثر من صوره هنا</div>
        </div>
        <br><br>
    </div>
   
    @endif


