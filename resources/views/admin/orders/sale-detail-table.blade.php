<div id="table-sale-detail">
    <h3>Order code : {{$sale_history_code}}</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>Product code</th>
            <th>Image</th>
            <th>Sale price</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sale_details as $sale_detail)
            <tr>
                <td>{{ ($sale_details ->currentpage()-1) * $sale_details ->perpage() + $loop->index + 1 }}</td>
                <td>{{ $sale_detail->product_code }}</td>
                <td>
                    <div class="img-table-container">
                        <img src="{{asset(Storage::url('images/'.$product->image)) }}" alt="">
                    </div>
                </td>
                <td class="money">{{$sale_detail->sale_price}}</td>
                <td>{{$sale_detail->quantity}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $sale_details->links() !!}
</div>
