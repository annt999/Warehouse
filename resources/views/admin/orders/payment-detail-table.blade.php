<div id="table-payment-detail">
    <h3 class="order_code_text">Order code : {{$order_code}}</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>Payment money</th>
            <th>Created by</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payment_details as $payment_detail)
            <tr>
                <td>{{ ($payment_details ->currentpage()-1) * $payment_details ->perpage() + $loop->index + 1 }}</td>
                <td class="money">{{ $payment_detail->payment_money }}</td>
                <td >{{$payment_detail->created_by}}</td>
                <td>{{$payment_detail->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $sale_details->links() !!}
</div>
