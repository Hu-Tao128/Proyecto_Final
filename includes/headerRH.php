<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="stylesheet" href="../css/adminRH.css">
    <link rel="stylesheet" href="../css/index.css">

    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>  <!-- Cargar Chart.js -->

    <script src="node_modules/chart.js/dist/chart.umd.js"></script>
    <link rel="icon" type="image/x-icon" href="../images/favicon.png">
    <?php
    include_once("../functions.php");

        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: ../index.php");
            exit();
        }

        $IDUsuario = $_SESSION['user'];

        if (getStatus($IDUsuario) != 'Active'){
            header("Location: ../Session/logout.php");
            exit();
        }

        if(department($IDUsuario) != "D001"){
            header("Location: ../admin/homeAdmin.php");
            exit();
        }
        
    ?>
    <title>RH</title>
</head>

<body id="body">

<header>
    <div class="icon__menu">
        <i class="fas fa-bars" id="btn_open"></i>
    </div>

    <div class="header-right">
        <div class="icon_notifications">
            <i class="fas fa-bell"></i>
        </div>

        <!-- Menú desplegable del usuario -->
        <div class="user-menu">
            <div class="user-name" id="userMenuToggle">
                <span>User</span>
                <i class="fas fa-chevron-down"></i>
                <a href="Session/logout.php"></a>
            </div>
            <ul class="dropdown-menu" id="dropdownMenu">
                <li><a href="profile.php"><i class="fas fa-user"></i> My Profile</a></li>
                <li><a href="Session/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</header>


    <div class="menu__side" id="menu_side">

        <div class="name__page">
        <i class="fas fa-users"></i>
        <h4>Human resources</h4>
        </div>

        <div class="options__menu">	

            <a href="../Human_Resources/homeRH.php" class="selected">
                <div class="option">
                    <i class="fas fa-home" title="Inicio"></i>
                    <h4>Home</h4>
                </div>
            </a>

            <a href="../Human_Resources/departaments.php" class="dropbtn">
            <div class="option">
            <i class="fas fa-building"></i>
                <h4>Departamens</h4>
                </div>
            </a>
            

            <a href="../Human_Resources/employee.php" class="dropbtn">  
            <div class="option">          
            <i class="fas fa-users"></i>
                    <h4>Employees</h4>
                </div>
            </a>

            <a href="../Human_Resources/aplications.php" class="dropbtn">
            <div class="option">
            <i class="fas fa-file-signature"></i>
                    <h4>Aplications</h4>
                </div>
            </a>

            <a href="../Human_Resources/tickets.php" class="dropbtn">
            <div class="option">
            <i class="fas fa-file-alt"></i>
                <h4>Tickets</h4>
            </div>
            </a>

            <a href="../Human_Resources/promotions.php" class="dropbtn">
                <div class="option">
                <i class="fas fa-gift"></i>
                <h4>Promotions</h4>
                </div>
            </a>

            <a href="../Human_Resources/vacations.php" class="dropbtn">
                <div class="option">
                <i class="fas fa-calendar-alt"></i>
                    <h4>Vacations</h4>
                </div>
            </a>

            <a href="../Human_Resources/position.php" class="dropbtn">                
                <div class="option">
                <i class="fas fa-sitemap"></i>
                <h4>Positions</h4>
                </div>
            </a>

            <a href="../Human_Resources/rating.php" class="dropbtn">
                <div class="option">
                <i class="fas fa-list-ol"></i>
                <h4>Rating</h4>
                </div>
            </a>

            <a href="../Human_Resources/benefie.php" class="dropbtn">            
                <div class="option">
                <i class="fas fa-coins"></i>
                <h4>Benefie</h4>
                </div>
            </a>

            <a href="../Human_Resources/absences.php" class="dropbtn">            
                <div class="option">
                <i class="fas fa-user-times"></i>
                <h4>Absences</h4>
                </div>
            </a>

            <a href="../Human_Resources/attedance.php" class="dropbtn">
                <div class="option">
                <i class="fas fa-user-check"></i>
                <h4>Attedance</h4>
                </div>
            </a>

            <a href="../Human_Resources/incident.php" class="dropbtn">
                <div class="option">
                <i class="far fa-sticky-note" title="Report an incident"></i>
                <h4>Incident</h4>
                </div>
            </a>

            <a href="../Human_Resources/informationAdmin.php" class="dropbtn">
                <div class="option">
                <i class="far fa-address-card" title="Personal Information"></i>
                <h4>Personal Information</h4>
                </div>
            </a>

            <a href="../Session/logout.php">
            <div class="option">
                <i class="fas fa-sign-out-alt"></i>
                <h4>Sign out</h4>
                </div>
            </a>

        </div>

    </div>

    <main>
      
        <div>
            
        </div>
        
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const menuLinks = document.querySelectorAll(".options__menu a");
        const currentPage = window.location.pathname.split("/").pop();

            menuLinks.forEach(link => {
                if (link.getAttribute("href") === currentPage) {
                    link.classList.add("selected");
                }
            });
        });

    </script>

    <script src="../js/menu.js"></script>
</body>