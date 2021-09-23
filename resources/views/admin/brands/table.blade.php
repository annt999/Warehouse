<button id="createNew" class="btn btn-group"  style="display: inline-block; float: right; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
    <i class="fas fa-plus"></i>
    <span style="color: white">Add new</span>
</button>
<table class="table table-striped">
    <thead>
    <tr>
        <th>No.</th>
        <th>Brand name</th>
        <th>Brand logo</th>
        <th>Brand description</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($brands as $brand)
        <tr data-id="{{$brand->id}}">
            <td>{{ ($brands ->currentpage()-1) * $brands ->perpage() + $loop->index + 1 }}</td>
            <td>{{ $brand->brand_name }}</td>
            <td>
                <div class="img-table-container">
                    <img src="{{asset(Storage::url('images/'.$brand->image)) }}" alt="">
                </div>
            </td>
            <td>{{ $brand->description }}</td>
            <td>
                <button class="btn btn-danger btn-edit"><i class="fas fa-edit"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $brands->links() !!}

