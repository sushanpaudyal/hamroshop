@extends('admin.adminLayouts.admin_design')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title"> Products </h4>
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
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Products Details</h4>
                        <form class="m-t-30" method="post" action="{{route('product.add')}}" id="add_product" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="parent_id">Category</label>
                                <select class="form-control" name="category_id">
                                    <?php echo $categories_dropdown ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name">
                            </div>

                            <div class="form-group">
                                <label for="product_color">Product Color</label>
                                <input type="text" class="form-control" id="product_color" name="product_color">
                            </div>

                            <div class="form-group">
                                <label for="product_code">Product Code</label>
                                <input type="text" class="form-control" id="product_code" name="product_code">
                            </div>

                            <div class="form-group">
                                <label for="price">Pricr</label>
                                <input type="text" class="form-control" id="price" name="price">
                            </div>

                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="8" class="form-control summernote" id="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Care</label>
                                <textarea name="care" rows="8" class="form-control summernote" id="care"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Status Enable</label>
                                <input type="checkbox" name="status" id="status" value="1">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('script')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js?fbclid=IwAR1RjITeTwmkv0NszrXT4kZGopGY0gYIwkjQLvDvAh1kw4tBD4JdJFHpgl8">

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#add_product").validate({
                rules: {
                    product_name: {
                        required : true
                    },
                    description:{
                        required : true
                    }
                },
                messages: {
                    product_name: {
                        required : "<span class='text-danger'> Please Enter Product Name</span>"
                    },
                    description : "Please Insert Content"
                }
            });
        });

    </script>
@endsection
