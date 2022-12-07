@extends('backend.backend-master')
@section('title','edit brand')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h1>Brand Edit <span>{{ Session::get('msg') }}</span></h1>
                <form action="{{route('brand-update',['brand_id'=>$brand->id])}}" method="POST">
                    @csrf
                    <select class="form-select mb-4" aria-label="Default select example" name="category_id">
                        <option selected>Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->id}}" {{ $cat->id == $brand->category_id ? 'selected' : '' }}>{{$cat->name}}</option>
                            @endforeach
                    </select>
                    <div class="mb-3">
                      <label for="name" class="form-label">Edit Brand</label>
                      <input type="text" class="form-control" id="name" name="name" value='{{$brand->name}}'>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
    </div>
@endsection