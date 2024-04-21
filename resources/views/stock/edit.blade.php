@extends('master.master')

@section('title')
    Edit Stock Amount
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-5">
            @if($massage = Session::get('massage'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $massage }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <form action="{{ route('stock-update', ['id' => $stockdd->id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <h4 class="card-title mb-4 mx-auto">Update Stock Info</h4>
                <hr/>
            </div>
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Stock Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="stock_date" value="{{ $stockdd->stock_date }}" class="form-control" id="horizontal-firstname-input"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-person-input" class="col-sm-3 col-form-label">Chalan No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="chalan_no" value="{{ $stockdd->chalan_no }}" class="form-control" id="horizontal-person-input" placeholder="Chalan Name"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="text-center">
                                <tr>
                                    <th>Suplier Name</th>
                                    <th>Product Name</th>
                                    <th>Product Size</th>
                                    <th>Product Color</th>
                                    <th>Unit Price</th>
                                    <th>Stock Amount</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="adStockFild">
                                @foreach($stockdd->stockDetails as $key => $stockDetail)
                                <tr>
                                    <td>
                                        <select name="stock[{{$key}}][suplier]" class="form-control">
                                            <option> -- Select Suplier -- </option>
                                            @foreach($supliers as $suplier)
                                                <option value="{{ $suplier->id }}" {{ $stockDetail->suplier == $suplier->id ? 'selected' : '' }}>{{ $suplier->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="stock[{{$key}}][product]" class="form-control inventoryItemSelect" data-id="0">
                                            <option> -- Select Product -- </option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ $stockDetail->product == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="stock[{{$key}}][size][]" class="select2 form-control select2-multiple" id="size{{$key}}" multiple="multiple" data-placeholder="Select Size">
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->id }}" {{ $stockDetail->size == $size->id ? 'selected' : '' }}>{{ $size->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="select2 form-control select2-multiple" name="stock[{{$key}}][color][]" id="color{{$key}}" multiple="multiple" data-placeholder="Select Color">
                                            @foreach($colors as $color)
                                                <option value="{{ $color->id }}" {{ $stockDetail->color == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control inventory-unit-count" value="{{ $stockDetail->unit_price }}" data-id="{{$key}}" min="1" name="stock[{{$key}}][unit_price]" id="unitPrice{{$key}}"/>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control inventory-amount-count" value="{{ $stockDetail->stock_amount }}" data-id="{{$key}}" min="1" name="stock[{{$key}}][stock_amount]" id="stockAmount{{$key}}"/>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control bg-dark-subtle" value="{{ $stockDetail->unit_price*$stockDetail->stock_amount }}" readonly name="stock[{{$key}}][total_price]" id="totalPrice{{$key}}"/>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-6 mx-auto">
                                                <div>
                                                    @if($key == 0)
                                                        <button type="button" class="btn btn-primary btn-sm" id="adStockBtn">+</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger btn-sm" id="removeStockItems">-</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-sm-3 mr-0">
                <div>
                    <button type="submit" class="btn btn-primary btn-block">Update Stock Info</button>
                </div>
            </div>
        </div>
    </form>
@endsection
