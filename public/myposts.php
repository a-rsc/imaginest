<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("location: ./index.php");
    session_destroy();
    exit();
}

require_once('../php/config/env.php');
require_once('../php/bbdd/connecta_db_persistent.php');
require_once('../php/app/helpers.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (sizeof($_POST) === 1 && isset($_POST['busqueda']))
    {
        require_once('../php/app/search.php');
    }
}


?>
<!DOCTYPE html>
<html lang="<?php echo CONFIG['APP_LOCALE']; ?>">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo CONFIG['APP_NAME']; ?></title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    <link href="css/imaginest.css" rel="stylesheet" />
    <link href="css/myposts.css" rel="stylesheet" />
</head>
<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <a class="navbar-brand text-primary" href="<?php echo CONFIG['URL'] . "/home.php"; ?>" title="<?php echo CONFIG['APP_NAME']; ?>"><i class="fas fa-globe"></i> <?php echo CONFIG['APP_NAME']; ?></a>
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2 d-sm-none d-lg-block" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the md breakpoint-->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-inline mr-auto d-none d-md-block mr-3">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search"/>
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                </div>
            </div>
        </form>
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ml-auto">
            <!-- Navbar Search Dropdown-->
            <!-- * * Note: * * Visible only below the md breakpoint-->
            <li class="nav-item dropdown no-caret mr-3 d-md-none">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search"></i></a>
                <!-- Dropdown - Search-->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100">
                        <div class="input-group input-group-joined input-group-solid">
                            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" />
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fas fa-search"></i></div>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/img/illustrations/profiles/profile-2.png" /></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-2.png" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?php echo $_SESSION['user']['firstname'] ?? $_SESSION['user']['username'] ?></div>
                            <div class="dropdown-user-details-email"><?php echo $_SESSION['user']['email'] ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo CONFIG['URL'] . "/profile.php";; ?>" title="Profile">
                        <div class="dropdown-item-icon"><i class="fas fa-user"></i></div>
                        Profile
                    </a>
                    <a class="dropdown-item" href="<?php echo CONFIG['URL'] . "/security.php"; ?>" title="Security">
                        <div class="dropdown-item-icon"><i class="fas fa-key"></i></div>
                        Security
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo '../php/app/logout.php'; ?>" title="Logout">
                        <div class="dropdown-item-icon"><i class="fas fa-sign-out-alt"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <!-- Sidenav Menu Heading (Posts)-->
                        <div class="sidenav-menu-heading">Publications</div>
                        <!-- Sidenav Accordion (Dashboard)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                            <div class="nav-link-icon"><i class="fas fa-camera"></i></div>
                            Posts
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse show" id="collapseDashboards" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link active" href="<?php echo CONFIG['URL'] . "/home.php"; ?>" title="Have fun">Have fun</a>
                                <a class="nav-link" href="<?php echo CONFIG['URL'] . "/upload.php"; ?>" title="Upload a post">Upload a post</a>
                                <a class="nav-link" href="<?php echo CONFIG['URL'] . "/myposts.php"; ?>" title="My posts">My posts</a>
                            </nav>
                        </div>
                        <!-- Sidenav Menu Heading (Settings)-->
                        <div class="sidenav-menu-heading">Settings</div>
                        <!-- Sidenav Accordion (Dashboard)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseAccount" aria-expanded="false" aria-controls="collapseAccount">
                            <div class="nav-link-icon"><i class="fas fa-cog"></i></div>
                            Account
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAccount" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAccount">
                                <a class="nav-link" href="<?php echo CONFIG['URL'] . "/profile.php"; ?>" title="Profile">Profile</a>
                                <a class="nav-link" href="<?php echo CONFIG['URL'] . "/security.php"; ?>" title="Security">Security</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Sidenav Footer-->
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title"><?php echo $_SESSION['user']['firstname'] ?? $_SESSION['user']['username'] ?></div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container">
                        <div class="page-header-content pt-4">
                            <?php echo $toast ?? NULL; ?>
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title">
                                    <div class="page-header-icon"><i class="far fa-images"></i></div>
                                        Your posts!
                                    </h1>
                                    <div class="page-header-subtitle">Be inspired by <?php echo CONFIG['APP_NAME']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- GALERIA -->
                <!--
                <div class="container-fluid conten" style="margin-top: 3rem;">
                    <div class="px-lg-5">
                        <div class="row">
                        
                        <?php
                        /*
                            $sql = "SELECT users_iduser, description, name FROM images WHERE users_iduser = ?";
                            $query = $db->prepare($sql);
                            $query->execute(array($_SESSION['user']['iduser']));

                            $row = $query->fetchAll();
                            if($row > 0)
                            {
                                foreach($row as $image)
                                {
                                    //echo '<div class="col-12"></div>';
                                        echo '<div class="col-xl-3 col-lg-4 col-md-6 mb-4">';
                                            echo "<div class=\"bg-white rounded shadow-sm\"><img src=\"./uploads/{$image['name']}\" alt=\"\" class=\"img-fluid card-img-top\">";
                                                echo '<div class="p-4">';
                                                // <h5> <a href="#" class="text-dark">And She Realized</a></h5>
                                                    echo "<p class=\"small text-muted mb-0\">{$image['description']} . </p>";
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                }
                            
                            }else
                            {
                                echo '<div class="col-xl-12 col-lg-12 col-md-12 mb-4"></div>';
                                echo '<div class="col-xl-12 col-lg-12 col-md-12 mb-4">';
                                    echo "<p class='small text-center mb-0'>You don't have any pictures in Imaginest</p>";
                                    echo '<div class="col text-center">';
                                        echo '<a href="./upload.php" class="center-block btn btn-light" title="Upload">Upload an image here</a>';
                                    echo '</div>';
                                echo '</div>';
                            }*/
                            ?>
                        </div>
                    </div>
                </div>
