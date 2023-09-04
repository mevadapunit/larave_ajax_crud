<div class="table-responsive pt-2 pb-2 mb-3">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Education</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($educations as $education)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $education->title }}</td>
                    <td>
                        <a id="{{ $education->id }}" class="btn btn-warning editEducation" data-bs-toggle="modal" data-bs-target="#ModalEdit" style="color: white;"><i class="bi bi-pencil-square"></i></a>
                        <a id="{{ $education->id }}" class="btn btn-danger border-0 deleteCategory"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            @empty

            @endforelse
        </tbody>
    </table>
</div>

