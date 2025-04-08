<?php
include("../database/connection.php");

$userid = $_POST['userid'];
$sql = "SELECT ID, Name, Age, Gender, Phone, Status, Bday, Address, Purpose FROM patient_tbl WHERE ID = '$userid'";
$result = $conn->query($sql);

if ($row = mysqli_fetch_array($result)) {
?>

<form id="patientForm" method="post">
    <div class="container">
        <div class="row">
            <!-- Patient Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Patient Name</label>
                <input type="text" class="form-control" id="name" name="name" value='<?php echo $row['Name']; ?>' readonly>
            </div>

            <!-- Age -->
            <div class="col-md-6 mb-3">
                <label for="Age" class="form-label">Age</label>
                <input type="number" class="form-control" id="Age" name="age" value='<?php echo $row['Age']; ?>' readonly>
            </div>

            <!-- Birthday -->
            <div class="col-md-6 mb-3">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="bday" value='<?php echo $row['Bday']; ?>' readonly>
            </div>

            <!-- Gender -->
            <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" id="gender" class="form-control" name="gender" value='<?php echo $row['Gender']; ?>' readonly>
            </div>

            <!-- Address -->
            <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value='<?php echo $row['Address']; ?>' readonly>
            </div>

            <!-- Phone -->
            <div class="col-md-6 mb-3">
                <label for="Contact" class="form-label">Phone</label>
                <input type="number" class="form-control" id="Contact" name="phone" value='<?php echo $row['Phone']; ?>' readonly>
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" id="status" class="form-control" name="status" value='<?php echo $row['Status']; ?>' readonly>
            </div>

            <!-- Purpose -->
            <div class="col-md-6 mb-3">
                <label for="purpose" class="form-label">Purpose</label>
                <input type="text" id="purpose" class="form-control" name="purpose" value='<?php echo $row['Purpose']; ?>' readonly>
            </div>
        </div>
   
    </div>
</form>

<?php
}
?>