-->
            <div class="gallerybody">
                    <div id="top"></div>
                    <section class="gallery">
                        
                        <?php
                            $sql = "SELECT users_iduser, description, name FROM images WHERE users_iduser = ?";
                            $query = $db->prepare($sql);
                            $query->execute(array($_SESSION['user']['iduser']));

                            $row = $query->fetchAll();
                            if($row > 0)
                            {
                                echo "<div class=\"row\">";
                                    echo "<ul>";
                                        echo "<a href=\"#\" class=\"close\"></a>";
                                        $i = 0;
                                        foreach($row as $image)
                                        {
                                            $item[$i] = $i;
                                            //echo '<div class="col-12"></div>';
                                            echo "<li>";
                                                echo "<a class=\"image fancybox\" href=\"#$item[$i]\">";
                                                    echo "<img src=\"./uploads/{$image['name']}\" alt=\"\" class=\"zoom\">";
                                                echo '</a>';
                                            echo "</li>";    
                                            $i++;
                                        }

                                    echo "</ul>";
                                echo "</div>";

                                $i = 0;
                                foreach($row as $image)
                                {
                                    echo "<div id=\"$item[$i]\" class=\"card port\">";
                                        echo "<div class=\"row\">";
                                            echo "<div class=\"description\">";
                                                echo "<p class=\"medium mb-0\">{$image['description']}</p>";
                                            echo "</div>";
                                            echo "<img src=\"./uploads/{$image['name']}\" alt=\"\">";
                                        echo "</div>";
                                    echo "</div>";
                                    $i++;
                                }

                            }else
                            {
                                echo '<div class="col-xl-12 col-lg-12 col-md-12 mb-4"></div>';
                                echo '<div class="col-xl-12 col-lg-12 col-md-12 mb-4">';
                                    echo "<p class='small text-center mb-0'>You don't have any pictures in Imaginest</p>";
                                    echo '<div class="col text-center">';
                                        echo '<a href="./upload.php" class="center-block btn btn-light" title="Upload">Upload an image here</a>';
                                    echo '</div>';
                                echo '</div>';
                            }

                        ?>
                        
                    </section>
                </div>
                <!-- Main page content-->
                <section class="container-fluid bg-cyan d-sm-block d-lg-none" style="padding: 0; position: fixed; width: 100%; bottom: 5rem;">
                    <div class="row text-center">
                        <div class="col bg-primary py-5">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="col bg-danger py-5">
                            <i class="fas fa-camera"></i>
                        </div>
                        <div class="col bg-teal py-5">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </section>
            </main>
            <footer class="footer mt-auto footer-light">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 small">All rights reserved &copy; <a href="<?php echo CONFIG['URL'] . "/index.php"; ?>" title="<?php echo CONFIG['APP_NAME']; ?>"><?php echo CONFIG['APP_NAME']; ?></a> &middot; <?php echo date("Y"); ?></div>
                        <div class="col-md-6 text-md-right small">
                            <a href="<?php echo CONFIG['URL'] . "/privacy.php"; ?>" title="Privacy Policy">Privacy Policy</a>
                            &middot;
                            <a href="<?php echo CONFIG['URL'] . "/terms.php"; ?>" title="Terms & Conditions">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Return to Top -->
    <div id="return-to-top">
        <svg class="fas fa-chevron-circle-up"></svg>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/myposts.js"></script>
</body>
</html>
