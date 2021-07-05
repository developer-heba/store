<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="projectinput1"> سعر  المنتج
            </label>
            <input type="number" id="price"
                   class="form-control"
                   placeholder="  "
                   value="{{old('price')}}"
                   name="price">
            @error("price")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="projectinput1"> سعر خاص
            </label>
            <input type="number"
                   class="form-control"
                   placeholder="  "
                   value="{{old('special_price')}}"
                   name="special_price">
            @error("special_price")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="projectinput1">نوع السعر
            </label>
            <select name="special_price_type" class=" form-control" >
    
                    <option value="percent">precent</option>
                    <option value="fixed">fixed</option>
                </optgroup>
            </select>
            @error('special_price_type')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
    </div>


</div>


<div class="row" >
    <div class="col-md-6">
        <div class="form-group">
            <label for="projectinput1"> تاريخ البداية
            </label>
                    <input type="date" class="form-control" id="date"    value="{{old('special_price_start')}}"
                    name="special_price_start">
                  </fieldset>
            @error('special_price_start')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="projectinput1"> تاريخ البداية
            </label>
            <fieldset class="form-group">
                <input type="date" class="form-control" id="date"   value="{{old('special_price_end')}}"
                name="special_price_end">
              </fieldset>
                  
            @error('special_price_end')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
    </div>
</div>