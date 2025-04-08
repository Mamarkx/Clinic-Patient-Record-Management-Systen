<?php
include("../database/connection.php");

if (isset($_POST['userid'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $sql = "SELECT * FROM users WHERE id = '$userid'";
    $result = $conn->query($sql);

    if ($row = mysqli_fetch_array($result)) {
?>
        <form id="rolesFormedit" method="post">
            <div class="container">
                <div class="row">
                    <!-- Username -->
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($row['Username']); ?>" required>
                    </div>

                    <!-- Patient Name -->
                    <div class="col-md-6 mb-3">
                        <label for="patientName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="patientName" name="name" value="<?php echo htmlspecialchars($row['Name']); ?>" >
                    </div>
                         <div class="col-md-6 mb-3">
                        <label for="patientName" class="form-label">Email</label>
                        <input type="text" class="form-control" id="patientName" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" >
                    </div>

                         <div class="col-md-6 mb-3">
                        <label for="patientName" class="form-label">Password</label>
                        <input type="text" class="form-control" id="patientName" name="pass" >
                    </div>



                    <!-- Birthday -->
                    <div class="col-md-6 mb-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="bday" value="<?php echo htmlspecialchars($row['Birthday']); ?>" >
                    </div>

                    <!-- Role -->
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" class="form-select" name="role" >
                            <option value="Admin" <?php echo ($row['Roles'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="Doctor" <?php echo ($row['Roles'] == 'Doctor') ? 'selected' : ''; ?>>Doctor</option>
                            <option value="Nurse" <?php echo ($row['Roles'] == 'Nurse') ? 'selected' : ''; ?>>Nurse</option>
                        </select>
                    </div>

                    <!-- Hidden ID Field -->
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

                    <!-- Submit Button -->
                    <div class="float-end mb-3">
                        <button type="submit" class="btn btn-primary">Update Record</button>
                    </div>
                </div>
            </div>
        </form>
<?php
    }
}
?>
