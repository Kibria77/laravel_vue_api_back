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
                <h4 class="card-title mb-4 mx-auto">Stock Info Details</h4>
                <hr/>
            </div>
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Stock Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="stock_date" readonly value="{{ $stock->stock_date }}" class="form-control" id="horizontal-firstname-input"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-person-input" class="col-sm-3 col-form-label">Chalan No:</label>
                            <div class="col-sm-9">
                                <input type="text" name="chalan_no" readonly value="{{ $stock->chalan_no }}" class="form-control" id="horizontal-person-input" placeholder="Chalan Name"/>
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stock->stockDetails as $stockDetail)
                                <tr>
                                    <td>{{\App\Models\Suplier::find($stockDetail->suplier)->person_name}}</td>
                                    <td>{{\App\Models\Product::find($stockDetail->product)->name}}</td>
                                    <td>{{\App\Models\Size::find($stockDetail->size)->name}}</td>
                                    <td>{{\App\Models\Color::find($stockDetail->color)->name}}</td>
                                    <td>{{ $stockDetail->unit_price }}</td>
                                    <td>{{ $stockDetail->stock_amount }}</td>
                                    <td>{{ number_format($stockDetail->unit_price * $stockDetail->stock_amount) }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mr-5">
            <div class="col-sm-3 mr-0">
                <div>
                    <a href="{{ route('stock-manage') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </form>
@endsection
