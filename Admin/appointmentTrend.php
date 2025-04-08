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



$sqlMonthly = "SELECT MONTH(Date) as month, COUNT(*) as count FROM appointment_tbl WHERE YEAR(Date) = YEAR(CURRENT_DATE) GROUP BY MONTH(Date) ORDER BY month ASC"; 
$resultMonthly = $conn->query($sqlMonthly); 

 
$monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']; 
$monthlyData = array_fill(0, 12, 0); 

while ($row = $resultMonthly->fetch_assoc()) {
    $monthIndex = $row['month'] - 1; 
    $monthlyData[$monthIndex] = (int)$row['count'];
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
            height: 370px;
            margin-top: 1rem;
        }
        
        
    </style>

    <!-- Main Content -->
    <main class="content" id="content">
        <!-- Header Section -->
        <div class="row mb-2">
            <div class="col-12">
               <h4 class="card-title mb-3 text-gray-800 card p-3 text-center">Appointment Growth Trends</h4>
            </div>
        </div>
        <!-- Charts Row -->
        <div class="row g-3">
            <!-- Patient Trend Chart -->
              <div class="col-md-12">
                <div class="dashboard-card p-4 border-1 border">
                   
                    <div class="chart-container">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>

      

    
        </div>

    </main>
    <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
     <script src="Assets/javascript/chart.js"></script>
       <script src="Assets/javascript/script.js"></script>
    <script>

const monthLabels = <?php echo json_encode($monthLabels); ?>;
const monthlyData = <?php echo json_encode($monthlyData); ?>;

// Trend Chart
const trendCtx = document.getElementById('trendChart').getContext('2d');
new Chart(trendCtx, {
    type: 'line',
    data: {
        labels: monthLabels,
        datasets: [{
            label: 'Patients per Month',
            data: monthlyData,
            borderColor: '#4361ee',
            tension: 0.4,
            fill: true,
            backgroundColor: 'rgba(67, 97, 238, 0.1)'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return `Appointments: ${context.raw}`;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: true,
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
  
</body>
</html>
