@extends('backend.backend-master')
@section('title','edit category')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h1>Category Edit <span>{{ Session::get('msg') }}</span></h1>
                <form action="{{route('category-update',['cat_id'=>$category->id])}}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="name" class="form-label">Add Category</label>
                      <input type="text" class="form-control" id="name" name="name" value='{{$category->name}}'>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
    </div>
@endsection