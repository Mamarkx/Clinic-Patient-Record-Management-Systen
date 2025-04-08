    <?php  include("includes/head.php") ?>
    <body>
    <!-- Navbar -->
    <?php  include("includes/Navbar.php") ?>
    <!--End Navbar-->

    <!-- Sidebar -->
    <?php include("includes/SideBar.php") ?>
    <!--End Sidebar-->

<?php include("includes/check_auth.php");

?>
    <?php include("../database/connection.php") ?>
    <?php
    $sql = "SELECT ID, Name, Age,Gender, Phone, Bday, Date, Purpose FROM patient_tbl";
    $result = $conn->query($sql);
    $patients = [];

    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }
    $conn->close();
    ?>

    <!-- popup -->
     <?php 
   include("components/add-patient.php");
   ?>
       <!-- Main Content -->
   <main class="content" id="content" >

    <div class="card-header card bg-white text-center rounded-2 mb-2">
        <h5 class="mb-0 p-3">LIST OF PATIENT</h5>
    </div>

    <div class="col-12 col-md-12 col-lg-12 col-sm-12">
        <div class="card shadow-sm rounded-2" style="height: 450px;">
            <div class="card-header">
                <div class="d-flex justify-content-between">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal">Add Patient</button>
                    <div class="input-group w-25 w-sm-50">
                        <input type="text" id="search-input" class="form-control w-50 border-black" placeholder="Search for patient records..." aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                            <th>Patient Name</th>
                            <th>Age</th>
                              <th>Gender</th>
                            <th>Phone</th>
                            <th>Birthday</th>
                            <th>Date</th>
                            <th>Purpose</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="patient-records">
                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <td data-label = "ID"><?php echo ($patient['ID']); ?></td>
                                <td data-label = "Patient Name" ><?php echo ($patient['Name']); ?></td>
                                <td data-label = "Age"><?php echo ($patient['Age']); ?></td>
                                <td data-label = "Gender"><?php echo ($patient['Gender']); ?></td>
                                <td data-label = "Phone"><?php echo ($patient['Phone']); ?></td>
                                <td data-label = "Birthday"><?php echo ($patient['Bday']); ?></td>
                                <td data-label = "Date"><?php echo ($patient['Date']); ?></td>
                                <td data-label = "Purpose"><?php echo ($patient['Purpose']); ?></td>
                                <td data-label="Action">
                                    <button class="btn btn-info btn-sm p-2 ViewInfo" data-id='<?php echo $patient['ID']; ?>' ><i class="fa-solid fa-eye"></i></button>
                                    <button class="btn btn-warning btn-sm p-2 EditInfo" data-id='<?php echo $patient['ID']; ?>'><i class="fa-solid fa-pen-to-square"></i></button>
                                  <button class="btn btn-danger btn-sm p-2 delete-patient" 
                                data-id="<?php echo $patient['ID']; ?>" 
                                data-name="<?php echo htmlspecialchars($patient['Name']); ?>">
                            <i class="fa-solid fa-trash"></i>
                                   </button>
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

</main>
<!--End of Main -->
<style> .my-swal-popup { height: 300px; } </style>
     <?php 
   include("components/viewModal.php");
   ?>
        <?php 
   include("components/EditModal.php");
   ?>
     <script src="Assets/javascript/script.js"></script>
<script type="text/javascript">
//view function
$(document).ready(function() {
    $('.ViewInfo').click(function() {
       let userid = $(this).data('id'); 
        
        $.ajax({
            url: 'view-patient-record.php', 
            type: 'POST',
            data: { userid: userid }, 
            
            success: function(response) {
                $('.modal-body-view').html(response);
                $('#viewPatientModal').modal('show');
            }
        });
    });
});
</script>

<script type="text/javascript">
//edit function
$(document).ready(function() {
    $('.EditInfo').click(function() {
       let userid = $(this).data('id');
        $.ajax({
            url: 'edit-patient-record.php',
            type: 'POST',
            data: { userid: userid },
            success: function(response) {
                $('.modal-body-edit').html(response);
                $('#editPatientModal').modal('show');
            }
        });
    });
    $(document).on('submit', '#patientFormedit', function(e) {
        e.preventDefault();
       let formData = $(this).serialize();
        
        $.ajax({
            url: 'edit-function.php',   
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
    $(document).on('click', '.delete-patient', function(e) {
        e.preventDefault();
        
        const patientId = $(this).data('id');
        const patientName = $(this).data('name'); 
        Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to delete ${patientName}'s record?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'delete-function.php',
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
