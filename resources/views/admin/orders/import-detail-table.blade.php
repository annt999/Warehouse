<div id="table-import-detail">
    <h3>Import code : {{$import_history_code}}</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>Product code</th>
            <th>Purchase price</th>
            <th>Sale price</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody>
        @foreach($import_details as $import_detail)
            <tr>
                <td>{{ ($import_details ->currentpage()-1) * $import_details ->perpage() + $loop->index + 1 }}</td>
                <td>{{ $import_detail->product_code }}</td>
                <td class="money">{{$import_detail->purchase_price}}</td>
                <td class="money">{{$import_detail->sale_price}}</td>
                <td>{{$import_detail->quantity}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $import_details->links() !!}
</div>
