<?php
session_start();

include("../koneksi/koneksi.php");

// Check if the user is logged in
if (!isset($_SESSION['username']) || !is_array($_SESSION['username'])) {
    header('location: ../public/login.php');
    exit();
}

$user = $_SESSION['username'];
$userID = $user['id_user'];

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_general'])) {
    // Handle updating general information
    $newUsername = mysqli_real_escape_string($con, $_POST['username']);
    $newName = mysqli_real_escape_string($con, $_POST['Nama']);
    $newPhone = mysqli_real_escape_string($con, $_POST['telpon']);
    $newEmail = mysqli_real_escape_string($con, $_POST['email']);

    $updateQuery = "UPDATE user SET username = '$newUsername', Nama = '$newName', telpon = '$newPhone', email = '$newEmail' WHERE id_user = $userID";

    if (mysqli_query($con, $updateQuery)) {
        // Update session data if the database update is successful
        $_SESSION['username']['username'] = $newUsername;
        $_SESSION['username']['Nama'] = $newName;
        $_SESSION['username']['telpon'] = $newPhone;
        $_SESSION['username']['email'] = $newEmail;

        $successMessage = "Informasi umum berhasil diperbarui!";
    } else {
        $errorMessage = "Gagal memperbarui informasi umum. Silakan coba lagi.";
    }

    if (isset($_FILES['pp']) && $_FILES['pp']['error'] === 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($_FILES['pp']['type'], $allowedTypes) && $_FILES['pp']['size'] <= 800000) {
            $ppData = file_get_contents($_FILES['pp']['tmp_name']);
            $updatePPQuery = "UPDATE user SET pp = ? WHERE id_user = $userID";
            $stmt = mysqli_prepare($con, $updatePPQuery);
            mysqli_stmt_bind_param($stmt, 's', $ppData);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            $errorMessage = "Invalid file type or size. Please upload a valid image (JPG, GIF, PNG) with a max size of 800K.";
        }
    }

}

$defaultPPImage = 'https://bootdey.com/img/Content/avatar/avatar1.png';

$ppQuery = "SELECT pp FROM user WHERE id_user = $userID";
$ppResult = mysqli_query($con, $ppQuery);

if ($ppResult) {
    $ppData = mysqli_fetch_assoc($ppResult);
    
    if ($ppData['pp']) {
        $ppImage = base64_encode($ppData['pp']);
    } else {
        $ppImage = base64_encode(file_get_contents($defaultPPImage));
    }
} else {
    $ppImage = base64_encode(file_get_contents($defaultPPImage));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_password'])) {
    $currentPassword = mysqli_real_escape_string($con, $_POST['current_password']);
    $newPassword = mysqli_real_escape_string($con, $_POST['new_password']);
    $repeatPassword = mysqli_real_escape_string($con, $_POST['repeat_password']);

    $checkPasswordQuery = "SELECT password FROM user WHERE id_user = $userID";
    $result = mysqli_query($con, $checkPasswordQuery);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($currentPassword, $row['password'])) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updatePasswordQuery = "UPDATE user SET password = '$hashedPassword' WHERE id_user = $userID";

            if (mysqli_query($con, $updatePasswordQuery)) {
                $successMessage = "Password updated successfully!";
            } else {
                $errorMessage = "Failed to update password. Please try again.";
            }
        } else {
            $errorMessage = "Incorrect current password.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>account settings - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	body{
    background: #f5f5f5;
    margin-top:20px;
}

.ui-w-80 {
    width: 80px !important;
    height: auto;
}

.btn-default {
    border-color: rgba(24,28,33,0.1);
    background: rgba(0,0,0,0);
    color: #4E5155;
}

label.btn {
    margin-bottom: 0;
}

.btn-outline-primary {
    border-color: #26B4FF;
    background: transparent;
    color: #26B4FF;
}

.btn {
    cursor: pointer;
}

.text-light {
    color: #babbbc !important;
}

.btn-facebook {
    border-color: rgba(0,0,0,0);
    background: #3B5998;
    color: #fff;
}

.btn-instagram {
    border-color: rgba(0,0,0,0);
    background: #000;
    color: #fff;
}

.card {
    background-clip: padding-box;
    box-shadow: 0 1px 4px rgba(24,28,33,0.012);
}

.row-bordered {
    overflow: hidden;
}

.account-settings-fileinput {
    position: absolute;
    visibility: hidden;
    width: 1px;
    height: 1px;
    opacity: 0;
}
.account-settings-links .list-group-item.active {
    font-weight: bold !important;
}
html:not(.dark-style) .account-settings-links .list-group-item.active {
    background: transparent !important;
}
.account-settings-multiselect ~ .select2-container {
    width: 100% !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.material-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.material-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.dark-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(255, 255, 255, 0.03) !important;
}
.dark-style .account-settings-links .list-group-item.active {
    color: #fff !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4E5155 !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24,28,33,0.03) !important;
}



    </style>
</head>
<body>
<div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>
        <div class="text-right my-3">
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
        <?php if ($successMessage): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">Umum</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Ubah password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                        <form action="akun.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body media align-items-center">
                                <img src="data:image/jpeg;base64,<?php echo $ppImage; ?>" alt="Profile Picture" class="d-block ui-w-80">
                                <div class="media-body ml-4">
                                    <label class="btn btn-outline-primary">
                                        Upload new photo
                                        <input type="file" class="account-settings-fileinput" name="pp">
                                    </label> &nbsp;
                                    <button type="button" class="btn btn-default md-btn-flat" onclick="resetProfilePicture()">Reset</button>
                                    <div class="text-light small mt-1">Allowed JPG, GIF, or PNG. Max size of 800K</div>
                                </div>
                            </div>
                            <script>
                                function resetProfilePicture() {
                                    var fileInput = document.querySelector('.account-settings-fileinput');
                                    fileInput.value = '';
                                    var profilePicture = document.querySelector('.ui-w-80');
                                    profilePicture.src = 'data:image/jpeg;base64,<?php echo $ppImage; ?>';
                                }
                            </script>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control mb-1" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="Nama" value="<?php echo htmlspecialchars($user['Nama']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" name="telpon" value="<?php echo htmlspecialchars($user['telpon']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control mb-1" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                                    </div>
                                    <div class="text-right my-3">
                                        <button type="submit" name="save_general" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <form action="akun.php" method="POST">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Current password</label>
                                        <input type="password" class="form-control" name="current_password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" class="form-control" name="new_password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Repeat new password</label>
                                        <input type="password" class="form-control" name="repeat_password">
                                    </div>
                                    <div class="text-right my-3">
                                        <button type="submit" name="save_password" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        // Your additional scripts go here
    </script>
</body>
</html>