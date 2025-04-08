
    <?php  include("includes/head.php") ?>
    <body>
    <!-- Navbar -->
    <?php  include("includes/Navbar.php") ?>
    <!--End Navbar-->

    <!-- Sidebar -->
    <?php include("includes/SideBar.php") ?>
    <!--End Sidebar-->

    <?php include("../database/connection.php") ?>
    <?php


$query = "SELECT ID, Patient_name, Doctor, Date, Time FROM appointment_tbl";
$result = mysqli_query($conn, $query);

$appointments = array();
while($row = mysqli_fetch_assoc($result)) {
    $date = date('Y-m-d', strtotime($row['Date']));
    if(!isset($appointments[$date])) {
        $appointments[$date] = array();
    }
    $appointments[$date][] = $row;
}
?>
<!-- Main Content -->
<main class="content" id="content">
    <div class="calendar-wrapper">
        <div class="card shadow-sm  border-1 rounded-lg " style="height:550px">
            <div class="card-body d-flex flex-column p-4">
                <h2 class="text-center mb-2 fw-bold text-primary">
                    <i class="fas fa-calendar-alt me-1"></i> Appointments Calendar
                </h2>
                
                <div class="row mb-4 align-items-center">
                    <div class="col-4 text-start">
                        <button class="btn btn-outline-primary rounded-pill px-3 hover-scale" id="prevMonth">
                            <i class="fas fa-chevron-left me-2"></i>Previous
                        </button>
                    </div>
                    <div class="col-4 text-center">
                        <h4 id="currentMonth" class="mb-0 fw-bold text-dark">January 2024</h4>
                    </div>
                    <div class="col-4 text-end">
                        <button class="btn btn-outline-primary rounded-pill px-4 hover-scale" id="nextMonth">
                            Next<i class="fas fa-chevron-right ms-2"></i>
                        </button>
                    </div>
                </div>


            <div class="table-responsive">
    <table class="table table-bordered  h-100" >
        <thead>
            <tr class="bg-primary text-white">
                <th class="text-center py-2">Sunday</th>
                <th class="text-center py-2">Monday</th>
                <th class="text-center py-2">Tuesday</th>
                <th class="text-center py-2">Wednesday</th>
                <th class="text-center py-2">Thursday</th>
                <th class="text-center py-2">Friday</th>
                <th class="text-center py-2">Saturday</th>
            </tr>
        </thead>
        <tbody id="calendarBody"></tbody>
    </table>
</div>



            </div>
        </div>
    </div>

    <!-- Appointment Details Modal -->
    <div class="modal fade" id="appointmentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title">
                        <i class="fas fa-calendar-check me-2"></i>Appointment Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="fw-bold text-primary mb-2">Patient</label>
                        <p id="modalPatient" class="mb-3 p-2 bg-light rounded border"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-primary mb-2">Doctor</label>
                        <p id="modalDoctor" class="mb-3 p-2 bg-light rounded border"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-primary mb-2">Date</label>
                        <p id="modalDate" class="mb-3 p-2 bg-light rounded border"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-primary mb-2">Time</label>
                        <p id="modalTime" class="mb-3 p-2 bg-light rounded border"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
     <script src="Assets/javascript/script.js"></script>
    <script>
     $(document).ready(function() {
    const appointments = <?php echo json_encode($appointments); ?>;
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    const appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));

    function formatTimeWithAMPM(time) {
        let hour = parseInt(time.split(':')[0]);  
        let minute = time.split(':')[1]; 
        let ampm = hour >= 12 ? 'PM' : 'AM';  
        hour = hour % 12;  
        hour = hour ? hour : 12;  
        return `${hour}:${minute} ${ampm}`; 
    }

    function showAppointmentDetails(appointment) {
        $('#modalPatient').text(appointment.Patient_name);
        $('#modalDoctor').text(appointment.Doctor);
        $('#modalDate').text(appointment.Date);
        $('#modalTime').text(appointment.Time);
        appointmentModal.show();
    }

    function generateCalendar(month, year) {
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const startingDay = firstDay.getDay();
        const monthLength = lastDay.getDate();

        $('#currentMonth').text(new Date(year, month).toLocaleString('default', { month: 'long', year: 'numeric' }));

        let calendarBody = $('#calendarBody');
        calendarBody.empty();

        let date = 1;
        const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        for (let i = 0; i < 6; i++) {
            let row = $('<tr>');

            for (let j = 0; j < 7; j++) {
                let cell = $('<td>').addClass('calendar-day');
                let dayLabel = daysOfWeek[j];
                cell.attr('data-label', dayLabel);

                if (i === 0 && j < startingDay) {
                    cell.append('');
                } else if (date > monthLength) {
                    break;
                } else {
                    cell.append(date);

                    let dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                    if (appointments[dateStr]) {
                        appointments[dateStr].forEach(appointment => {
                            let formattedTime = formatTimeWithAMPM(appointment.Time); 
                            let appointmentDiv = $('<div>').addClass('appointment-item').text(`${formattedTime} - ${appointment.Patient_name}`);
                            appointmentDiv.on('click', () => showAppointmentDetails(appointment));
                            cell.append(appointmentDiv);
                        });
                    }
                    date++;
                }
                row.append(cell);
            }
            calendarBody.append(row);
        }
    }

    $('#prevMonth').on('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentMonth, currentYear);
    });

    $('#nextMonth').on('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear);
    });

    generateCalendar(currentMonth, currentYear);
});

    </script>
</body>
</html>
