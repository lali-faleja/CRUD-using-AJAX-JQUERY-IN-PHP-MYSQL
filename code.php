<?php

require 'dbcon.php';

if(isset($_POST['save_user']))
{
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    
    $image = $_FILES['profilepic']['name']; 
    $tempimage = $_FILES['profilepic']['tmp_name']; 
    $folder='images/'.$image;
    move_uploaded_file($tempimage,$folder);

    if($fname == NULL || $lname == NULL || $username == NULL || $email == NULL || $password == NULL || $gender == NULL || $dob == NULL || $image == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO user_info (fname,lname,username,email,password,gender,dob,profilepic) VALUES ('$fname','$lname','$username','$email','$password','$gender','$dob','$image')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'User Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'User Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_user']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);

    $image = $_FILES['upload']['name'];

        if($fname == NULL || $lname == NULL || $username == NULL || $email == NULL || $password == NULL || $gender == NULL || $dob == NULL)
        {
            $res = [
                'status' => 422,
                'message' => 'All fields are mandatory'
            ];
            echo json_encode($res);
            return;
        }

        if($image == NULL)
        {
            $query = "UPDATE user_info SET fname='$fname',lname='$lname',username='$username',email='$email',password='$password',gender='$gender',dob='$dob'
                    WHERE id='$user_id'";
            $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                $res = [
                    'status' => 200,
                    'message' => 'User Updated Successfully'
                ];
                echo json_encode($res);
                return;
            }
            else
            {
                $res = [
                    'status' => 500,
                    'message' => 'User Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
        else{
            $tempimage = $_FILES['upload']['tmp_name']; 
            $folder='images/'.$image;
            move_uploaded_file($tempimage,$folder);
            
            $query = "UPDATE user_info SET fname='$fname',lname='$lname',username='$username',email='$email',password='$password',gender='$gender',dob='$dob',profilepic='$image'
                    WHERE id='$user_id'";
            $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                $res = [
                    'status' => 200,
                    'message' => 'User Updated Successfully'
                ];
                echo json_encode($res);
                return;
            }
            else
            {
                $res = [
                    'status' => 500,
                    'message' => 'User Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
}


if(isset($_GET['user_id']))
{
    $user_id = mysqli_real_escape_string($con, $_GET['user_id']);

    $query = "SELECT * FROM user_info WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'User Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'User Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_student']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $query = "DELETE FROM user_info WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'User Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'User Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>
