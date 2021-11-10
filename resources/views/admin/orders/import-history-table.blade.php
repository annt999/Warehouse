<div id="table-import-history">
    <a href="{{route('order.import.create')}}" class="btn btn-group"  style="display: inline-block; float: right; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
        <i class="fas fa-plus"></i>
        <span style="color: white">Add new</span>
    </a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>Invoice code</th>
            <th>Number of items</th>
            <th>Total</th>
            <th>Created by</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($import_invoices as $import_invoice)
        <tr>
            <td>{{ ($import_invoices ->currentpage()-1) * $import_invoices ->perpage() + $loop->index + 1 }}</td>
            <td>{{ $import_invoice->code }}</td>
            <td>{{$import_invoice->number_of_items}}</td>
            <td class="money">{{$import_invoice->total}}</td>
            <td>{{$import_invoice->created_by}}</td>
            <td>{{$import_invoice->created_at}}</td>
            <td>
                <a type="button" href="{{route('order.import.detail', ['id' => $import_invoice->code])}}" class="btn btn-info"><i class="fas fa-info"></i></a>            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {!! $import_invoices->links() !!}


</div>
