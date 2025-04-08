<?php  include("includes/head.php") ?>
<body>
<!-- Navbar -->
<?php  include("includes/Navbar.php") ?>
<!--End Navbar-->

<!-- Sidebar -->
<?php include("includes/SideBar.php"); ?>
<!-- Sidebar -->

<?php include("includes/check_auth.php");?>

<?php
include("../database/connection.php"); 
$user_role = $_SESSION['user_role'];

$count = "SELECT COUNT(*) as count FROM patient_tbl";
            $query= mysqli_query($conn, $count);
                while ($total = mysqli_fetch_assoc($query)) {
                    $output = $total['count'];
                }
 $appt = "SELECT COUNT(*) as count FROM appointment_tbl";
   $Aptquery= mysqli_query($conn, $appt);
                while ($apttotal = mysqli_fetch_assoc($Aptquery)) {
                    $aptCount = $apttotal['count'];
                }

$sql = "SELECT  Name, Age,  Phone,  Date, Purpose FROM patient_tbl  ORDER BY Date DESC LIMIT 5";
$result = $conn->query($sql);

$patients = [];
while ($row = $result->fetch_assoc()) {
    $patients[] = $row;
}   
$apnt = "SELECT Patient_name, Date, Time, Doctor FROM appointment_tbl ORDER BY Date DESC LIMIT 2";
$apntresult = $conn->query($apnt);
$appointments = [];

while ($apntrows = $apntresult->fetch_assoc()) {
    $appointments[] = $apntrows;
}



$conn->close();

            
?>

    <!-- Main Content -->
    <main class="content" id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3" >
                    <div class="card shadow-sm border-1" >
                        <div class="card-body">                       
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="card-text">
                            <p class="card-title h6 text-secondary">Recent Patients
                                <h5 class="display-5 fw-bold text-dark mb-0"><?php echo $output;?></h5>
                            </div>
                                <i class="bg-danger bg-opacity-25 fa-solid fa-clock-rotate-left fs-2 text-danger p-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                    <div class="card shadow-sm border-1">
                        <div class="card-body">                          
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="card-text">
                             <p class="card-title h6 text-secondary">Appointments</p>
                                <h5 class="display-5 fw-bold text-dark mb-0"><?php echo $aptCount;?></h5>
                            </div>                
                                <i class="bg-primary bg-opacity-25 fa-regular fa-calendar-check fs-2  text-primary p-3"></i>
                            </div>
                        </div>
                    </div>
                </div>       
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                    <div class="card shadow-sm border-1">
                        <div class="card-body">                          
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="card-text">
                            <p class="card-title h6 text-secondary">Pending</p>
                            <h5 class="display-5 fw-bold text-dark mb-0">9</h5>
                            </div>                              
                                <i class="bg-warning bg-opacity-25 fa-regular fa-clock fs-2 text-warning p-3"></i>
                            </div>
                        </div>
                    </div>
                </div>     
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                    <div class="card shadow-sm border-1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="card-text">
                            <p class="card-title h6 text-secondary">Patient Admitted</p>
                            <h5 class="display-5 fw-bold text-dark mb-0"><?php echo $output;?></h5>
                            </div>            
                             <i class="bg-success bg-opacity-25 fa-solid fa-users fs-2 text-success p-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
 <div class="row g-3 mt-3"> 
<div class="col-12 col-md-12 col-lg-8 col-sm-12">         
    <div class="card shadow-sm rounded-2" style="height: 350px;">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Recent Patients</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>Date-Time</th>
                        <th>Purpose</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td data-label="Patient Name"><?php echo ($patient['Name']); ?></td>
                        <td data-label="Age"><?php echo ($patient['Age']); ?></td>
                        <td data-label="Phone"><?php echo ($patient['Phone']); ?></td>
                        <td data-label="Date-Time"><?php echo ($patient['Date']); ?></td>
                        <td data-label="Check-up"><?php echo ($patient['Purpose']); ?></td>
                    </tr>
                      <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
        <!--upcoming Appointments-->
           <div class="col-12 col-md-12 col-lg-4 col-sm-12">
    <div class="card shadow-sm" style="border-radius: 10px; overflow: hidden; min-height: 290px; height: 350px;">
        <div class="card-header text-white text-center" 
             style="background: linear-gradient(45deg, #007bff, #19d3f8); padding: 1rem;">
            <h5 class="card-title text-white ">Upcoming Appointments</h5>
        </div>
        <div class="card-body" style="max-height: 290px;">
        <?php foreach ($appointments as $appointment): ?>
            <div class="appointment mb-4 d-flex justify-content-between align-items-center border shadow-sm p-3">
                <div>
                    <span class="appointment-details">
                        <i class="fas fa-calendar-alt mb-2" ></i>
                        <strong>Date:</strong> <?php echo ($appointment['Date']); ?><br>
                        <i class="fa-solid fa-clock mb-2" ></i>
                      <strong>Time:</strong> <?php echo date($appointment['Time']); ?><br>
                        <i class="fa-solid fa-user-doctor mb-2" ></i>
                        <strong> Doctor:</strong> <?php echo ($appointment['Doctor']); ?>
                    </span>
                </div>
                <i class="fas fa-eye" style=" cursor: pointer;" title="View Details"></i>
            </div>
              <?php endforeach; ?>   
        </div>
    </div>
    </div>                  
</div>
 </div>
    </main>
    <!--End Main Content-->


      <script src="Assets/javascript/script.js"></script>
</body>
</html>
