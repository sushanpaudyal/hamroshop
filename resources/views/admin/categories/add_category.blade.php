@extends('admin.adminLayouts.admin_design')

@section('content')

<div class="page-breadcrumb">
             <div class="row">
                 <div class="col-5 align-self-center">
                     <h4 class="page-title"> Categories </h4>
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
                                 <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                             <h4 class="card-title">Add Category Details</h4>
                             <form class="m-t-30" method="post" action="{{route('category.add')}}" id="add_category">
                               @csrf
                               <div class="form-group">
                                 <label for="parent_id">Category Level</label>
                                 <select class="form-control" name="parent_id">
                                   <option value="0">Main Category</option>
                                     @foreach($levels as $val)
                                         <option value="{{$val->id}}">{{$val->name}}</option>
                                         @endforeach
                                 </select>
                               </div>

                                 <div class="form-group">
                                     <label for="name">Category Name</label>
                                     <input type="text" class="form-control" id="name" name="name">
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputPassword1">Description</label>
                                     <textarea name="description" rows="8" class="form-control summernote" id="description"></textarea>
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
         $("#add_category").validate({
            rules: {
                name: {
                  required : true
                },
                description:{
                  required : true
                }
            },
            messages: {
              name: {
                required : "Please Enter Category Name"
              },
              description : "Please Insert Content"
            }
         });
       });

       </script>
    @endsection
