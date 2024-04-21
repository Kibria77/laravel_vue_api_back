@extends('master.master')

@section('title')
    Manage Brand
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
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create A New Brand</h4>
                    <hr/>
                    <form action="{{ route('brand-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Brand Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="horizontal-firstname-input" placeholder="Category Name"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Brand Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="horizontal-email-input" placeholder="Category Description"></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Brand Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" class="form-control" id="horizontal-password-input"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Public Status</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1">
                                    <label class="form-check-label">Publish</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="status" type="radio" value="0">
                                    <label class="form-check-label">Unpublished</label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Create A New Brand</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">All Brand Info Here</h4>
                    <hr/>
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead class="text-center">
                        <tr>
                            <th>SL NO</th>
                            <th>Brand Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{!! $brand->description !!}</td>
                                <td>
                                    <img src="{{ asset($brand->image) }}" alt="" class="img-thumbnail" height="80" width="80"/>
                                </td>
                                <td>
                                    <button class="{{$brand->status == 1 ? 'btn btn-success btn-sm' : 'btn btn-danger btn-sm'}}">{{$brand->status == 1 ? 'Publish' : 'Unpublished'}}</button>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('update-brand-status', ['id' => $brand->id]) }}" class="btn {{ $brand->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                        <i class="{{ $brand->status == 1 ? 'fas fa-arrow-alt-circle-up' : 'fas fa-arrow-alt-circle-down' }}"></i>
                                    </a>
                                    <a href="{{ route('edit-brand-info', ['id' => $brand->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('deleteCategory{{$brand->id}}').submit();">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form action="{{ route('delete-brand', ['id' => $brand->id]) }}" method="POST" id="deleteCategory{{$brand->id}}">
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
