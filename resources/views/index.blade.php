@extends('layouts.main')

@section('container')
    <header>
        <h1 class="mb-3 mt-3 text-center">User List</h1>
    </header>

    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12">
                    <button class="btn btn-primary rounded mb-2" data-bs-toggle="modal" data-bs-target="#ModalAdd"><i
                            class="bi bi-plus"></i> Add User</button>
                    <div class="card shadow">
                        <div class="card-body" id="dataPage">
                            <div class="d-flex justify-content-center mt-3">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Add -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="form-add"  enctype="multipart/form-data" action="#" method="POST">
                        @csrf
                        
                         <div class="form-group">
                            <label for="Name">Full Name</label>
                            <input type="text" name="fullname" id="fullnameAdd" class="form-control"
                                placeholder="Enter Full Name"/>
                            <div id="fullnameAdd_error" class="error mt-1" style="color:red;display: none;">
                               Please Enter Full Name
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="emailAdd" class="form-control"
                                placeholder="Enter Email"/>
                            <div id="emailAdd_error" class="error mt-1" style="color:red;display: none;">
                               Please Enter Email
                            </div>
                            <div id="invalid_emailAdd_error" class="error mt-1" style="color:red;display: none;"> Please Enter Valid Email
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="Phone" >Phone</label>
                            <input type="text" name="phone" id="phoneAdd" class="form-control phone"
                                placeholder="Enter Phone Number"/>
                            <div id="phoneAdd_error" class="error mt-1" style="color:red;display: none;">
                               Please Enter Phone Number
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="Gender">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genderAdd" id="male" value="male" checked>
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genderAdd" id="female" value="female">
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>
                            <div id="genderAdd_error" class="error mt-1" style="color:red;display: none;">
                               Please Select Gender
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="education" >Education</label>
                            <select class="form-select " name="education_id" id="education_idAdd">
                                <option value="">Select Education</option>
                                @foreach ($educations as $education)
                                    <option value="{{ $education->id }}">{{ $education->title }}</option>
                                @endforeach
                            </select>
                            <div id="educationAdd_error" class="error mt-1" style="color:red;display: none;">
                               Please Select Education
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Hobbies">Hobbies</label><br>
                            <input type="checkbox" class="hobbyAdd" name="hobby[]" value="Cricket" id="hobby_cricket">
                            <label for="hobby_cricket">Cricket</label>

                            <input type="checkbox" class="hobbyAdd" name="hobby[]" value="Singing" id="hobby_singing">
                            <label for="hobby_singing">Singing</label>

                            <input type="checkbox" class="hobbyAdd" name="hobby[]" value="Traveling" id="hobby_traveling">
                            <label for="hobby_traveling">Traveling</label>
                            <div id="hobbyAdd_error" class="error mt-1" style="color:red;display: none;">
                               Please Select Atleast One Hobby
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <img class="img-preview img-fluid col-sm-5 d-block">
                            <input class="form-control" type="file" id="imageAdd" name="image"
                                onchange="previewImage()">
                            <div id="imageAdd_error" class="error mt-1" style="color:red;display: none;">
                               Please Select Image
                            </div>
                            <div id="imageAdd_size_error" class="error mt-1" style="color:red;display: none;"> Image size exceeds the maximum allowed (2 MB).
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <input type="text" name="message" id="messageAdd" class="form-control"
                                placeholder="Enter Message" />
                            <div id="messageAdd_error" class="error mt-1" style="color:red;display: none;">
                               Please Enter Message
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add_user_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="ModalDetail" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="form-detail" enctype="multipart/form-data" action="#" method="POST">
                        @csrf
                        
                        <div class="mt-2 d-flex justify-content-center" id="imageDet"></div>
                        <div class="form-group">
                            <label for="Name">Full Name</label>
                            <input type="text" name="fullname" id="fullnameDet" class="form-control"
                                placeholder="Enter Full Name" readonly />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="emailDet" class="form-control"
                                placeholder="Enter Email" readonly />
                            <div id="email_error" class="error mt-1" style="color:red;display: none;">
                               Please Enter Email
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Phone" >Phone</label>
                            <input type="text" name="phone" id="phoneDet" class="form-control"
                                placeholder="Enter Phone Number" readonly />
                        </div>

                        <div class="form-group ">
                            <label for="Gender">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genderDet" id="male" value="Male" checked>
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genderDet" id="female" value="Female" readonly>
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="education" >Education</label>
                            <select class="form-select " name="education_id" id="education_idDet" disabled>
                                <option value="">Select Education</option>
                                @foreach ($educations as $education)
                                    <option value="{{ $education->id }}">{{ $education->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Hobbies">Hobbies</label><br>
                            <input type="checkbox" class="hobbyDel" name="hobbys[]" value="Cricket" id="hobby_cricket" >
                            <label for="hobby_cricket">Cricket</label>

                            <input type="checkbox" class="hobbyDel" name="hobbys[]" value="Singing" id="hobby_singing" >
                            <label for="hobby_singing">Singing</label>

                            <input type="checkbox" class="hobbyDel" name="hobbys[]" value="Traveling" id="hobby_traveling" >
                            <label for="hobby_traveling">Traveling</label>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <input type="text" name="message" id="messageDet" class="form-control"
                                placeholder="Enter Message" readonly/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="form-edit" enctype="multipart/form-data" action="#" method="POST">
                        @csrf
                        <div class="mt-2 d-flex justify-content-center" id="imageEdits"></div>
                        <input type="hidden" id="idEdit" name="idEdit" />
                        <div class="form-group">
                            <label for="Name">Full Name</label>
                            <input type="text" name="fullname" id="fullnameEdit" class="form-control"
                                placeholder="Enter Full Name"/>
                            <div id="fullnameEdit_error" class="error mt-1" style="color:red;display: none;">
                               Please Enter Full Name
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="emailEdit" class="form-control"
                                placeholder="Enter Email"/>
                            <div id="emailEdit_error" class="error mt-1" style="color:red;display: none;">
                               Please Enter Email
                            </div>
                            <div id="invalid_emailEdit_error" class="error mt-1" style="color:red;display: none;"> Please Enter Valid Email
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="Phone" >Phone</label>
                            <input type="text" name="phone" id="phoneEdit" class="form-control phone"
                                placeholder="Enter Phone Number"/>
                            <div id="phoneEdit_error" class="error mt-1" style="color:red;display: none;">
                               Please Enter Phone Number
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="Gender">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genderEdit" id="male" value="male" checked>
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genderEdit" id="female" value="female">
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>
                            <div id="genderEdit_error" class="error mt-1" style="color:red;display: none;">
                               Please Select Gender
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="education" >Education</label>
                            <select class="form-select " name="education_id" id="education_idEdit">
                                <option value="">Select Education</option>
                                @foreach ($educations as $education)
                                    <option value="{{ $education->id }}">{{ $education->title }}</option>
                                @endforeach
                            </select>
                            <div id="educationEdit_error" class="error mt-1" style="color:red;display: none;">
                               Please Select Education
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Hobbies">Hobbies</label><br>
                            <input type="checkbox" class="hobbyEdit" name="hobby[]" value="Cricket" id="hobby_cricket">
                            <label for="hobby_cricket">Cricket</label>

                            <input type="checkbox" class="hobbyEdit" name="hobby[]" value="Singing" id="hobby_singing">
                            <label for="hobby_singing">Singing</label>

                            <input type="checkbox" class="hobbyEdit" name="hobby[]" value="Traveling" id="hobby_traveling">
                            <label for="hobby_traveling">Traveling</label>
                            <div id="hobbyEdit_error" class="error mt-1" style="color:red;display: none;">
                               Please Select Atleast One Hobby
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <img class="img-previewEdit img-fluid col-sm-5 d-block">
                            <input class="form-control" type="file" id="imageEdit" name="image"
                                onchange="previewImageEdit()">
                            <div id="imageEdit_size_error" class="error mt-1" style="color:red;display: none;">Image size exceeds the maximum allowed (2 MB).
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <input type="text" name="message" id="messageEdit" class="form-control"
                                placeholder="Enter Message" />
                            <div id="messageEdit_error" class="error mt-1" style="color:red;display: none;">
                               Please Enter Message
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add_user_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- untuk jquery ajax --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>

        $(document).on('keypress', '.phone', function(e) {
            var charCode = (e.which) ? e.which : event.keyCode;
            var inputValue = $(this).val();

            if (String.fromCharCode(charCode).match(/[^0-9]/g) || inputValue.length >= 10) {
                return false;
            }
        });
        
        $("#form-add").submit(function (e) {
            e.preventDefault();
            
            // Validation logic here
            let isValid = true;
            
            // Full Name
            const fullname = $("#fullnameAdd").val().trim();
            if (fullname === "") {
                $("#fullnameAdd_error").show();
                isValid = false;
            } else {
                $("#fullnameAdd_error").hide();
            }
            
            // Email
            const email = $("#emailAdd").val().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === "") {
                $("#emailAdd_error").show();
                isValid = false;
            } else if (!emailRegex.test(email)) {
                $("#invalid_emailAdd_error").show();
                $("#emailAdd_error").hide();
                isValid = false;
            } else {
                $("#emailAdd_error").hide();
                $("#invalid_emailAdd_error").hide();
            }

            // Phone
            const phone = $("#phoneAdd").val().trim();
            if (phone === "") {
                $("#phoneAdd_error").show();
                isValid = false;
            } else {
                $("#phoneAdd_error").hide();
            }
            
            // Gender
            const gender = $("input[name='genderAdd']:checked").val();
            if (!gender) {
                $("#genderAdd_error").show();
                isValid = false;
            } else {
                $("#genderAdd_error").hide();
            }

            // Education
            const education = $("#education_idAdd").val();
            if (!education) {
                $("#educationAdd_error").show();
                isValid = false;
            } else {
                $("#educationAdd_error").hide();
            }


            //Hobby
            const hobbyCheckboxes = document.querySelectorAll('.hobbyAdd');

            let hobbySelected = false; 
            for (const checkbox of hobbyCheckboxes) {
                if (checkbox.checked) {
                    hobbySelected = true;
                    break;
                }
            }

            if (!hobbySelected) {
                $("#hobbyAdd_error").show();
                isValid = false;
            } else {
                $("#hobbyAdd_error").hide();
            }

            // Image
            const image = $("#imageAdd").val();
            if (!image) {
                $("#imageAdd_error").show();
                isValid = false;
            } else {
                $("#imageAdd_error").hide();
            }
            
            const message = $("#messageAdd").val().trim();
            if (message === "") {
                $("#messageAdd_error").show();
                isValid = false;
            } else {
                $("#messageAdd_error").hide();
            }

            const inputs = document.getElementById('imageAdd');
            const file = inputs.files[0];
            const maxSize = 2 * 1024 * 1024;
            if (file && file.size > maxSize) {    
                $("#imageAdd_size_error").show();
                isValid = false;
            } else {
                $("#imageAdd_size_error").hide();
            }

            if (isValid) {
                const dataForm = new FormData(this);
                console.log(dataForm);
                $("#add_user_btn").text('Adding ...');
                $.ajax({
                    url: '{{ route('save.users') }}',
                    method: 'POST',
                    data: dataForm,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            swal({
                                title: "Success!",
                                text: "New record has been saved!",
                                icon: "success",
                                button: "Close",
                            });
                            fetch();
                            $("#form-add")[0].reset();
                        } else {
                            swal({
                                title: "Error!",
                                text: "Something Wrong",
                                icon: "error",
                                button: "Close",
                            });
                        }
                        $("#add_user_btn").text('Submit');
                        $("#ModalAdd").modal('hide');
                    }
                });
            }
        });


        // preview image add
        function previewImage() {
            const image = document.querySelector('#imageAdd');
            const imgPreview = document.querySelector('.img-preview')
            const blob = URL.createObjectURL(image.files[0]);
            imgPreview.src = blob;
            $('.img-preview').css({'height': '100px', 'width': '150px' });
        }

        // preview image edit
        function previewImageEdit() {
            const image = document.querySelector('#imageEdit');
            const imgPreview = document.querySelector('.img-previewEdit')
            const blob = URL.createObjectURL(image.files[0]);
            imgPreview.src = blob;
            $('.img-previewEdit').css({'height': '100px', 'width': '150px' });
        }


         // delete ajax request
            $(document).on('click', '.deleteUser', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this record!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ route('delete.users') }}',
                                method: 'DELETE',
                                data: {
                                    id: id,
                                    _token: csrf
                                },
                                success: function(response) {
                                    if (response.status == 200) {
                                        swal({
                                            title: "Success!",
                                            text: "Record has been deleted!",
                                            icon: "success",
                                            button: "Close",
                                        });
                                        fetch();
                                    } else {
                                        swal({
                                            title: "Error!",
                                            text: "Someting Wrong",
                                            icon: "error",
                                            button: "Close",
                                        });
                                    }
                                }
                            });
                        } else {
                            swal("Record is safe!");
                        }
                    });
            });

            // detail ajax request
            $(document).on('click', '.detailUser', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('detail.users') }}',
                    method: 'GET',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        //console.log(response);
                        $("#fullnameDet").val(response.user.fullname);
                        $("#education_idDet").val(response.user.education_id);
                        $("#messageDet").val(response.user.message);
                        $("#emailDet").val(response.user.email);
                        $("#phoneDet").val(response.user.phone);
                        $('input[name="genderDel"][value="' + response.user.gender + '"]').prop('checked', true);
                        var hobbyValues = response.user.hobby.split(', ');
                        $('.hobbyDel').each(function() {
                            var checkbox = $(this);
                            var checkboxValue = checkbox.val();
                            
                            if (hobbyValues.includes(checkboxValue)) {
                                checkbox.prop('checked', true);
                            } else {
                                checkbox.prop('checked', false);
                            }
                        });

                        $("#imageDet").html(
                            `<img src="{{ asset('uploads/user/${response.user.image}') }}" width="200" height="200" class="img-fluid img-thumbnail">`
                        );
                    }
                });
            });

            // edit ajax request
            $(document).on('click', '.editUser', function(e) {
                e.preventDefault();

                
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '{{ route('edit.users') }}',
                        method: 'GET',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response);
                            $("#fullnameEdit").val(response.fullname);
                            $("#education_idEdit").val(response.education_id);
                            $("#messageEdit").val(response.message);
                            $("#emailEdit").val(response.email);
                            $("#phoneEdit").val(response.phone);
                            $('input[name="genderEdit"][value="' + response.gender + '"]').prop('checked', true);
                            var hobbyValues = response.hobby.split(', ');
                            $('.hobbyEdit').each(function() {
                                var checkbox = $(this);
                                var checkboxValue = checkbox.val();
                                
                                if (hobbyValues.includes(checkboxValue)) {
                                    checkbox.prop('checked', true);
                                } else {
                                    checkbox.prop('checked', false);
                                }
                            });

                            $("#imageEdits").html(
                                `<img src="{{ asset('uploads/user/${response.image}') }}" width="200" height="200" class="img-fluid img-thumbnail">`
                            );
                            $("#idEdit").val(response.id);
                        }
                    });
                });

            // update ajax request
            $("#form-edit").submit(function(e) {
                //stop submit the form, we will post it manually.
                e.preventDefault();
                
                // Validation logic here
                let isValid = true;
                
                // Full Name
                const fullname = $("#fullnameEdit").val().trim();
                if (fullname === "") {
                    $("#fullnameEdit_error").show();
                    isValid = false;
                } else {
                    $("#fullnameEdit_error").hide();
                }
                
                // Email
                const email = $("#emailEdit").val().trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email === "") {
                    $("#emailEdit_error").show();
                    isValid = false;
                } else if (!emailRegex.test(email)) {
                    $("#invalid_emailEdit_error").show();
                    isValid = false;
                } else {
                    $("#emailEdit_error").hide();
                    $("#invalid_emailEdit_error").hide();
                }

                // Phone
                const phone = $("#phoneEdit").val().trim();
                if (phone === "") {
                    $("#phoneEdit_error").show();
                    isValid = false;
                } else {
                    $("#phoneEdit_error").hide();
                }
                
                // Gender
                const gender = $("input[name='genderEdit']:checked").val();
                if (!gender) {
                    $("#genderEdit_error").show();
                    isValid = false;
                } else {
                    $("#genderEdit_error").hide();
                }

                // Education
                const education = $("#education_idEdit").val();
                if (!education) {
                    $("#educationEdit_error").show();
                    isValid = false;
                } else {
                    $("#educationEdit_error").hide();
                }

                //Hobby
                const hobbyCheckboxes = document.querySelectorAll('.hobbyEdit');

                for (const checkbox of hobbyCheckboxes) {
                    if (checkbox.checked) {
                        isValid = true;
                        break;
                    }
                }

                if (!isValid) {
                    $("#hobbyEdit_error").show();
                } else {
                    $("#hobbyEdit_error").hide();
                }

                const message = $("#messageEdit").val().trim();
                if (fullname === "") {
                    $("#messageEdit_error").show();
                    isValid = false;
                } else {
                    $("#messageEdit_error").hide();
                }

                const inputs = document.getElementById('imageEdit');
                const file = inputs.files[0];
                const maxSize = 2 * 1024 * 1024;
                if (file && file.size > maxSize) {    
                    $("#imageEdit_size_error").show();
                    isValid = false;
                } else {
                    $("#imageEdit_size_error").hide();
                }

                // If all fields are valid, proceed with the form submission
                if (isValid) {
                    var form = $('#form-edit')[0];
                    console.log(form);
                    // FormData object
                    var dataForm = new FormData(form);
                    $("#edit_user_btn").text('Updating ...');
                    $.ajax({
                        url: '{{ route('update.users') }}',
                        method: 'POST',
                        data: dataForm,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 200) {
                                swal({
                                    title: "Updated!",
                                    text: "Record has been updated!",
                                    icon: "success",
                                    button: "Close",
                                });
                                fetch();
                            } else {
                                swal({
                                    title: "Error!",
                                    text: "Someting Wrong",
                                    icon: "error",
                                    button: "Close",
                                });
                            }
                            $("#edit_user_btn").text('Submit');
                            $("#ModalEdit").modal('hide');
                        }
                    });
                }
            });

            //get record
            fetch();

            function fetch() {
                $.ajax({
                    url: '{{ url('fetch') }}',
                    method: 'GET',
                    success: function(response) {
                        $("#dataPage").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }
    
    </script>
@endsection

