<button id="search" class="btn btn-group"  style="display: inline-block; padding: 0.5rem; margin: 2rem 0; background-color: #20c997;">
    <i class="fas fa-search"></i>
    <span style="color: white">Search</span>
</button>
<button id="createNew" class="btn btn-group"  style="display: inline-block; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
    <i class="fas fa-plus"></i>
    <span style="color: white">Add new</span>
</button>
<a id="exportProduct" class="btn btn-group" href="{{route('product.export')}}" type="button"  style="display: inline-block; padding: 0.5rem; margin: 2rem 0; background-color: #e0626e">
    <i class="fas fa-file-export"></i>
    <span style="color: white">Export</span>
</a>
<button id="export" class="btn btn-group"  style="display: inline-block; padding: 0.5rem; margin: 2rem 0; background-color: #fd7e14">
    <i class="fas fa-download"></i>
    <span style="color: white">Import</span>
</button>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No.</th>
        <th>Product code</th>
        <th>Image</th>
        <th>Name</th>
        <th>Brand</th>
        <th>Category</th>
        <th>Quantity inventory</th>
        <th>Sale price</th>
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
            <td>
                <div class="img-table-container">
                    <img style="height: 75%" src="{{asset(Storage::url('images/'.$product->brand_image)) }}" alt="">
                    <p style="color: black; font-size: 14px; display: block; padding-top: 5px;">{{ $product->brand_name }}</p>
                </div>
            </td>
            <td>{{ $product->category_name }}</td>
            <td>{{ $product->quantity_inventory }}</td>
            <td class="money">{{ $product->sale_price }}</td>
            <td>
                <button class="btn btn-danger btn-edit"><i class="fas fa-edit"></i></button>
                <button class="btn btn-info btn-detail"><i class="fas fa-info-circle"></i></button>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $products->links() !!}

