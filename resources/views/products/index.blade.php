@extends('template')

@section('content')
    <div class="row mt-4 mb-2">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <div class="h4">Product List</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4">
                    <div class="row">
                        @if ($message = Session::get('success'))
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    <p class="mb-0">{{ $message }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-auto">
                                    <button type="button" data-toggle="modal" data-target="#tambahProduct" class="btn btn-success">Add Product</button>
                                </div>
                                <div class="col-auto ml-auto">
                                    <a class="btn btn-info text-white" href="{{ url('/order') }}">
                                        <i class='bx bx-sync'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <form action="{{ route('product.index') }}" method="GET" role="search">
                                        <div class="row" style="justify-content: space-between">
                                            <div class="col-auto">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <label for="costumer" class="col-form-label">Show</label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <select class="form-control" name="paginate">
                                                            <option value="3">3</option>
                                                            <option value="5" selected>5</option>
                                                            <option value="10">10</option>
                                                            <option value="100">100</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span>
                                                            entries
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-auto">
                                                        <input type="text" id="product_name" class="form-control" name="product_name" placeholder="Search product name...">
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="submit" class="btn btn-success">Filter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <table id="datatable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="150px">
                                                    <form class="m-0" action="{{ route('product.index') }}" method="GET" role="search">
                                                        <input type="hidden" name="sort_by" value="product_id">
                                                        <div class="row g-0">
                                                            <span class="col-auto">Product ID</span>
                                                            <button type="submit" class="col-auto ms-auto btn-sort"><i class='bx bx-sort'></i></button>
                                                        </div>
                                                    </form>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Product Name</span>
                                                        <div class="col-auto ms-auto text-secondary"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Unit Price</span>
                                                        <div class="col-auto ms-auto text-secondary"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Stock</span>
                                                        <div class="col-auto ms-auto text-secondary"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Action</span>
                                                        <div class="col-auto ms-auto text-secondary"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($products))
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $product->id  }}</td>
                                                        <td>{{ $product->product_name }}</td>
                                                        <td>Rp. {{ $product->price }}</td>
                                                        <td>{{ $product->stock }}</td>
                                                        <td>
                                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                                <a class="btn btn-primary btn-sm" href="{{ route('product.edit', $product) }}">Edit</a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <div class="tr">
                                                    <td colspan="5" class="text-center">No data available in table</td>
                                                </div>
                                            @endif
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-sm-12">
                                    <div class="row" style="justify-content: space-between">
                                        <div class="col-auto">
                                            <span>Showing <span id="from"></span> to <span id="to"></span> of <span id="entry"></span> entries</span>
                                        </div>
                                        <div class="col-auto">
                                            {{-- {{$products->links()}} --}}
                                            <a id="prev" class="btn btn-outline-secondary m-0" href="">Previous</a>
                                            <a id="next" class="btn btn-outline-secondary m-0" href="">Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahProduct" tabindex="-1" aria-labelledby="tambahProductTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahProductTitle">Tambah Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" aria-describedby="productNameHelp">
                            @if ($errors->has('product_name'))
                                <div id="productNameHelp" class="form-text text-danger">{{ $errors->first('product_name') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Product Price</label>
                            <input type="number" class="form-control" id="price" name="price" aria-describedby="productPriceHelp">
                            @if ($errors->has('price'))
                                <div id="productPriceHelp" class="form-text text-danger">{{ $errors->first('price') }}.</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" aria-describedby="productStockHelp">
                            @if ($errors->has('stock'))
                                <div id="productStockHelp" class="form-text text-danger">{{ $errors->first('stock') }}.</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var page = @json($products);
            // console.log(page);
            if (page) {
                $("#from").html(page.from)
                $("#to").html(page.to)
                $("#entry").html(page.total)
                $("a#prev").attr("href", page.prev_page_url)
                $("a#next").attr("href", page.next_page_url)
                if (!page.prev_page_url) {
                    $("a#prev").addClass('d-none');
                } else {
                    $("a#prev").removeClass('d-none');
                }
                if (!page.next_page_url) {
                    $("a#next").addClass('d-none');
                } else {
                    $("a#next").removeClass('d-none');
                }
            }
        } );
    </script>
@endsection