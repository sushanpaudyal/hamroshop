@extends('admin.adminLayouts.admin_design')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title"> Products Attributes</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Products Attribute</h4>


                        @if(Session::has('flash_message_error'))
                            <div class="alert alert-error alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{!! session('flash_message_error') !!}</strong>
                            </div>
                        @endif
                        @if(Session::has('flash_message_success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{!! session('flash_message_success') !!}</strong>
                            </div>
                        @endif

                        <form class="m-t-30" method="post" action="{{route('attribute.add', $productDetails->id)}}" id="add_product" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$productDetails->id}}">

                            <div class="form-group">
                                <label for="product_name">Product Name : {{$productDetails->product_name}}</label>
                            </div>

                            <div class="form-group">
                                <label for="product_code">Product Code : {{$productDetails->product_code}}</label>
                            </div>


                            <div class="control-group">
                                <label for="control-label"></label>
                                <div class="field_wrapper">
                                    <div>
                                        <input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px;">
                                        <input type="text" name="size[]" id="size" placeholder="Size" style="width: 120px;">
                                        <input type="text" name="price[]" id="price" placeholder="Price" style="width: 120px;">
                                        <input type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 120px;">

                                        <a href="javascript:void(0);" class="add_button" title="Add Field">Add</a>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection

@section('script')
    <script>
        $(document).ready(function(){
            var maxField = 10;    // Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="field_wrapper"> <div> <input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px;">  <input type="text" name="size[]" id="size" placeholder="Size" style="width: 120px;"> <input type="text" name="price[]" id="price" placeholder="Price" style="width: 120px;">   <input type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 120px;"> <a href="javascript:void(0);" class="remove_button">Remove</a></div>  </div> ';
            var x = 1; //Initial field counter is 1
            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
    @endsection