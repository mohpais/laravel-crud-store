@if (session('orderproducts'))
    @forelse (session('orderproducts') as $item)
        <tr>
            <td>{{$item['product_id']}}</td>
            <td>{{$item['product_name']}}</td>
            <td style="text-align: right">Rp {{number_format($item['price'])}}</td>
            <td style="text-align: right">{{$item['qty']}}</td>
            <td style="text-align: right">Rp {{number_format($item['price'] * $item['qty'])}}</td>
            <td class="text-center">
                <form action="{{ route('orderproduct.delete', $item['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="btn-delete" type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete
                    </button>
                    <script>
                        $( document ).ready(function() {
                            var orderprod = @json(Session::get('orderproducts'));
                            if (orderprod) {
                                $('#btn-delete').prop('disabled', true);
                            }
                        })
                    </script>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No data available in table</td>
        </tr>
    @endforelse
    <tr>
        <td colspan="4">
            <b>Total:</b>
        </td>
        @php $total = 0 @endphp
        @foreach(session('orderproducts') as $item)
            @php $total += $item['price'] * $item['qty'] @endphp
        @endforeach
        <td style="text-align: right">
            Rp {{number_format($total)}}
        </td>
        <td></td>
    </tr>
@endif








