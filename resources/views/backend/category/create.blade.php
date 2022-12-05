@extends('backend.backend-master')
@section('title','Add category')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Category Add <span>{{ Session::get('msg') }}</span></h1>
                <form action="{{route('store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="name" class="form-label">Add Category</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection