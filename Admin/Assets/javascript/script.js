  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const patientRecords = document.getElementById('patient-records');
    const noRecords = document.getElementById('no-records');

  
    function searchRecords() {
        const value = searchInput.value.toLowerCase();  
        let found = false;  

      
        for (let i = 0; i < patientRecords.rows.length; i++) {
            const row = patientRecords.rows[i];
            if (row.textContent.toLowerCase().includes(value)) {
                row.style.display = '';  
                found = true;
            } else {
                row.style.display = 'none';  
            }
        }

        noRecords.style.display = found ? 'none' : '';  
    }

   
    searchInput.addEventListener('keyup', function(event) {
        searchRecords();  
        if (event.key === 'Enter') {
            searchRecords();  
        }
    });
});
 
 
 
 
 
 
 
 
 
 
 
 const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-sidebar');
        const closeBtn = document.getElementById('close-btn');
        const content = document.getElementById('content');
        const nav = document.getElementById('nav');
 
        // show sidebar
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            content.classList.toggle('shifted');
        });

        // Close Sidebar
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
            content.classList.remove('shifted');
        });

//  let user = document.getElementById('navUser');
//    let profilesBar = document.getElementById('profilesBar');
  let notif = document.getElementById('navNotif');
  let notifBar = document.getElementById('notifBar');

  // // Toggle Profile Bar
  // user.addEventListener('click', function () {
  //   profilesBar.classList.toggle('show');
  //   if (profilesBar.classList.contains('show')) {
  //     notifBar.classList.remove('show'); 
  //   }
  // });

  // Toggle Notification Bar
  notif.addEventListener('click', function () {
    notifBar.classList.toggle('show');
   
  });





let popup = document.getElementById("popup-add");
let addPatient = document.getElementById("add-patient");


addPatient.addEventListener('click', function() {
    popup.classList.toggle("d-none");
    popup.classList.toggle("d-block");
});

