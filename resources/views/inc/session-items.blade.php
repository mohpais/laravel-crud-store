@if (session('items'))
    @forelse (session('items') as $item)
        <tr>
            <td>{{$item['id']}}</td>
            <td>{{$item['product_name']}}</td>
            <td style="text-align: right">Rp {{number_format($item['price'])}}</td>
            <td style="text-align: right">{{$item['qty']}}</td>
            <td style="text-align: right">Rp {{number_format($item['price'] * $item['qty'])}}</td>
            <td>
                <form action="{{ route('cart.delete', $item['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">No data available in table</td>
        </tr>
    @endforelse
    <tr>
        <td colspan="4">
            <b>Total:</b>
        </td>
        @php $total = 0 @endphp
        @foreach(session('items') as $item)
            @php $total += $item['price'] * $item['qty'] @endphp
        @endforeach
        <td style="text-align: right">
            Rp {{number_format($total)}}
        </td>
        <td></td>
    </tr>
@else
    @if (!session('orderproducts'))
        <tr>
            <td colspan="6" class="text-center">No data available in table</td>
        </tr>
    @endif
@endif