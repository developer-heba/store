<form class="form"
action="{{route('admin.products.store')}}"
method="POST"
enctype="multipart/form-data">
@csrf
<div class="form-body">

  <h4 class="form-section"><i class="ft-home"></i> البيانات الاساسية للمنتج   </h4>
  <div class="row">
      <div class="col-md-6">
          <div class="form-group">
              <label for="projectinput1"> اسم  المنتج
              </label>
              <input type="text" id="name"
                     class="form-control"
                     placeholder="  "
                     value="{{old('name')}}"
                     name="name">
              @error("name")
              <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group">
              <label for="projectinput1"> اسم بالرابط
              </label>
              <input type="text"
                     class="form-control"
                     placeholder="  "
                     value="{{old('slug')}}"
                     name="slug">
              @error("slug")
              <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-6">
          <div class="form-group">
              <label for="projectinput1"> وصف المنتج
              </label>
           
              <textarea class="tinymce" name="description" id="description"

              placeholder="  ">
                  {{old('description')}}
              </textarea>
         @error("description")
              <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group">
              <label for="projectinput1"> الوصف المختصر
              </label>
              <textarea  name="short_description" id="short-description"
                         class="form-control"
                         placeholder=""
              >{{old('short_description')}}</textarea>

              @error("short_description")
              <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
      </div>

  </div>


  <div class="row" >
      <div class="col-md-6">
          <div class="form-group">
              <label for="projectinput1"> اختر القسم
              </label>
              <select name="categories[]" class="select2 form-control" multiple>
                  <optgroup label="من فضلك أختر القسم ">
                      @if($categories && $categories -> count() > 0)
                          @foreach($categories as $category)
                              <option
                                  value="{{$category -> id }}">{{$category -> name}}</option>
                          @endforeach
                      @endif
                  </optgroup>
              </select>
              @error('categories.0')
              <span class="text-danger"> {{$message}}</span>
              @enderror
          </div>
      </div>
      <div class="col-md-6">
          <div class="form-group">
              <label for="projectinput1"> اختر ألعلامات الدلالية
              </label>
              <select name="tags[]" class="select2 form-control" multiple>
                  <optgroup label=" اختر ألعلامات الدلالية ">
                      @if($tags && $tags -> count() > 0)
                          @foreach($tags as $tag)
                              <option
                                  value="{{$tag -> id }}">{{$tag -> name}}</option>
                          @endforeach
                      @endif
                  </optgroup>
              </select>
              @error('tags')
              <span class="text-danger"> {{$message}}</span>
              @enderror
          </div>
      </div>
      <div class="col-md-6">
          <div class="form-group">
              <label for="projectinput1"> اختر ألماركة
              </label>
              <select name="brand_id" class="select2 form-control">
                  <optgroup label="من فضلك أختر الماركة ">
                      @if($brands && $brands -> count() > 0)
                          @foreach($brands as $brand)
                              <option
                                  value="{{$brand -> id }}">{{$brand -> name}}</option>
                          @endforeach
                      @endif
                  </optgroup>
              </select>
              @error('brand_id')
              <span class="text-danger"> {{$message}}</span>
              @enderror
          </div>
      </div>
      <div class="col-md-6">
        <div class="form-group mt-1">
            <input type="checkbox" value="1"
                   name="is_active"
                   id="switcheryColor4"
                   class="switchery" data-color="success"
                   checked/>
            <label for="switcheryColor4"
                   class="card-title ml-1">الحالة </label>

            @error("is_active")
            <span class="text-danger">{{$message }}</span>
            @enderror
        </div>
    </div>
  </div>

</div>
