<!-- The Modal -->
<div class="modal fade " id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered "> 
    <div class="modal-content ">
       <div class="modal-header bg-primary text-white border-0">
       <h5 class="modal-title">
          <i class="fa-solid fa-user-plus"></i> ADD PATIENT
       </h5>
       <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
   </div>
      <div class="modal-body">
        <form id="patientForm" method="post">
          <div class="container">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Patient Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required> 
              </div>
              <div class="col-md-6 mb-3">
                <label for="Age" class="form-label">Age</label>
                <input type="number" class="form-control" id="Age" placeholder="Enter your Age" name="age" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="bday" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" class="form-select" name="gender" required>
                  <option value="">--Select Gender--</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Enter your Address" name="address" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="Contact" class="form-label">Phone</label>
                <input type="number" class="form-control" id="Contact" placeholder="Enter your Contact" name="phone" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" class="form-select" name="status" required>
                  <option value="">--Select Status--</option>
                  <option value="Married">Married</option>
                  <option value="Single">Single</option>
                  <option value="Separated">Separated</option>
                  <option value="Divorced">Divorced</option>
                  <option value="Widowed">Widowed</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="treatment" class="form-label">Purpose</label>
                <select id="treatment" class="form-select" name="purpose" required>
                  <option value="">--Select Purpose--</option>
                  <option value="Check-Up">Check-Up</option>
                  <option value="Vaccinations">Vaccinations</option>
                  <option value="Blood Pressure Monitoring">Blood Pressure Monitoring</option>
                  <option value="Diabetes Management">Diabetes Management</option>
                  <option value="BloodChem">BloodChem</option>
                  <option value="Treatment of Minor Injuries">Treatment of Minor Injuries</option>
                  <option value="Pediatric Care">Pediatric Care</option>
                  <option value="Circumcision">Circumcision</option>
                  <option value="Laboratory Testing">Laboratory Testing</option>
                </select>
              </div>
            </div>
            <div class="float-end">
              <button type="submit" name="submit-add" class="btn btn-primary">ADD PATIENT</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</script>
<style> .my-swal-popup { height: 300px; } </style>
<?php
include ('../database/connection.php'); 

if(isset($_POST["submit-add"])) {
  $name = $_POST["name"];
  $age = $_POST["age"];
  $bday = $_POST["bday"];
  $gender = $_POST["gender"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $status = $_POST["status"];
  $purpose = $_POST["purpose"];

 
  if(empty($name) || empty($age) || empty($bday) || empty($gender) || empty($address) || empty($phone) || empty($status) || empty($purpose)) {
    ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'All fields are required!',
        showConfirmButton: true,
        heightAuto: false,
        customClass: {
          popup: 'my-swal-popup'
        }
      });
    </script>
    <?php
  } else {
    $stmt = $conn->prepare("INSERT INTO patient_tbl (Name, Age, Gender, Status, Phone, Bday, Address, Purpose) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssss", $name, $age, $gender, $status, $phone, $bday, $address, $purpose);

    if($stmt->execute()) {
      ?>
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Patient Added Successfully',
          showConfirmButton: false,
          timer: 1300,
          heightAuto: false,
          customClass: {
            popup: 'my-swal-popup'
          }
        });

        setTimeout(() => {
          window.location.href = '../admin/patient_record.php';
        }, 1300);
      </script>
      <?php
    } else {
      die("Error: " . $stmt->error);
    }

    $stmt->close();
  }

  $conn->close();
}
?>
