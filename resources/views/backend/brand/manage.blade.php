@extends('backend.backend-master')

@section('title' , 'Manage category')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mt-4">All Brands</h1>
                <h4><span>{{ Session::get('msg') }}</span></h4>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Sl:</th>
                                <th>Category name</th>
                                <th>Brand name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $brand)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                @foreach($categories as $category)
                                @if($category->id == $brand->category_id)
                                <td>{{$category->name}}</td>
                                @endif
                                @endforeach
                                <td>{{$brand->name}}</td>
                                <td>
                                    <a href="{{route('brand-edit', ['brand_id' => $brand->id,'cat_id' => $category->id])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('brand-delete', ['brand_id' => $brand->id])}}" class="btn btn-danger" onclick="return confirm('Are u sure delete this brand');">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection