@extends('template')

@section('content')
    <div class="row mt-3 mb-2">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <div class="h4">Order List</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4 border">
                    
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
                            <form action="{{ route('order.index') }}" method="get" role="search">
                                <div class="row align-items-center mb-3">
                                    <div class="col-1">
                                        <label for="order_id" class="col-form-label"><b>Order ID</b></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="order_id" name="order_id" class="form-control" aria-describedby="orderHelpInline">
                                    </div>
                                    @if ($errors->has('order_id'))
                                        <div class="col-auto">
                                            <span id="orderHelpInline" class="form-text">
                                                {{ $errors->first('order_id') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col-1">
                                        <label for="costumer" class="col-form-label"><b>Customer</b></label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="customer_name" name="customer_name" class="form-control" aria-describedby="customerHelpInline">
                                    </div>
                                    @if ($errors->has('customer_name'))
                                        <div class="col-auto">
                                            <span id="customerHelpInline" class="form-text">
                                                {{ $errors->first('customer_name') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="row ps-2">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                                    </div>
                                    @if (auth()->user()->is_admin == 1)
                                        <div class="col-auto pl-0">
                                            <a class="btn btn-sm btn-success" href="{{ url('/order/create') }}">+ New Order</a>
                                        </div>
                                    @endif
                                    <div class="col-auto pl-0">
                                        <a class="btn btn-sm btn-info text-white" href="{{ url('/order') }}">
                                            <i class='bx bx-sync'></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 mt-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="{{ route('order.index') }}" class="m-0" method="GET" role="search">
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
                                            </form>
                                        </div>
                                        <div class="col-auto">
                                            <div class="row g-2 align-items-center mb-3">
                                                <div class="col-auto">
                                                    <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="search customer name ..">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="submit" class="btn btn-success">show</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="100px">
                                                    <div class="row">
                                                        <span class="col-auto">No</span>
                                                        <div class="col-auto ml-auto text-muted"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Order ID</span>
                                                        <div class="col-auto ml-auto text-muted"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <form class="m-0" action="{{ route('order.index') }}" method="GET" role="search">
                                                        <input type="hidden" name="sort_by" value="order_date">
                                                        <div class="row">
                                                            <span class="col-auto">Order Date</span>
                                                            <button type="submit" class="col-auto ml-auto btn-sort"><i class='bx bx-sort'></i></button>
                                                        </div>
                                                    </form>
                                                </th>
                                                <th>
                                                    <form class="m-0" action="{{ route('order.index') }}" method="GET" role="search">
                                                        <input type="hidden" name="sort_by" value="customer_name">
                                                        <div class="row">
                                                            <span class="col-auto">Customer</span>
                                                            <button type="submit" class="col-auto ml-auto btn-sort"><i class='bx bx-sort'></i></button>
                                                        </div>
                                                    </form>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Total Price</span>
                                                        <div class="col-auto ml-auto text-muted"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">
                                                        <span class="col-auto">Action</span>
                                                        <div class="col-auto ml-auto text-secondary"><i class='bx bx-sort'></i></div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $order)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ date('d M Y', strtotime($order->order_date)) }}</td>
                                                    <td>{{ $order->customer_name }}</td>
                                                    <td style="text-align: right">Rp {{ number_format($order->total) }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('order.destroy', $order) }}" method="POST">
                                                            <a class="btn btn-info btn-sm" href="{{ route('order.show', $order->id) }}">Show</a>
                                                            @csrf
                                                            @method('DELETE')
                                                            @if (auth()->user()->is_admin == 1)
                                                                <a class="btn btn-primary btn-sm" href="{{ route('order.edit', $order->id) }}">Edit</a>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete
                                                                </button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No data available in table</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row" style="justify-content: space-between">
                                        <div class="col-auto">
                                            <span>Showing <span id="from"></span> to <span id="to"></span> of <span id="entry"></span> entries</span>
                                        </div>
                                        <div class="col-auto">
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

    {{-- {!! $orders->links() !!} --}}

    <script>
        $(document).ready(function() {
            var page = @json($orders);
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
        })
    </script>
@endsection