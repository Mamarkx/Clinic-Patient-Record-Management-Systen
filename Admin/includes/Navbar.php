 <nav id="nav" class="navbar navbar-light bg-light  px-3 d-flex align-items-center border-bottom">
    <div class="d-flex align-items-center">
        <span id="toggle-sidebar" class="me-2"><i id="toggleIcon" class="fa-solid fa-bars"></i></span>
        <a href="./dashboard.php"><img src="./Assets/Images/logo-clinic.png" width="60" height="50" class="me-2 "></a>
        <h4 class="title-text fw-bold mt-2"><span>CareTrack</span> System</h4>
    </div>
    <!-- <form class="d-flex flex-grow-1"> 
        <div class="search-input">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input class="form-control me-2 ms-2 w-50" type="search" placeholder="Search" aria-label="Search">
        </div> -->
    </form>
    <div class="d-flex align-items-center">
    
        <span id="navNotif"><i class="fa-solid fa-bell"></i></span>
        
     <span id="navLogout" class="cursor-pointer ms-2"><i class="fa-solid fa-right-from-bracket"></i></span>
       
    </div>
</nav>


<div class="notification-menu" id="notification-menu">
    <div class="card" id="notifBar">
      </div>
 </div>


<script>
document.getElementById('navLogout').addEventListener('click', function() {
    Swal.fire({
        title: 'Logout',
        text: 'Are you sure you want to logout?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'includes/logout.php';
        }
    });
});
</script>