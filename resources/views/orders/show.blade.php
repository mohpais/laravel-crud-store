@extends('template')

@section('content')
    <div class="row mt-4 mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <div class="h4">Order Entry</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
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
                    <div class="row">
                        <div class="col-sm-12">
                            <b>Order Info</b>
                        </div>
                        <div class="col-sm-12">
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
                                    <input type="date" id="customer" class="form-control" value="{{ date('Y-m-d', strtotime($order->order_date)) }}" disabled>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-2">
                                    <label for="costumer" class="col-form-label"><b>Customer Name</b></label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="customer" value="{{ $order->customer_name }}" class="form-control" disabled>
                                </div>
                            </div>
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
                                                <th width="200px">
                                                    <div class="row">
                                                        <span class="col-auto">Sub Total</span>
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
                                                </tr>
                                            @empty
                                                <tr class="">
                                                    <td colspan="6" class="text-center">No data available in table</td>
                                                </tr>
                                            @endforelse
                                            @if ($total > 0)
                                                <tr>
                                                    <td colspan="4" class="text-center">
                                                        <b>Total</b>
                                                    </td>
                                                    <td style="text-align: right">
                                                        Rp {{number_format($total)}}
                                                    </td>
                                                </tr>
                                            @endif
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