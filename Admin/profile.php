<?php 
include("includes/head.php"); 
include("includes/Navbar.php"); 
include("includes/SideBar.php"); 
include("includes/check_auth.php"); 

// Main Content
include("../database/connection.php");

if (isset($_SESSION['user_role']) && isset($_SESSION['user_id'])) {
    $roleToFetch = $_SESSION['user_role'];
    $userID = $_SESSION['user_id'];

    $sql = "SELECT * FROM users WHERE Roles = ? AND id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $roleToFetch, $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $Name = $row['Name'];
        $Email = $row['Email'];
        $Phone = $row['Phone'];
        $Bday = $row['Birthday'];
        $Roles = $row['Roles'];
        $Images = $row['Images'];
    } else {
        echo "User not found.";
        exit();
    }

    $stmt->close();
} else {
    echo "User session not complete. Please log in again.";
    exit();
}
$imagePath = isset($Images) && !empty($Images) ? 'Assets/Images/' . $Images : 'Assets/Images/user.png';
?>

<main class="content" id="content">
    <div class="row g-0 mt-3">
        <!-- Left Panel -->
        <div class="col-lg-4 col-md-6">
            <div class="card-body card text-center h-100">
                <form method="post" enctype="multipart/form-data">
                    <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="User Image"  class="rounded-circle img-fluid mx-auto my-4" style="width: 150px;" id="profilePreviewImage">
                    <h5 class=""><?php echo htmlspecialchars($Name); ?></h5>
                    <p class="text-muted mb-1"><?php echo htmlspecialchars(strtoupper($Roles)); ?></p>
                    <div class="input-group mt-3">
                        <input type="file" id="profile" class="form-control border" name="image" style="display: none;" accept="image/*">
                        <button type="button" class="btn btn-primary mx-auto rounded" id="changeProfileButton">Change Profile Picture</button>
                    </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-8 col-md-6">
            <div class="card-body card p-4">
                <div class="card-title mb-3 text-center p-1 border-bottom border-black mx-4">
                    <h4>Profile Settings</h4>
                </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">Name</label>
                            <input type="text" id="firstName" class="form-control bg-white" name="name" placeholder="Enter First Name" value="<?php echo htmlspecialchars($Name); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="pass"  placeholder="Enter New Password (optional)">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo htmlspecialchars($Email); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" id="phone" class="form-control" name="phone" placeholder="Enter Phone Number" value="<?php echo htmlspecialchars($Phone); ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="position" class="form-label">Role</label>
                            <input type="text" id="position" class="form-control bg-white" readonly value="<?php echo htmlspecialchars($Roles); ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" id="birthday" class="form-control" name="bday" value="<?php echo htmlspecialchars($Bday); ?>">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success me-2" name="submit" type="submit">Update</button>
                        <button class="btn btn-dark" type="button" onclick="window.location.href='profile.php'">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    $('#changeProfileButton').on('click', function() {
        $('#profile').click();
    });

    $('#profile').on('change', function() {
        const file = this.files[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) { // 5MB limit
                alert('File size must be less than 5MB');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                $('#profilePreviewImage').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
            $('#changeProfileButton').text(file.name);
        } else {
            $('#changeProfileButton').text('Change Profile Picture');
        }
    });
});
</script>

<?php

if (isset($_POST["submit"])) {
    include("../database/connection.php"); 

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $bday = mysqli_real_escape_string($conn, $_POST["bday"]);
    $pass = mysqli_real_escape_string($conn, $_POST["pass"]);

    $hashedPassword = !empty($pass) ? password_hash($pass, PASSWORD_DEFAULT) : null;


    $updateFields = "Name=?, Email=?, Phone=?, Birthday=?";
    $paramTypes = "ssss";
    $paramValues = [$name, $email, $phone, $bday];


    if ($hashedPassword) {
        $updateFields .= ", password=?";
        $paramTypes .= "s";
        $paramValues[] = $hashedPassword;
    }

 
    if (!empty($_FILES['image']['name'])) {
        $file = $_FILES['image']['name'];
        $targetDir = "Assets/Images/";
        $targetFile = $targetDir . basename($file);

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }

        if ($_FILES["image"]["size"] > 5000000) { // 5MB
            echo "File is too large. Maximum size is 5MB.";
            exit();
        }

        if (getimagesize($_FILES["image"]["tmp_name"])) {
            $updateFields .= ", Images=?";
            $paramTypes .= "s";
            $paramValues[] = $file;
        } else {
            echo "File is not a valid image.";
            exit();
        }
    }

    $paramTypes .= "si"; 
    $paramValues[] = $roleToFetch;
    $paramValues[] = $userID;

    $sql = "UPDATE users SET $updateFields WHERE Roles=? AND id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($paramTypes, ...$paramValues);
    
    if ($stmt->execute()) {
        // Move uploaded file
        if (!empty($_FILES['image']['name'])) {
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        }
        ?>
        <script>
            Swal.fire({
                title: 'Successfully Updated!',
                icon: 'success',
                confirmButtonText: 'Okay',
                customClass: {
                    confirmButton: 'btn-okay'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'profile.php';
                }
            });
        </script>
        <?php
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<script src="Assets/javascript/script.js"></script>
</body>
</html>
