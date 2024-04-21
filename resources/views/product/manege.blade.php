@extends('master.master')

@section('title')
    Manege Product
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-5">
            @if($massage = Session::get('massage'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $massage }}</strong>
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
                    <h4 class="card-title">All Product Info Here</h4>
                    <hr/>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead class="text-center">
                        <tr>
                            <th>SL NO</th>
                            <th>Product Name</th>
                            <th>Code</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Selling Price</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>{{ $product->selling_price }}</td>
                                <td>
                                    <button class="{{$product->status == 1 ? 'btn btn-success btn-sm' : 'btn btn-danger btn-sm'}}">{{$product->status == 1 ? 'Publish' : 'Unpublished'}}</button>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('update-product-status', ['id' => $product->id]) }}" class="btn {{ $product->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                        <i class="{{ $product->status == 1 ? 'fas fa-arrow-alt-circle-up' : 'fas fa-arrow-alt-circle-down' }}"></i>
                                    </a>
                                    <a href="{{ route('product-detail', ['id' => $product->id]) }}" class="btn btn-dark btn-sm">
                                        <i class="fas fa-book-open"></i>
                                    </a>
                                    <a href="{{ route('edit-product-info', ['id' => $product->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('deleteProduct{{ $product->id }}').submit();">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form action="{{ route('product-delete', ['id' => $product->id]) }}" method="POST" id="deleteProduct{{ $product->id }}">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
