<!-- The Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title">
                    <i class="fa-solid fa-user-plus"></i> ADD ACCOUNT
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="patientForm" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fname" class="form-label">Name</label>
                                <input type="text" class="form-control" id="fname" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="Email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="bday" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="roles" class="form-label">Roles</label>
                                <select id="roles" class="form-select" name="roles" required>
                                    <option value="">--Select Roles--</option>
                                    <option value="Nurse">Nurse</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="float-end">
                            <button type="submit" name="add-account" class="btn btn-primary">ADD ACCOUNT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>.my-swal-popup { height: 300px; }</style>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["add-account"])) {
    include('../database/connection.php');

    $user = trim($_POST["username"]);
    $name = trim($_POST["name"]);
    $Email = filter_var(trim($_POST["Email"]), FILTER_VALIDATE_EMAIL);
    $bday = trim($_POST["bday"]);
    $roles = trim($_POST["roles"]);
    $phone = trim($_POST["phone"]);
    $pass = trim($_POST["password"]);


    if (empty($user) || empty($name) || empty($Email) || empty($bday) || empty($roles) || empty($phone) || empty($pass)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'All fields are required!',
                    showConfirmButton: true,
                    heightAuto: false,
                    customClass: {
                        popup: 'my-swal-popup'
                    }
                });
              </script>";
    } elseif (!$Email) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid email address!',
                    showConfirmButton: true,
                    heightAuto: false,
                    customClass: {
                        popup: 'my-swal-popup'
                    }
                });
              </script>";
    } else {
        // Check if username already exists
        $check_user_query = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $check_user_query->bind_param("s", $user);
        $check_user_query->execute();
        $check_user_query->store_result();

        if ($check_user_query->num_rows > 0) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Username already exists!',
                        showConfirmButton: true,
                        heightAuto: false,
                        customClass: {
                            popup: 'my-swal-popup'
                        }
                    });
                  </script>";
        } else {
            // Hash password
            $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

            // Insert into database
            $stmt = $conn->prepare("INSERT INTO users (username, Name, Email, Birthday, roles, phone, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $user, $name, $Email, $bday, $roles, $phone, $hashed_pass);

            if ($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Account Added Successfully',
                            showConfirmButton: false,
                            timer: 1300,
                            heightAuto: false,
                            customClass: {
                                popup: 'my-swal-popup'
                            }
                        });

                        setTimeout(() => {
                              window.location.href = '../admin/role-management.php';
                        }, 1300);
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error: " . $stmt->error . "',
                            showConfirmButton: true,
                            heightAuto: false,
                            customClass: {
                                popup: 'my-swal-popup'
                            }
                        });
                      </script>";
            }

            $stmt->close();
        }

        $check_user_query->close();
    }

    $conn->close();
}
?> 
