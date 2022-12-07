@extends('backend.backend-master')
@section('title','Add Brand')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h1>Brand Add </h1>
                <script>
                    var msg = '{{Session::get('msg')}}';
                    var exist = '{{Session::has('msg')}}';
                    if(exist){
                    alert(msg);
                    }
                </script>
                <form action="{{route('brand-store')}}" method="POST">
                    @csrf
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                    <div class="mb-3">
                      <label for="name" class="form-label">Add Brand</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection