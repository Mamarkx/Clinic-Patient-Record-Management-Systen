<?php
// edit-patient-record.php
include("../database/connection.php");

if (isset($_POST['userid'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $sql = "SELECT * FROM patient_tbl WHERE ID = '$userid'";
    $result = $conn->query($sql);

    if ($row = mysqli_fetch_array($result)) {
?>
        <form id="patientFormedit" method="post">
            <div class="container">
                <div class="row">
                    <!-- Patient Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Patient Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['Name']); ?>" required>
                    </div>

                    <!-- Age -->
                    <div class="col-md-6 mb-3">
                        <label for="Age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="Age" name="age" value="<?php echo htmlspecialchars($row['Age']); ?>" required>
                    </div>

                    <!-- Birthday -->
                    <div class="col-md-6 mb-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="bday" value="<?php echo htmlspecialchars($row['Bday']); ?>" required>
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" class="form-select" name="gender" required>
                            <option value="Male" <?php echo ($row['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($row['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($row['Address']); ?>" required>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6 mb-3">
                        <label for="Contact" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="Contact" name="phone" value="<?php echo htmlspecialchars($row['Phone']); ?>" required>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" class="form-select" name="status" required>
                            <option value="Married" <?php echo ($row['Status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                            <option value="Single" <?php echo ($row['Status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                            <option value="Separated" <?php echo ($row['Status'] == 'Separated') ? 'selected' : ''; ?>>Separated</option>
                            <option value="Divorced" <?php echo ($row['Status'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                            <option value="Widowed" <?php echo ($row['Status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                        </select>
                    </div>

                    <!-- Purpose -->
                    <div class="col-md-6 mb-3">
                        <label for="purpose" class="form-label">Purpose</label>
                        <select id="purpose" class="form-select" name="purpose" required>
                            <option value="Check-Up" <?php echo ($row['Purpose'] == 'Check-Up') ? 'selected' : ''; ?>>Check-Up</option>
                            <option value="Vaccinations" <?php echo ($row['Purpose'] == 'Vaccinations') ? 'selected' : ''; ?>>Vaccinations</option>
                            <option value="Blood Pressure Monitoring" <?php echo ($row['Purpose'] == 'Blood Pressure Monitoring') ? 'selected' : ''; ?>>Blood Pressure Monitoring</option>
                            <option value="Diabetes Management" <?php echo ($row['Purpose'] == 'Diabetes Management') ? 'selected' : ''; ?>>Diabetes Management</option>
                            <option value="BloodChem" <?php echo ($row['Purpose'] == 'BloodChem') ? 'selected' : ''; ?>>BloodChem</option>
                            <option value="Treatment of Minor Injuries" <?php echo ($row['Purpose'] == 'Treatment of Minor Injuries') ? 'selected' : ''; ?>>Treatment of Minor Injuries</option>
                            <option value="Pediatric Care" <?php echo ($row['Purpose'] == 'Pediatric Care') ? 'selected' : ''; ?>>Pediatric Care</option>
                            <option value="Circumcision" <?php echo ($row['Purpose'] == 'Circumcision') ? 'selected' : ''; ?>>Circumcision</option>
                            <option value="Laboratory Testing" <?php echo ($row['Purpose'] == 'Laboratory Testing') ? 'selected' : ''; ?>>Laboratory Testing</option>
                        </select>
                    </div>

                    <!-- Hidden ID Field -->
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['ID']); ?>">

                    <!-- Submit Button -->
                    <div class="float-end mb-3">
                        <button type="submit" class="btn btn-primary float-end">Edit Patient</button>
                    </div>
                </div>
            </div>
        </form>
<?php
    }
}
?>