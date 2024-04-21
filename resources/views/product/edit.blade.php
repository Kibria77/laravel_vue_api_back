@extends('master.master')

@section('title')
    Edit Product Info
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-5">
            @if($message = Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <form action="{{ route('product-update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Category Name</label>
                            <div class="col-sm-9">
                                <select name="category_id" class="form-control" id="getCategoryId">
                                    <option value=""> ------ Select Product Category ------ </option>
                                    @foreach($categoris as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Sub Category</label>
                            <div class="col-sm-9">
                                <select name="sub_category_id" class="form-control" id="subCategoryId">
                                    <option disabled selected> ------ Select Product Sub Category ------ </option>
                                    @foreach($subCategorys as $subCategory)
                                        <option value="{{ $subCategory->id }}" {{ $subCategory->id == $product->sub_category_id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Brand Name</label>
                            <div class="col-sm-9">
                                <select name="brand_id" class="form-control">
                                    <option value=""> ------ Select Brand Name ------ </option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Unit Name</label>
                            <div class="col-sm-9">
                                <select name="unit_id" class="form-control">
                                    <option value=""> ------ Select Unit Name ------ </option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}" {{ $unit->id == $product->unit_id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Product Size</label>
                            <div class="col-sm-9">
                                <select name="size[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Select Sizes...">
                                    @foreach($sizes as $size)
                                        <option value="{{ $size->id }}" @foreach($product->sizes as $productSize) {{ $size->id == $productSize->size_id ? 'selected' : '' }} @endforeach>{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Product Color</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control select2-multiple" name="color[]" multiple="multiple" data-placeholder="Select Colors...">
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}" @foreach($product->colors as $productColor) {{ $color->id == $productColor->color_id ? 'selected' : '' }} @endforeach>{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="horizontal-firstname-name" class="col-sm-3 col-form-label">Product Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="horizontal-firstname-input" value="{{ $product->name }}"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Product Code</label>
                            <div class="col-sm-9">
                                <input type="text" name="code" class="form-control" id="horizontal-firstnameasda" value="{{ $product->code }}"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Product Model</label>
                            <div class="col-sm-9">
                                <input type="text" name="model" class="form-control" id="horizontal-firstnameasda" value="{{ $product->model }}"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Product Price</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text">Regular Price</span>
                                    <input type="number" min="2" name="regular_price" aria-label="First name" class="form-control" value="{{ $product->regular_price }}"/>
                                    <span class="input-group-text">Selling Price</span>
                                    <input type="number" min="2" name="selling_price" aria-label="Last name" class="form-control" value="{{ $product->selling_price }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Meta Tag</label>
                            <div class="col-sm-9">
                                <input type="text" name="meta_tag" class="form-control" value="{{ $product->meta_tag }}"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Meta Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="meta_description">{{ $product->meta_description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label for="horizontal-firstname-input199" class="col-sm-2 col-form-label">Product Short Description</label>
                            <textarea class="form-control summernote" name="short_description" id="horizontal-firstname-input144499">{!! $product->short_description !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label for="horizontal-firstname-input199" class="col-sm-2 col-form-label">Product Long Description</label>
                            <textarea class="form-control summernote" name="long_description" id="horizontal-firstname-input199">{!! $product->long_description !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="col-form-label">Feature Image</label>
                            <input class="form-control" type="file" name="image"/>
                            <img src="{{ asset($product->image) }}" alt="" height="80" width="100"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="col-form-label">Other Images</label>
                            <input class="form-control" type="file" name="other_images[]" accept="image/*" multiple/>
                            @foreach($product->othersImages as $imageOthers)
                                <img src="{{ asset($imageOthers->image) }}" alt="" height="80" width="100"/>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="col-form-label">Public Status</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{ $product->status == 1 ? 'checked' : '' }} name="status" id="inlineRadio1" value="1">
                                    <label for="inlineRadio1" class="form-check-label">Publish</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="status" {{ $product->status == 0 ? 'checked' : '' }} type="radio" id="lowherent" value="0">
                                    <label for="lowherent" class="form-check-label">Unpublished</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success w-100">Update Product Info</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
