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
                                <th>Product Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                @foreach($categories as $category)
                                @if($category->id == $product->category_id)
                                <td style="width: 50px">{{$category->name}}</td>
                                @endif
                                @endforeach
                                @foreach($brands as $brand)
                                @if($brand->id == $product->brand_id)
                                <td style="width: 50px">{{$brand->name}}</td>
                                @endif
                                @endforeach
                                <td style="width: 150px">{{$product->name}}</td>
                                <td style="width: 50px">{{$product->price}}</td>
                                <td style="width: 250px">{{Str::limit($product->description,100)}}</td>
                                <td style="width: 100px"><img src="{{$product->image}}" alt="" style="width: 100px"></td>
                                <td>
                                    <a href="{{route('product-status', ['product_id' => $product->id])}}" class="{{$product->status == 1 ? 'btn btn-success' : 'btn btn-primary' }}">{{$product->status == 1 ? 'Active' : 'Deactive' }}</a>
                                    <a href="{{route('product-edit', ['cat_id' => $category->id, 'brand_id' => $brand->id, 'product_id' =>  $product->id ])}}" class="btn btn-warning">Edit</a>
                                    <a href="{{route('product-delete', ['product_id' => $product->id])}}" class="btn btn-danger" onclick="return confirm('Are u sure delete this brand');">Delete</a>
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