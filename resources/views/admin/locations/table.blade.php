<button id="createNew" class="btn btn-group"  style="display: inline-block; float: right; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
    <i class="fas fa-plus"></i>
    <span style="color: white">Add new</span>
</button>
<table class="table table-striped">
    <thead>
    <tr>
        <th>No.</th>
        <th>Location name</th>
        <th>Description</th>
=        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($locations as $location)
        <tr data-id="{{$location->id}}">
            <td>{{ ($locations ->currentpage()-1) * $locations ->perpage() + $loop->index + 1 }}</td>
            <td>{{ $location->location_name }}</td>
            <td>{{ $location->description }}</td>
            <td>
                <button class="btn btn-danger btn-edit"><i class="fas fa-edit"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $locations->links() !!}

