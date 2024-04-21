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
    <div class="row">
        <div class="col-12">
            <h4 class="card-title mb-4 mx-auto">Manage Stock</h4>
            <hr/>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead class="text-center">
                        <tr>
                            <th>SL NO</th>
                            <th>Chalan No</th>
                            <th>Stock Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($stocks as $stock)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $stock->chalan_no }}</td>
                                <td>{{ $stock->stock_date }}</td>
                                <td class="text-center">
                                    <a href="{{ route('stock-detail', ['id' => $stock->id]) }}" class="btn btn-dark btn-sm">
                                        <i class="fas fa-book-open"></i>
                                    </a>
                                    <a href="{{ route('edit-stock-info', ['id' => $stock->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('deleteProduct{{ $stock->id }}').submit();">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form action="{{ route('product-delete', ['id' => $stock->id]) }}" method="POST" id="deleteProduct{{ $stock->id }}">
                                        @csrf
                                    </form>
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
