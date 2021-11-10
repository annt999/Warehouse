<button id="createNew" class="btn btn-group"  style="display: inline-block; float: right; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
    <i class="fas fa-plus"></i>
    <span style="color: white">Add new</span>
</button>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No.</th>
        <th>Supplier name</th>
        <th>Supplier phone</th>
        <th>Supplier description</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($suppliers as $supplier)
        <tr data-id="{{$supplier->id}}">
            <td>{{ ($suppliers ->currentpage()-1) * $suppliers ->perpage() + $loop->index + 1 }}</td>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->phone }}</td>
            <td>{{ $supplier->description }}</td>
            <td>
                <button class="btn btn-danger btn-edit"><i class="fas fa-edit"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $suppliers->links() !!}

