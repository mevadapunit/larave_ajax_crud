<div class="table-responsive pt-2 pb-2 mb-3">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Hobby</th>
                <th scope="col">Email</th>
                <th scope="col">Picture</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@if($user->fullname != null){{ $user->fullname }}@else{{"N/A"}}@endif</td>
                    <td>@if($user->hobby != null){{ $user->hobby }}@else{{"N/A"}}@endif</td>
                    <td>@if($user->email != null){{$user->email}}@else{{"N/A"}}@endif</td>
                    <td>@if($user->image != null)
                        <img style="height: 50px;width: 70px;" src="{{ asset('uploads/user/'.$user->image) }}" alt="User Image">
                        @else
                        {{"N/A"}}
                        @endif
                    </td>
                    <td>
                        <a id="{{ $user->id }}" class="btn btn-info detailUser" data-bs-toggle="modal" data-bs-target="#ModalDetail" style="color: white;"><i class="bi bi-eye"></i></a>
                        <a id="{{ $user->id }}" class="btn btn-warning editUser" data-bs-toggle="modal" data-bs-target="#ModalEdit" style="color: white;"><i class="bi bi-pencil-square"></i></a>
                        <a id="{{ $user->id }}" class="btn btn-danger border-0 deleteUser"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            @empty

            @endforelse
        </tbody>
    </table>
</div>

