<?php
session_start();
include("../database/connection.php");
 include("includes/check_auth.php");





$roleToFetch = $_SESSION['user_role'];

$sql = "SELECT * FROM users WHERE Roles = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $roleToFetch);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $Images = $row['Images'];
     $name = $row['Name'];
}

$stmt->close();
$conn->close();
$imagePath = isset($Images) && !empty($Images) ? 'Assets/Images/' . $Images : 'Assets/Images/user.png';
?>

<aside class="sidebar" id="sidebar">
    <i class="fa-solid fa-xmark close-btn" id="close-btn"></i>
    <div class="sidebar-header">
        <br>
    </div>
    <div class="user-profile mb-4">
        <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="user profile" width="120" height="120" class="rounded-circle  mx-auto d-block" style="border: 2px solid white;">
   <h5 class="text-center mt-1"><?php echo $name ?></h5>
    </div>
            
    <hr class="mx-3">
    <ul class="list-unstyled">
        <li>
            <a href="dashboard.php" class="block p-3 text-lg">
                <i class="fa-brands fa-microsoft me-3"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="patient_record.php" class="block p-3 text-lg">
                <i class="fa-solid fa-folder-open me-3"></i>
                Patient Record
            </a>
        </li>
        <li>
            <a href="appointment.php" class="block p-3 text-lg">
                <i class="fa-solid fa-calendar-check me-3"></i>
                Appointments
            </a>
        </li>
        <li>    
            <a class="sub-btn block p-3 text-lg"><i class="fa-solid fa-chart-simple me-3"></i> Reports and Analytics <i class="fa-solid fa-caret-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="PatientStats.php" class="sub-item">Patient Statistics</a>
                <a href="appointmentTrend.php" class="sub-item">Appointment Trends</a>
            </div>
        </li>
        <li>
            <a class="sub-btn block p-3 text-lg"><i class="fa-solid fa-gear me-3"></i> Settings <i class="fa-solid fa-caret-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="profile.php" class="sub-item">Profile Settings</a>
                <?php if ($_SESSION['user_role'] == 'Admin'): ?>
                    <a href="role-management.php" id="roleManagementLink" class="sub-item">Role Management</a>
                <?php endif; ?>
            </div>
        </li>
    </ul>
</aside>

<style> .my-swal-popup { height: 380px; } </style>
<script>
    const subButtons = document.querySelectorAll(".sub-btn");

    subButtons.forEach(button => {
        button.onclick = function () {
            const subMenu = this.nextElementSibling;
            const dropdownIcon = this.querySelector(".dropdown");

            if (subMenu) {
                subMenu.style.display = subMenu.style.display === "block" ? "none" : "block";
            }

            if (dropdownIcon) {
                dropdownIcon.classList.toggle("rotate");
            }
        };
    });

    const isAdmin = <?php echo ($_SESSION['user_role'] === 'Admin' ? 'true' : 'false'); ?>;

    const roleManagementLink = document.getElementById("roleManagementLink");
    if (roleManagementLink) {
        roleManagementLink.addEventListener("click", function (event) {
            if (!isAdmin) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Prohibited',
                    html: '<p>You do not have permission.<br>Only Admin Has Access</p>',
                    showConfirmButton: true,
                    heightAuto: false,
                    customClass: { popup: 'my-swal-popup' }
                });
            }
        });
    }
</script>
