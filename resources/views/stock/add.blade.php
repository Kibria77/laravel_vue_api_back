@extends('master.master')

@section('title')
    Stock Room
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
    <form action="{{ route('stock-store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <h4 class="card-title mb-4 mx-auto">Create New Stock</h4>
                <hr/>
            </div>
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Stock Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="stock_date" class="form-control" id="horizontal-firstname-input"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-person-input" class="col-sm-3 col-form-label">Chalan No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="chalan_no" class="form-control" id="horizontal-person-input" placeholder="Chalan Name"/>
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
                                <tr>
                                    <td>
                                        <select name="stock[0][suplier]" class="form-control">
                                            <option> -- Select Suplier -- </option>
                                            @foreach($supliers as $suplier)
                                                <option value="{{ $suplier->id }}">{{ $suplier->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="stock[0][product]" class="form-control inventoryItemSelect" data-id="0">
                                            <option> -- Select Product -- </option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="stock[0][size][]" class="select2 form-control select2-multiple" id="size0" multiple="multiple" data-placeholder="Select Size">
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="select2 form-control select2-multiple" name="stock[0][color][]" id="color0" multiple="multiple" data-placeholder="Select Color">
                                            @foreach($colors as $color)
                                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control inventory-unit-count" data-id="0" min="1" name="stock[0][unit_price]" id="unitPrice0"/>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control inventory-amount-count" data-id="0" min="1" name="stock[0][stock_amount]" id="stockAmount0"/>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control bg-dark-subtle" readonly name="stock[0][total_price]" id="totalPrice0"/>
                                    </td>
                                    <td>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-9">
                                                <div>
                                                    <button type="button" class="btn btn-primary btn-sm" id="adStockBtn">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                    <button type="submit" class="btn btn-primary btn-block">Stock New Thing</button>
                </div>
            </div>
        </div>
    </form>
@endsection
