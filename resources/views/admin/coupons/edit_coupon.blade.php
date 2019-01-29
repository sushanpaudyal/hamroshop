@extends('admin.adminLayouts.admin_design')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title"> Coupons </h4>
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
                            <li class="breadcrumb-item active" aria-current="page">Coupons</li>
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
                        <h4 class="card-title">Edit Coupons Details</h4>
                        <form class="m-t-30" method="post" action="{{route('edit.coupon', $couponDetails->id)}}" id="add_product" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="parent_id">Amount Type</label>
                                <select class="form-control" name="amount_type" id="amount_type">
                                    <option value="Percentage" @if($couponDetails->amount_type == "Percentage") selected @endif>Percentage</option>
                                    <option value="Fixed" @if($couponDetails->amount_type == "Fixed") selected @endif>Fixed</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_name">Coupon Code</label>
                                <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{$couponDetails->coupon_code}}">
                            </div>

                            <div class="form-group">
                                <label for="product_color">Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" value="{{$couponDetails->amount}}">
                            </div>

                            <div class="form-group">
                                <label for="product_code">Expiry Date</label>
                                <input type="text" class="form-control" id="datepicker" name="expiry_date" value="{{$couponDetails->expiry_date}}">
                            </div>


                            <div class="form-group">
                                <label>Status Enable</label>
                                <input type="checkbox" name="status" id="status" value="1" @if($couponDetails->status == 1) checked @endif>
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
