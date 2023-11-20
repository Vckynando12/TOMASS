<?php
session_start();
require '../koneksi/koneksi.php';

if (isset($_POST['loginbtn'])){
    $email  = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $query = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
    $countdata = mysqli_num_rows($query);
    $data = mysqli_fetch_assoc($query);

    if($countdata > 0){
        $hashed = password_hash($data['password'], PASSWORD_BCRYPT);
        if(password_verify($password, $hashed)){
            $_SESSION['username'] = $data;
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $data['id_user'];
            $_SESSION['level'] = $data['level'];


            if($data['level'] == 1){
                header('location: ../admin/dashboard_admin.php');
                exit();
            }
            elseif($data['level'] == 2 || $data['level'] == 3) {
                header('location: ../public/index.php');
                exit();
            }
        }
        else{
            $password_error = true;
        }
    }
    else{
        $account_not_found = true;
    }
}

    // session_start();
    // require '../koneksi/koneksi.php';
    
    // if (isset($_POST['loginbtn'])){
    //     $email = htmlspecialchars($_POST['email']);
    //     $password = htmlspecialchars($_POST['password']);
    
    //     $stmt = $con->prepare("SELECT * FROM user WHERE email = ?");
    //     $stmt->bind_param("s", $email);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    
    //     if ($result->num_rows > 0) {
    //         $data = $result->fetch_assoc();
    //         if (password_verify($password, $data['password'])) {
    //             $_SESSION['email'] = $data['email'];
    //             $_SESSION['username'] = $data['username'];
    //             $_SESSION['level'] = $data['level'];
    
    //             if ($data['level'] == 1) {
    //                 header('location: ../admin/dashboard_admin.php');
    //                 exit();
    //             } elseif ($data['level'] == 2) {
    //                 header('location: ../public/index.php');
    //                 exit();
    //             } elseif ($data['level'] == 3) {
    //                 header('location: ../public/index.php');
    //                 exit();
    //             } else {
    //                 // Handle unknown user level
    //                 // You may want to redirect to an error page or handle it in a specific way.
    //             }
    
    //             $_SESSION['login'] = true;
    //         } else {
    //             $password_error = true;
    //         }
    //     } else {
    //         $account_not_found = true;
    //     }
    // }

?>
