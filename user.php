<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PHP CRUD using jquery ajax without page reload</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!-- Add User -->
<div class="modal fade" id="userAddModal" data-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveUser">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">First Name</label>
                    <input type="text" name="fname" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Last Name</label>
                    <input type="text" name="lname" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">User Name</label>
                    <input type="text" name="username" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" />
                </div>
                <div class="mb-3">
                    <label> Gender : &nbsp; </label>
                        <select class="select" name="gender">
                            <option value="">---Select Gender---</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                </div>
                <div class="mb-3">
                    <label class="control-label" for="date">Date Of Birth : </label>
                    <input class="form-control" name="dob" placeholder="MM/DD/YYY" type="date"/>
                </div>
                <div class="mb-3">
                    <label class="custom-file-label" for="profilepic">Profile Picture : &nbsp;</label>
                    <input type="file" class="custom-file-input" name="profilepic" aria-describedby="inputGroupFileAddon01"> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save User</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="userEditModal" data-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateUser">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="user_id" id="user_id" >

                <div class="mb-3">
                    <label for="">First Name</label>
                    <input type="text" name="fname" id="fname" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">User Name</label>
                    <input type="text" name="username" id="username" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" id="email" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" id="password" class="form-control" />
                </div>
                <div class="mb-3">
                    <label> Gender : &nbsp; </label>
                        <select class="select" name="gender" id="gender">
                            <option value="">---Select Gender---</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                </div>
                <div class="mb-3">
                    <label class="control-label" for="date">Date Of Birth : </label>
                    <input class="form-control" name="dob" id="dob" placeholder="MM/DD/YYY" type="date"/>
                </div>
                <div class="mb-3">
                    <p>Profile Picture : </p>
                </div>
                <div id="display" class="mb-3">
                </div>
                <div class="mb-3">
                    <label class="custom-file-label" for="profilepic">Change profile Pic : &nbsp;</label>
                    <input type="file" class="custom-file-input" name="upload" id="upload" aria-describedby="inputGroupFileAddon01"> 
                 </div>              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>PHP Ajax CRUD without page reload using Bootstrap Modal
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#userAddModal">
                            Add User
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Gender</th>
                                <th>Date Of Birth</th>
                                <th>Profile Picture</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'dbcon.php';

                            $query = "SELECT * FROM user_info";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $user)
                                {
                                    ?>
                                    <tr>
                                        <td class="align-middle"><?= $user['id'] ?></td>
                                        <td class="align-middle"><?= $user['fname'] ?></td>
                                        <td class="align-middle"><?= $user['lname'] ?></td>
                                        <td class="align-middle"><?= $user['username'] ?></td>
                                        <td class="align-middle"><?= $user['email'] ?></td>
                                        <td class="align-middle"><?= $user['password'] ?></td>
                                        <td class="align-middle"><?= $user['gender'] ?></td>
                                        <td class="align-middle"><?= $user['dob'] ?></td>
                                        <td class="align-middle"><img class="text-center" src="images/<?= $user['profilepic'] ?>" height="100" width="100"></td>
                                        <td class="align-middle">
                                            <button type="button" value="<?=$user['id'];?>" class="editUserBtn btn btn-success btn-sm">Edit</button>
                                            <button type="button" value="<?=$user['id'];?>" class="deleteUserBtn btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#saveUser', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_user", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#userAddModal').modal('hide');
                        $('#saveUser')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editUserBtn', function () {

            var user_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?user_id=" + user_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#user_id').val(res.data.id);
                        $('#fname').val(res.data.fname);
                        $('#lname').val(res.data.lname);
                        $('#username').val(res.data.username);
                        $('#email').val(res.data.email);
                        $('#password').val(res.data.password);
                        $('#gender').val(res.data.gender);
                        $('#dob').val(res.data.dob);

                        var url = 'images/'+(res.data.profilepic);
                        $('#display').html('<img src="'+url+'" height="100" width="100">'); 

                        $('#userEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateUser', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_user", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#userEditModal').modal('hide');
                        $('#updateUser')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.deleteUserBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var user_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_student': true,
                        'user_id': user_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });

    </script>

</body>
</html>