@extends('template')

@section('content')
    <div class="row mt-3 mb-2">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <div class="h4">Order Entry</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4">
                    @if (Session::has('success'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12">
                            <b>Order Info</b>
                        </div>
                        <div class="col-sm-12">
                            <form action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <div class="row align-items-center mb-3">
                                    <div class="col-2">
                                        <label for="order_id" class="col-form-label"><b>Order ID</b></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="order_id" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-2">
                                        <label for="order_date" class="col-form-label"><b>Order Date</b></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" id="order_date" name="order_date" class="form-control" required>
                                    </div>
                                    
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-2">
                                        <label for="customer_name" class="col-form-label"><b>Customer Name</b></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                                        @if ($errors->has('customer_name'))
                                            <div class="col-auto">
                                                <span class="form-text text-danger">
                                                    {{ $errors->first('customer_name') }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto">
                                        <button id="btn-modal" type="button" data-toggle="modal" data-target="#includeProduct"  class="btn btn-sm btn-primary">Add Item</button>
                                    </div>
                                    <div class="col-auto pl-0">
                                        <button id="btn-save" type="submit" class="btn btn-sm btn-success">Save Older</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 mt-4">
                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="180px">
                                                    <div class="row">
                                                        <span class="col-auto">Product ID</span>
                                                        <div class="col-auto ml-auto text-muted"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Product Name</span>
                                                        <div class="col-auto ml-auto text-muted"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Unit Price</span>
                                                        <div class="col-auto ml-auto text-muted"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th width="120px">
                                                    <div class="row">
                                                        <span class="col-auto">QTY</span>
                                                        <div class="col-auto ml-auto text-muted"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Sub Total</span>
                                                        <div class="col-auto ml-auto text-muted"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Action</span>
                                                        <div class="col-auto ml-auto text-muted"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @include('../inc/session-items')
                                            @include('../inc/session-products')
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ url('/order') }}" class="btn btn-success">
                                        <i class='bx bx-arrow-back'></i>
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="includeProduct" tabindex="-1" aria-labelledby="includeProductTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="includeProductTitle">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('cart.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-2">
                            <label for="id" class="form-label">Product ID</label>
                            <select id="product_id" name="product_id" class="form-control" onchange="productSelect(event)" required>
                                <option value="" disabled selected="selected">-- Select One --</option>
                                @foreach($products as $item)
                                    <option value="{{$item->id}}">{{ $item->product_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('product_id'))
                                <div id="productIdHelp" class="form-text text-danger d-none">{{ $errors->first('product_id') }}</div>
                            @endif
                        </div>
                        <div class="mb-2">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" disabled>
                        </div>
                        <div class="mb-2">
                            <label for="price" class="form-label">Product Price</label>
                            <input type="telp" class="form-control" id="price" name="price" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="qty" class="form-label">Qty</label>
                            <input type="number" class="form-control" id="qty" name="qty" min="0" placeholder="0" required>
                            @if ($errors->has('qty'))
                                <div id="productQtyHelp" class="form-text text-danger d-none">{{ $errors->first('qty') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button id="add-product" type="submit" class="btn btn-warning text-white">Add</button>
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <script>
            $( document ).ready(function() {
                $('#includeProduct').modal('show');
            });
        </script>
    @endif

    @if(Session::has('orders') && Session::has('orderproducts'))
        <script>
            $( document ).ready(function() {
                var orders = @json(Session::get('orders'));
                var orderprod = @json(Session::get('orderproducts'));
                if (orders) {
                    $('#order_id').val(orders.id)
                    $('#customer_name').val(orders.customer_name).prop('disabled', true);
                    $('#btn-save').addClass('d-none');
                    $('#btn-modal').addClass('d-none');
                    // set value date
                    let dt = new Date(orders.order_date);
                    var formattedDate = dt.toISOString().substr(0, 10)
                    $('#order_date').val(formattedDate).prop('disabled', true);
                }
                if (orderprod) {
                    $('#btn-delete').prop('disabled', true);
                }

                console.log(orders);
            })
        </script>
    @endif

    <script>
        var product = {!! json_encode($products->toArray()) !!};
        
        var prodId = document.querySelector("#product_id");
        var orderId = document.querySelector("#order_id");
        var orderDate = document.querySelector("#order_date");
        var customer = document.querySelector("#customer_name");

        orderId.value = ""
        orderDate.value = ""
        customer.value = ""

        prodId.value = ""
        if (prodId.value === "") {
            document.querySelector("#product_name").value = ""
            document.querySelector("#price").value = ""
        }

        function productSelect(e) {
            const id = JSON.parse(e.target.value)
            const prod = product.filter(item => item.id === id)[0]
            document.querySelector("#product_name").value = prod.product_name
            document.querySelector("#price").value = formatRupiah(prod.price)
        }

        function formatRupiah(bilangan){
			var	number_string = bilangan.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
			return rupiah
		}
    </script>
@endsection