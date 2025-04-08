<?php include("includes/head.php"); ?>

<!-- Navbar -->
<?php include("includes/Navbar.php"); ?>
<!-- End Navbar -->

<!-- Sidebar -->
<?php include("includes/SideBar.php"); ?>
<!-- End Sidebar -->
<?php include("includes/check_auth.php");

?>
<!-- Main Content -->
   <?php 
   include("components/addAccount.php");
   ?>
  <?php include("../database/connection.php") ?>
    <?php
    $sql = "SELECT id, username, Name, password, Email, Phone,Birthday,Roles FROM users";
    $result = $conn->query($sql);
    $patients = [];

    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }
    $conn->close();
    ?>

<main class="content" id="content">
   <div class="card-header card bg-white text-center rounded-2 mb-2">
    <h5 class="mb-0 p-3">LIST OF ACCOUNTS (ADMIN ONLY )</h5>
</div>

<div class="col-12 col-md-12 col-lg-12 col-sm-12">
    <div class="card shadow-sm rounded-2" style="height: 450px;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">Add Account</button>
                <div class="input-group w-25 w-sm-50">
                    <input type="text" id="search-input" class="form-control w-50 border-black" placeholder="Search for Account..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <button type="submit" id="search-button" class="input-group-text btn btn-dark" id="basic-addon2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Roles</th>
                         <th>Action</th>
                    </tr>
                </thead>
                <tbody id="patient-records">
                     <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td data-label="ID"><?php echo ($patient['id']); ?></td>
                        <td data-label="Username"><?php echo ($patient['username']); ?></td>
                        <td data-label="Name"><?php echo ($patient['Name']); ?></td>
                        <td data-label="Email"><?php echo ($patient['Email']); ?></td>
                        <td data-label="Birthday"><?php echo ($patient['Birthday']); ?></td>
                         <td data-label="Roles"><?php echo ($patient['Roles']); ?></td>
                        <td data-label="Actions">
                            <button class="btn btn-warning btn-sm p-2 EditRoles" data-id='<?php echo $patient['id']; ?>'"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-danger btn-sm p-2 DeleteRoles" data-id='<?php echo $patient['id']; ?>' data-name="John Doe"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                          <?php endforeach; ?>
                    <!-- No records found -->
                    <tr id="no-records" style="display: none;">
                        <td colspan="9" class="text-center">No patient found</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include("components/EditRolesModal.php");


?>
</main>

<script src="Assets/javascript/script.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.EditRoles').click(function() {
        let userid = $(this).data('id');
        $.ajax({
            url: 'edit-roles.php',
            type: 'POST',
            data: { userid: userid },
            success: function(response) {
                $('.modal-body-roles').html(response);
                $('#editRolesModal').modal('show');
            }
        });
    });

    $(document).on('submit', '#rolesFormedit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        
        $.ajax({
            url: 'edit-roles-function.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.trim() === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully Updated!',
                        showConfirmButton: false,
                        timer: 1300,
                        heightAuto: false,
                        customClass: {
                            popup: 'my-swal-popup'
                        }
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Update Failed',
                        text: response
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update record: ' + error
                });
            }
        });
    });
});
</script>
<script>
//delete function
 $(document).ready(function() {
    $(document).on('click', '.DeleteRoles', function(e) {
        e.preventDefault();
        
        const patientId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to delete this Account?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'delete-roles.php',
                    type: 'POST',
                    data: {
                        id: patientId
                    },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Patient record has been deleted.',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to delete patient record.',
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'There was an error connecting to the server.',
                        });
                    }
                });
            }
        });
    });
});
</script>


</body>
</html>
