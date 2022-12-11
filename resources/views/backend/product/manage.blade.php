@extends('backend.backend-master')

@section('title' , 'Manage category')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mt-4">All product</h1>
                <h4><span>{{ Session::get('msg') }}</span></h4>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Sl:</th>
                                <th>Category name</th>
                                <th>Brand name</th>
                                <th>Product name</th>
                                <th>Product price</th>
                                <th>Product description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                @foreach($categories as $category)
                                @if($category->id == $product->category_id)
                                <td>{{$category->name}}</td>
                                @endif
                                @endforeach
                                @foreach($brands as $brand)
                                @if($brand->id == $product->brand_id)
                                <td>{{$brand->name}}</td>
                                @endif
                                @endforeach
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->description}}</td>
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