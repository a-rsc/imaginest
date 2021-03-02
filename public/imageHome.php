<?php

session_start();

//No comprobamos si la sesion esta iniciada



require_once('../php/config/env.php');
require_once('../php/bbdd/connecta_db_persistent.php');
require_once('../php/app/helpers.php');
require_once('../php/app/loadImage.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo CONFIG['APP_NAME']; ?></title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>
<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <a class="navbar-brand text-center" href="<?php echo CONFIG['URL'] . "/home.php"; ?>" title="<?php echo CONFIG['APP_NAME']; ?>"><i data-feather="globe"></i> <?php echo CONFIG['APP_NAME']; ?></a>
        <!-- Sidenav Toggle Button-->
        <!--<button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i data-feather="menu"></i></button>-->
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the md breakpoint-->
        <form class="form-inline mr-auto d-none d-md-block mr-3">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-append">
                    <div class="input-group-text"><i data-feather="search"></i></div>
                </div>
            </div>
        </form>
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ml-auto">
            <!-- Images Dropdown-->
            <li class="nav-item dropdown no-caret d-none d-sm-block mr-3">
                <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="font-weight-500">Images</div>
                    <i class="fas fa-chevron-right dropdown-arrow"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                    <a class="dropdown-item py-3" href="imageHome.php" target="_blank">
                        <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="home"></i></div>
                        <div>
                            <div class="small text-gray-500">Home</div>
                            See the Posts
                        </div>
                    </a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/components" target="_blank">
                        <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="camera"></i></div>
                        <div>
                            <div class="small text-gray-500">Image</div>
                            Upload a post
                        </div>
                    </a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3" href="profile.php" target="_blank">
                        <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="user"></i></div>
                        <div>
                            <div class="small text-gray-500">Profile</div>
                            Updates and changes
                        </div>
                    </a>
                </div>
            </li>
            <!-- Navbar Search Dropdown-->
            <!-- * * Note: * * Visible only below the md breakpoint-->
            <li class="nav-item dropdown no-caret mr-3 d-md-none">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>
                <!-- Dropdown - Search-->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100">
                        <div class="input-group input-group-joined input-group-solid">
                            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-append">
                                <div class="input-group-text"><i data-feather="search"></i></div>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- Alerts Dropdown-->
            <li class="nav-item dropdown no-caret d-none d-sm-block mr-3 dropdown-notifications">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="bell"></i></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                    <h6 class="dropdown-header dropdown-notifications-header">
                        <i class="mr-2" data-feather="bell"></i>
                        Alerts Center
                    </h6>
                    <!-- Example Alert 1-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-details">December 29, 2020</div>
                            <div class="dropdown-notifications-item-content-text">This is an alert message. It's nothing serious, but it requires your attention.</div>
                        </div>
                    </a>
                    <!-- Example Alert 2-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <div class="dropdown-notifications-item-icon bg-info"><i data-feather="bar-chart"></i></div>
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-details">December 22, 2020</div>
                            <div class="dropdown-notifications-item-content-text">A new monthly report is ready. Click here to view!</div>
                        </div>
                    </a>
                    <!-- Example Alert 3-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <div class="dropdown-notifications-item-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-details">December 8, 2020</div>
                            <div class="dropdown-notifications-item-content-text">Critical system failure, systems shutting down.</div>
                        </div>
                    </a>
                    <!-- Example Alert 4-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <div class="dropdown-notifications-item-icon bg-success"><i data-feather="user-plus"></i></div>
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-details">December 2, 2020</div>
                            <div class="dropdown-notifications-item-content-text">New user request. Woody has requested access to the organization.</div>
                        </div>
                    </a>
                    <a class="dropdown-item dropdown-notifications-footer" href="#!">View All Alerts</a>
                </div>
            </li>
            <!-- Messages Dropdown-->
            <li class="nav-item dropdown no-caret d-none d-sm-block mr-3 dropdown-notifications">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="mail"></i></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownMessages">
                    <h6 class="dropdown-header dropdown-notifications-header">
                        <i class="mr-2" data-feather="mail"></i>
                        Message Center
                    </h6>
                    <!-- Example Message 1  -->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <img class="dropdown-notifications-item-img" src="assets/img/illustrations/profiles/profile-2.png"/>
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                            <div class="dropdown-notifications-item-content-details">Thomas Wilcox · 58m</div>
                        </div>
                    </a>
                    <!-- Example Message 2-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <img class="dropdown-notifications-item-img" src="assets/img/illustrations/profiles/profile-3.png" />
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                            <div class="dropdown-notifications-item-content-details">Emily Fowler · 2d</div>
                        </div>
                    </a>
                    <!-- Example Message 3-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <img class="dropdown-notifications-item-img" src="assets/img/illustrations/profiles/profile-4.png" />
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                            <div class="dropdown-notifications-item-content-details">Marshall Rosencrantz · 3d</div>
                        </div>
                    </a>
                    <!-- Example Message 4-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <img class="dropdown-notifications-item-img" src="assets/img/illustrations/profiles/profile-5.png" />
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                            <div class="dropdown-notifications-item-content-details">Colby Newton · 3d</div>
                        </div>
                    </a>
                    <!-- Footer Link-->
                    <a class="dropdown-item dropdown-notifications-footer" href="#!">Read All Messages</a>
                </div>
            </li>
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/img/illustrations/profiles/profile-2.png" /></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-2.png" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?php echo $_SESSION['user']['username'] ?></div>
                            <div class="dropdown-user-details-email"><?php echo $_SESSION['user']['email'] ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#!">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Account
                    </a>
                    <a class="dropdown-item" href="<?php echo '../php/app/logout.php'; ?>">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="container">
    <div id="magicCarousel" class="carousel slide my-5" data-ride="carousel">

<!--    Carousel Indicators
      <ol class="carousel-indicators">
        <li data-target="#magicCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#magicCarousel" data-slide-to="1"></li>
        <li data-target="#magicCarousel" data-slide-to="2"></li>
        <li data-target="#magicCarousel" data-slide-to="3"></li>
      </ol>
      -->
<!--    Carousel Slider    -->
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img src="//unsplash.it/g/700/450" class="d-block w-100" style="width=''">
          <!--<div class="carousel-caption">-->
            <!--<h3>Slide 01</h3>-->
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At placeat dolore obcaecati perspiciatis neque in, iusto, quia aut molestias minus ipsam modi dolorem odit eos.</p>
          <!--</div> -->
        </div>

        <div class="carousel-item">
          <img src="https://picsum.photos/700/450" class="d-block w-100">
          <!--<div class="carousel-caption">-->
            <!--<h3>Slide 02</h3>-->
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia vel in placeat corrupti. Velit quidem eos, accusantium vitae nostrum reiciendis ratione libero? Aperiam, recusandae culpa.</p>
          <!--</div>-->
        </div>

        <div class="carousel-item">
          <img src="//unsplash.it/g/700/450" class="d-block w-100">
          <!--<div class="carousel-caption">-->
            <!--<h3>Slide 03</h3>-->
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, ut beatae porro ullam quidem officia dignissimos facilis? Blanditiis nesciunt labore pariatur quaerat exercitationem quibusdam modi!</p>
          <!--</div> -->
        </div>

        <div class="carousel-item">
          <img src="https://picsum.photos/700/450" class="d-block w-100">
          <!--<div class="carousel-caption">-->
            <!--<h3>Slide 04</h3>-->
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis soluta accusamus sequi eos consectetur! Animi minima modi ad at similique velit quibusdam veritatis sequi placeat?</p>
          <!--</div> -->
        </div>

<!--     Carousel Controls     -->
        <a href="#magicCarousel" class="carousel-control-prev" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a href="#magicCarousel" class="carousel-control-next" role="button" data-slide="next">
          <span class="carousel-control-next-icon"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </div>
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/date-range-picker-demo.js"></script>
</body>
</html>
