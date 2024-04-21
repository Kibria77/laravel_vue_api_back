@extends('master.master')

@section('title')
    Product Detail Form
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-5">
            @if($massage = Session::get('massage'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Basic Information</h4>
                    <hr/>
                    <table class="table table-bordered dt-responsive  nowrap w-100">

                        <tr>
                            <th>Product ID</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Product Code</th>
                            <td>{{ $product->code }}</td>
                        </tr>
                        <tr>
                            <th>Product Model</th>
                            <td>{{ $product->model }}</td>
                        </tr>
                        <tr>
                            <th>Product Category</th>
                            <td>{{ isset($product->category->name) ? $product->category->name : '' }}</td>
                        </tr>
                        <tr>
                            <th>Product Sub-Category</th>
                            <td>{{ isset($product->subCategory->name) ? $product->subCategory->name : '' }}</td>
                        </tr>
                        <tr>
                            <th>Product Brand</th>
                            <td>{{ $product->brand->name }}</td>
                        </tr>
                        <tr>
                            <th>Product Unit</th>
                            <td>{{ $product->unit->name }}</td>
                        </tr>
                        <tr>
                            <th>Regular Price</th>
                            <td>{{ $product->regular_price }}</td>
                        </tr>
                        <tr>
                            <th>Selling Price</th>
                            <td>{{ $product->selling_price }}</td>
                        </tr>
                        <tr>
                            <th>Meta Tag</th>
                            <td>{{ $product->meta_tag }}</td>
                        </tr>
                        <tr>
                            <th>Meta Description</th>
                            <td>{{ $product->meta_description }}</td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td>{!! $product->short_description !!}</td>
                        </tr>
                        <tr>
                            <th>Long Description</th>
                            <td>{!! $product->long_description !!}</td>
                        </tr>
                        <tr>
                            <th>Feature Image</th>
                            <td><img src="{{ asset($product->image) }}" alt="" height="150" width="150"/></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <button class="{{$product->status == 1 ? 'btn btn-success btn-sm' : 'btn btn-danger btn-sm'}}">{{$product->status == 1 ? 'Publish' : 'Unpublished'}}</button>
                            </td>
                        </tr>
                        <tr>
                            <th>Stock Amount</th>
                            <td>{{ $product->sku }}</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Color Information</h4>
                    <hr/>
                    <table class="table table-bordered dt-responsive  nowrap w-100">
                        <tr>
                            @foreach($product->colors as $color)
                                <td>{{ $color->color->name }}</td>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Size Information</h4>
                    <hr/>
                    <table class="table table-bordered dt-responsive  nowrap w-100">
                        <tr>
                            @foreach($product->sizes as $size)
                                <td>{{ $size->size->name }}</td>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Others Image</h4>
                    <hr/>
                    <table class="table table-bordered dt-responsive  nowrap w-100">
                        <tr>
                            @foreach($product->othersImages as $othersImage)
                                <td><img src="{{ asset($othersImage->image) }}" alt="" height="200" width="200"></td>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <a href="{{ route('manage-product') }}" class="btn btn-primary btn-block">Back In Manege Page</a>
            </div>
        </div>
    </div>
@endsection
