@extends('template')

@section('content')
    <div class="row mt-4 mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <div class="h4">Edit Order</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('error'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12">
                            <b>Order Info</b>
                        </div>
                        <div class="col-sm-12">
                            <form action="{{ route('order.update', $order) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row align-items-center mb-3">
                                    <div class="col-2">
                                        <label for="order_id" class="col-form-label"><b>Order ID</b></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="order_id" class="form-control" value="{{ $order->id }}" disabled>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-2">
                                        <label for="costumer" class="col-form-label"><b>Order Date</b></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" id="order_date" name="order_date" class="form-control" value="{{ date('Y-m-d', strtotime($order->order_date)) }}" required>
                                    </div>
                                    @if (Session::has('error'))
                                        <div class="col-auto">
                                            <span id="orderHelpInline" class="form-text">
                                                {{Session::get('error')}}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-2">
                                        <label for="costumer" class="col-form-label"><b>Customer Name</b></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="customer_name" name="customer_name" value="{{ $order->customer_name }}" class="form-control" required>
                                    </div>
                                    @if (Session::has('error'))
                                        <div class="col-auto">
                                            <span id="orderHelpInline" class="form-text">
                                                {{Session::get('error')}}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                @php $total = 0 @endphp
                                @foreach ($products as $item)
                                    @php $total += $item->price * $item->qty @endphp
                                @endforeach
                                <div class="row align-items-center mb-1">
                                    <div class="col-2">
                                        <label for="costumer" class="col-form-label"><b>Sub Total</b></label>
                                    </div>
                                    <div class="col-auto">
                                        <span>
                                            <b>Rp {{ number_format($total)}}</b>
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12">
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
                                                <th width="200px">
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
                                            @php $total = 0 @endphp
                                            @forelse ($products as $item)
                                                @php $total += $item->price * $item->qty @endphp
                                                <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->product_name}}</td>
                                                    <td>{{$item->price}}</td>
                                                    <td class="text-center">{{$item->qty}}</td>
                                                    <td style="text-align: right">Rp {{number_format($item->sub_total)}}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('orderproduct.delete', $item['id']) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="">
                                                    <td colspan="6" class="text-center">No data available in table</td>
                                                </tr>
                                            @endforelse
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
    <script>
        $(document).ready(function() {
            var x = @json($products);
            console.log(x);
        })
    </script>
@endsection