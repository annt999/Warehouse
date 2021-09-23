<button id="createNew" class="btn btn-group"  style="display: inline-block; float: right; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
    <i class="fas fa-plus"></i>
    <span style="color: white">Add new</span>
</button>
<table class="table table-striped">
    <thead>
    <tr>
        <th>No.</th>
        <th>Category name</th>
        <th>Level option</th>
        <th>Category father</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr data-id="{{$category->id}}">
            <td>{{ ($categories ->currentpage()-1) * $categories ->perpage() + $loop->index + 1 }}</td>
            <td>{{ $category->category_name }}</td>
            <td>{{$levelOptions[$category->level]}}</td>
            @if($category->category_id)
            <td>{{$categoryFatherOptions[$category->category_id]->category_name}}</td>
            @else
            <td></td>
            @endif
            <td>
                <button class="btn btn-danger btn-edit"><i class="fas fa-edit"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $categories->links() !!}

