@extends('backend.backend-master')
@section('title','Edit Product')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h1 class="mb-3">Product Edit </h1>
                <script>
                    var msg = '{{Session::get('msg')}}';
                    var exist = '{{Session::has('msg')}}';
                    if(exist){
                    alert(msg);
                    }
                </script>
                <form action="{{route('product-update',['product_id' => $product->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <select class="form-select mb-4" aria-label="Default select example" name="category_id">
                        <option value='' disabled selected>Select Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{$category->id}}" {{$cat->id == $product->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                      </select>
                        @error("category_id")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                      <select class="form-select mb-4" aria-label="Default select example" name="brand_id">
                        <option selected value='' disabled selected>Select Brand</option>
                        @foreach ($brands as $br)
                            <option value="{{$br->id}}" {{$br->id == $product->brand_id ? 'selected':''}}>{{$br->name}}</option>
                        @endforeach
                      </select>
                        @error("brand_id")
                            <div>
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    <div class="mb-3">
                      <label for="name" class="form-label">Product name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                    </div>
                    @error("name")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="" class="form-label">Product Price</label>
                        <input type="number" name="price" class="form-control" value="{{$product->price}}"/>
                    </div>
                    @error("price")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                     @enderror
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea name="description" class="form-control" id="productDescription" cols="30" rows="10">{{$product->description}}</textarea>
                    </div>
                    @error("description")
                    <div>
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <div class="row mt-2">
                        <label for="" class="col-md-4">Product Image</label>
                        <div class="col-md-8">
                            <input type="file" name="image" class="form-control"/>
                            <img src="{{asset('/')}}{{$product->image}}" alt="" style="width: 500px;" class="mt-4">
                        </div>
                    </div>
                    @error("image")
                    <div>
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection