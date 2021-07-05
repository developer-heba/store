@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="">
                                        المنتجات </a>
                                </li>
                                <li class="breadcrumb-item active"> {{$product->name}}تعديل منتج
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">  {{$product->name}}تعديل منتج </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-header">
                                     
                                    </div>
                                    <div class="card-content">
                                      <div class="card-body">
                                    
                                        <ul class="nav nav-tabs nav-topline">
                                          <li class="nav-item">
                                            <a class="nav-link active" id="base-tab21" data-toggle="tab" aria-controls="tab21"
                                            href="#tab21" aria-expanded="true">البيانات الاساسية </a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link" id="base-tab22" data-toggle="tab" aria-controls="tab22" href="#tab22"
                                            aria-expanded="false"> السعر</a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link" id="base-tab23" data-toggle="tab" aria-controls="tab23" href="#tab23"
                                            aria-expanded="false">المستودع</a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link" id="base-tab24" data-toggle="tab" aria-controls="tab24" href="#tab24"
                                            aria-expanded="false">الصور</a>
                                          </li>
                                        </ul>
                                        <div class="tab-content px-1 pt-1 border-grey border-lighten-2 border-0-top">
                                          <div role="tabpanel" class="tab-pane active" id="tab21" aria-expanded="true" aria-labelledby="base-tab21">
                                   
                                          @include('dashboard.products.components.editproduct.general')

                                     
                                            <a class="btn btn-primary btnNext" style="color:#fff;float:left;" >Next</a>
                                          </div>
                                          <div class="tab-pane" id="tab22" aria-labelledby="base-tab22">
                                            <div class="form-body">
                                            @include('dashboard.products.components.editproduct.prices')
                                            <a class="btn btn-primary btnNext " style="color:#fff;float:left;" >Next</a>
                                            <a class="btn btn-primary btnPrevious " style="color:rgb(248, 225, 225);float:left;" >Previous</a>
                                            </div>
                                          </div>
                                      
                                          <div class="tab-pane" id="tab23" aria-labelledby="base-tab23">
                                            <div class="form-body">
                                                @include('dashboard.products.components.editproduct.stock')
                                                </div>
                                               
                                            <a class="btn btn-primary btnNext" style="color:#fff;float:left;" >Next</a>
                                            <a class="btn btn-primary btnPrevious " style="color:rgb(248, 225, 225);float:left;" >Previous</a>
                                          </div>
                                          <div class="tab-pane" id="tab24" aria-labelledby="base-tab24">
                                            <div class="form-body">
                                            @include('dashboard.products.components.editproduct.images')
                                            <div class="form-actions col-6">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                                
                                            </div>
                                        </form>
                                          
                                     
                                           </div>
                                           <a class="btn btn-primary btnPrevious" style="color:rgb(248, 225, 225); float:left;display:block;" >Previous</a>
                                        </div>
                                        </div>
                                      </div>
                                   
                                    </div>
                               
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop
@section('script')


    <script>
  

$('.edit-image').click(function(){
   
    $('.dpf-edit').css('display','block');
    var id=$(this).data('id');
    $('form').append('<input type="hidden" class="image-id" name="image_id" value="' + id + '">');
    $(window).scrollTop($('.dpf-edit').offset().top);

});
$('.add-image').click(function(){
   
   $('.dpf-edit').css('display','block');
   $('.image-id').remove();
   $(window).scrollTop($('.dpf-edit').offset().top);
});


$('.btnNext').click(function(){
    $('.nav-tabs .active').parent().next('li').find('a').trigger('click');

});
  $('.btnPrevious').click(function(){
    $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');

});
$(".delet-image").click(function(){
        var id = $(this).data("id");
        var token = $(this).data("token");
        $.ajax(
        {
            url: "image/delete/"+id,
            type: 'DELETE',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token
                    },
        
            success: function ()
            {
                console.log('ok');
                $(".image-"+id).remove();
            }
        });

    
    });
$(document).on('change','#manageStock',function(){
       if($(this).val() == 1 ){
            $('#qtyDiv').show();
       }else{
           $('#qtyDiv').hide();
       }
    });

             var uploadedDocumentMap = {}
            Dropzone.options.dpzMultipleFiles = {
                paramName: "dzfile", // The name that will be used to transfer the file
                //autoProcessQueue: false,
                maxFilesize: 5, // MB
                clickable: true,
                addRemoveLinks: true,
                acceptedFiles: 'image/*',
                dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
                dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
                dictCancelUpload: "الغاء الرفع ",
                dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
                dictRemoveFile: "حذف الصوره",
                dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
                headers: {
                    'X-CSRF-TOKEN':
                        "{{ csrf_token() }}"
                }

                ,
                url: "{{ route('admin.products.images.store') }}", // Set the url
                success:
                    function (file, response) {
                        $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                        uploadedDocumentMap[file.name] = response.name
                    }
                ,
                removedfile: function (file) {
                    file.previewElement.remove()
                    
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMap[file.name]
                    }
                    $('form').find('input[name="document[]"][value="' + name + '"]').remove()
             
                }
                ,
                // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
                init: function () {

                        @if(isset($event) && $event->document)
                    var files =
                    {!! json_encode($event->document) !!}
                        for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                    }
                    @endif
                }
            }

     
    </script>
    @stop
@section('script')

    <script>
        $('input:radio[name="type"]').change(
            function(){
                if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                    $('#cats_list').removeClass('hidden');

                }else{
                    $('#cats_list').addClass('hidden');
                }
            });
    </script>
        <script>
        $(document).on('change','#manageStock',function(){
           if($(this).val() == 1 ){
                $('#qtyDiv').show();
           }else{
               $('#qtyDiv').hide();
           }
        });
    </script>
    @stop
 
