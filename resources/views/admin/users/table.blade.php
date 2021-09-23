<button id="createNew" class="btn btn-group"  style="display: inline-block; float: right; padding: 0.5rem; margin: 2rem 0; background-color: #247a8b">
    <i class="fas fa-plus"></i>
    <span style="color: white">Add new</span>
</button>
<table class="table table-striped">
    <thead>
    <tr>
        <th>No.</th>
        <th>User name</th>
        <th>Full name</th>
        <th>Email</th>
        <th>Phone number</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr data-id="{{$user->id}}">
                <td>{{ ($users ->currentpage()-1) * $users ->perpage() + $loop->index + 1 }}</td>
                <td>{{ $user->user_name }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{$roleOptions[$user->role_id]}}</td>
                <td>{{$activeOptions[$user->is_active]}}</td>
                <td>
                    <button class="btn btn-success btn-detail"><i class="fa fa-info-circle"></i></button>
                    <button class="btn btn-danger btn-edit"><i class="fas fa-edit"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $users->links() !!}

