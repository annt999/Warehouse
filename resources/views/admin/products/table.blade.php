<button id="createNew" class="btn btn-group"  style="display: inline-block; float: right; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
    <i class="fas fa-plus"></i>
    <span style="color: white">Add new</span>
</button>
<table class="table table-striped">
    <thead>
    <tr>
        <th>No.</th>
        <th>Product code</th>
        <th>Image</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Purchase price</th>
        <th>Sale price</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr data-id="{{$product->id}}">
            <td>{{ ($products ->currentpage()-1) * $products ->perpage() + $loop->index + 1 }}</td>
            <td>{{ $product->product_code }}</td>
            <td>
                <div class="img-table-container">
                    <img src="{{asset(Storage::url('images/'.$product->image)) }}" alt="">
                </div>
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->purchase_price }}</td>
            <td>{{ $product->sale_price }}</td>
            <td>{{ $product->description }}</td>
            <td>
                <button class="btn btn-danger btn-edit"><i class="fas fa-edit"></i></button>
                <button class="btn btn-info btn-edit"><i class="fas fa-info-circle"></i></button>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $products->links() !!}

