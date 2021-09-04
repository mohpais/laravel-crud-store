@extends('template')

@section('content')
    <div class="row mt-4 mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <div class="h4">Product Edit {{$product->product_name}}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if ($message = Session::get('success'))
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    <p class="mb-0">{{ $message }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($message = Session::get('errors'))
                            <div class="col-sm-12">
                                <div class="alert alert-danger">
                                    <p class="mb-0">{{ $message }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-12">
                            <form action="{{ route('product.update', $product->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" value="{{$product->product_name}}" name="product_name" aria-describedby="productNameHelp" required>
                                    @if ($errors->has('product_name'))
                                        <div id="productNameHelp" class="form-text text-danger">{{ $errors->first('product_name') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Product Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}" aria-describedby="productPriceHelp" required>
                                    @if ($errors->has('price'))
                                        <div id="productPriceHelp" class="form-text text-danger">{{ $errors->first('price') }}.</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock"  value="{{$product->stock}}" aria-describedby="productStockHelp" required>
                                    @if ($errors->has('stock'))
                                        <div id="productStockHelp" class="form-text text-danger">{{ $errors->first('stock') }}.</div>
                                    @endif
                                </div>
                                <a href="{{ url('/product') }}" class="btn btn-success">
                                    <i class='bx bx-arrow-back'></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // var test = {!! Request::path() !!}
        })
    </script>
@endsection