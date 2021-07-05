<h4 class="form-section"><i class="ft-home"></i> اداره المستودع   </h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="projectinput1"> كود  المنتج
            </label>
            <input type="text" id="sku"
                   class="form-control"
                   placeholder="  "
                   value="{{old('sku')}}"
                   name="sku">
            @error("sku")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="projectinput1">تتبع المستودع
            </label>
            <select name="manage_stock" class="form-control" id="manageStock">
              
                    <option value="1">اتاحة التتبع</option>
                    <option value="0" selected>عدم اتاحه التتبع</option>
                </optgroup>
            </select>
            @error('manage_stock')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
  <!-- QTY  -->



    <div class="col-md-6">
        <div class="form-group">
            <label for="projectinput1">حالة المنتج
            </label>
            <select name="in_stock"  class="form-control" >
                <optgroup label="من فضلك أختر  ">
                    <option value="1">متاح</option>
                    <option value="0">غير متاح </option>
                </optgroup>
            </select>
            @error('in_stock')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
    </div>


    <div class="col-md-6" style="display:none"  id="qtyDiv">
        <div class="form-group">
            <label for="projectinput1">الكمية
            </label>
            <input type="text" id="sku"
                   class="form-control"
                   placeholder="  "
                   value="{{old('qty')}}"
                   name="qty">
            @error("qty")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>