@extends('backend.backend-master')
@section('title','Add Product')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h1 class="mb-3">Product Add </h1>
                <script>
                    var msg = '{{Session::get('msg')}}';
                    var exist = '{{Session::has('msg')}}';
                    if(exist){
                    alert(msg);
                    }
                </script>
                <form action="{{route('product-store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <select class="form-select mb-4" aria-label="Default select example" name="category_id">
                        <option selected value=''>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                        @error("category_id")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                      <select class="form-select mb-4" aria-label="Default select example" name="brand_id">
                        <option selected value=''>Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                      </select>
                        @error("brand_id")
                            <div>
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    <div class="mb-3">
                      <label for="name" class="form-label">Product name</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                    @error("name")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="" class="form-label">Product Price</label>
                        <input type="number" name="price" class="form-control"/>
                    </div>
                    @error("price")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                     @enderror
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea name="description" class="form-control" id="productDescription" cols="30" rows="10"></textarea>
                    </div>
                    @error("description")
                    <div>
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <div class="row mt-2">
                        <label for="" class="col-md-4">Product Image</label>
                        <div class="col-md-8">
                            <input type="file" name="image" class="form-control" />
                        </div>
                    </div>
                    @error("image")
                    <div>
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <div class="row mt-2">
                        <label class="col-md-4">Status</label>
                        <div class="col-md-8">
                            <label ><input type="radio" name="status" value="1" checked> Published</label>
                            <label ><input type="radio" name="status" value="0"> Unpublished</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection