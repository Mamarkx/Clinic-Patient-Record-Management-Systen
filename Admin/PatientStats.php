<?php include("includes/head.php"); ?>

    <!-- Navbar -->
    <?php include("includes/Navbar.php"); ?>
    <!--End Navbar-->

    <!-- Sidebar -->
    <?php include("includes/SideBar.php"); ?>
    <!--End Sidebar-->

<?php include("includes/check_auth.php");

?>
   <?php 
include("../database/connection.php"); 


$sqlAge = "SELECT 
    CASE 
        WHEN Age BETWEEN 0 AND 18 THEN '0-18'
        WHEN Age BETWEEN 19 AND 35 THEN '19-35'
        WHEN Age BETWEEN 36 AND 60 THEN '36-60'
        ELSE '61+'
    END as age_group, COUNT(*) as count
FROM patient_tbl
GROUP BY age_group";
$resultAge = $conn->query($sqlAge);

$ageGroups = [];
$ageCounts = [];
while ($row = $resultAge->fetch_assoc()) {
    $ageGroups[] = $row['age_group'];
    $ageCounts[] = $row['count'];
}


$sqlGender = "SELECT Gender, COUNT(*) as count FROM patient_tbl GROUP BY Gender";
$resultGender = $conn->query($sqlGender);

$genders = [];
$genderCounts = [];
while ($row = $resultGender->fetch_assoc()) {
    $genders[] = ($row['Gender']); 
    $genderCounts[] = $row['count'];
}


$conn->close();
?>
<style>
   

        .dashboard-card {
            background: white;
            border-radius: 12px;
            border: none;
            transition: transform 0.2s;
        }

        .dashboard-card:hover {
            transform: translateY(-2px);
        }
        .chart-container {
            height: 360px;
            margin-top: 1rem;
        }
        
        
    </style>

    <!-- Main Content -->
    <main class="content" id="content">
        <!-- Header Section -->
        <div class="row mb-2">
            <div class="col-12">
                <h4 class=" text-gray-800 card p-3 text-center">Patient Statistics</h4>
            </div>
        </div>
        <!-- Charts Row -->
        <div class="row g-3 ">
            <!-- Patient Trend Chart -->
            <div class="col-md-8">
                <div class="dashboard-card p-4 border">
                    <h5 class="card-title mb-3">Age Distribution</h5>
                    <div class="chart-container">
                        <canvas id="ageChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gender Distribution -->
            <div class="col-md-4">
                <div class="dashboard-card p-4 border">
                    <h5 class="card-title mb-3">Gender Distribution</h5>
                    <div class="chart-container">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Age Distribution -->
           
        </div>

    </main>
    
      <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
    <script src="Assets/javascript/chart.js"></script>
    <script>
// Get data from PHP
const ageGroups = <?php echo json_encode($ageGroups); ?>;
const ageCounts = <?php echo json_encode($ageCounts); ?>;
const genders = <?php echo json_encode($genders); ?>;
const genderCounts = <?php echo json_encode($genderCounts); ?>;

// Gender Distribution Chart
const genderCtx = document.getElementById('genderChart').getContext('2d');
new Chart(genderCtx, {
    type: 'doughnut',
    data: {
        labels: genders,
        datasets: [{
            data: genderCounts,
            backgroundColor: [
                '#FFC0CB',
                '#0000FF',
                '#10B981'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        },
        cutout: '70%'
    }
});

// Age Distribution Chart
const ageCtx = document.getElementById('ageChart').getContext('2d');
new Chart(ageCtx, {
    type: 'bar',
    data: {
        labels: ageGroups,
        datasets: [{
            label: 'Patients',
            data: ageCounts,
            backgroundColor: '#4361ee',
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    drawBorder: false
                },
                ticks: {
                    precision: 0
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
    </script>
    <script src="Assets/javascript/script.js"></script>
</body>
</html>
