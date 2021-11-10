<button id="createNew" class="btn btn-group"  style="display: inline-block; float: right; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
    <i class="fas fa-plus"></i>
    <span style="color: white">Add new</span>
</button>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No.</th>
        <th>Customer name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Birthday</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr data-id="{{$customer->id}}">
            <td>{{ ($customers ->currentpage()-1) * $customers ->perpage() + $loop->index + 1 }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone_number }}</td>
            <td>{{ $customer->address }}</td>
            <td>{{ $genderOptions[$customer->gender] }}</td>
            <td>{{ $customer->birthday }}</td>
            <td>
                <button class="btn btn-danger btn-edit"><i class="fas fa-edit"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $customers->links() !!}

