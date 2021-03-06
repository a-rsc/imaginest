<?php

session_start();

if (!isset($_SESSION['user']))
{
    header("location: ./index.php");
    session_destroy();
    exit();
}

require_once(dirname(__DIR__, 1) . '/php/config/env.php');

require_once(dirname(__DIR__, 1) . '/php/config/validation.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $errors = array();

    if (sizeof($_FILES) === 1 && isset($_FILES['image']))
    {
        require_once(dirname(__DIR__, 1) . '/php/app/upload.php');
    }

    // alert
    if (empty($errors) && $_SERVER['REQUEST_METHOD'] === 'POST')
    {
        require_once(dirname(__DIR__, 1) . '/php/app/alert/uploadSuccess.php');
    }
}

?>
<!DOCTYPE html>
<html lang="<?php echo CONFIG['APP_LOCALE']; ?>">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="<?php echo CONFIG['APP_NAME']; ?> is a web application to share and enjoy images" />
    <meta name="author" content="Inmanol Garcia, Alvaro Rodriguez" />
    <title><?php echo CONFIG['APP_NAME']; ?></title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link href="css/imaginest.css" rel="stylesheet" />
</head>
<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <a class="navbar-brand text-primary" href="<?php echo CONFIG['URL'] . "/home.php"; ?>" title="<?php echo CONFIG['APP_NAME']; ?>"><i class="fas fa-globe"></i> <?php echo CONFIG['APP_NAME']; ?></a>
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark mr-lg-2 d-lg-block" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the md breakpoint-->
        <form class="form-inline mr-auto d-none d-md-block mr-3" method="post" action="<?php echo htmlspecialchars(CONFIG['URL'] . "/home.php"); ?>">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php if (!empty($data) && array_key_exists('search', $data)) echo $data['search']; ?>" />
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
                    <form class="form-inline mr-auto w-100" method="post" action="<?php echo htmlspecialchars(CONFIG['URL'] . "/home.php"); ?>">
                        <div class="input-group input-group-joined input-group-solid">
                            <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php if (!empty($data) && array_key_exists('search', $data)) echo $data['search']; ?>" />
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fas fa-search"></i></div>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="assets/img/illustrations/profiles/profile-2.png" title="<?php echo $_SESSION['user']['firstname'] ?? $_SESSION['user']['username'] ?>"></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-2.png" title="<?php echo $_SESSION['user']['firstname'] ?? $_SESSION['user']['username'] ?>">
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name text-primary"><?php echo $_SESSION['user']['firstname'] ?? $_SESSION['user']['username'] ?></div>
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
                                <a class="nav-link" href="<?php echo CONFIG['URL'] . "/home.php"; ?>" title="Have fun">Have fun</a>
                                <a class="nav-link active" href="<?php echo CONFIG['URL'] . "/upload.php"; ?>" title="Upload a post">Upload a post</a>
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
                        <div class="sidenav-footer-title text-primary"><?php echo $_SESSION['user']['firstname'] ?? $_SESSION['user']['username'] ?></div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container">
                        <div class="page-header-content pt-4">
                            <?php echo $alert ?? NULL; ?>
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title">
                                    <div class="page-header-icon"><i class="fas fa-camera-retro"></i></div>
                                        Upload a post!
                                    </h1>
                                    <div class="page-header-subtitle">Be inspired by <?php echo CONFIG['APP_NAME']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container" style="margin-top: -3rem;">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-lg border-lg rounded-lg">
                                <div class="card-body">
<?php

if (empty($errors) && $_SERVER['REQUEST_METHOD'] === 'POST')
{
    echo <<< heredoc
                                    <div class="row">
                                        <div class="col-lg-8 position-relative">
heredoc;

    echo "<img class=\"w-100 border border-lg shadow\" src=\"uploads/{$data['name']}\" alt=\"First slide\">";
    echo "<div class=\"position-absolute\" style=\"bottom: 10px;\">";

    // La variable no puede llamarse hashtag por que se mantiene la referencia anterior...
    foreach ($hashtags[0] as $ht) {
        echo "<span class=\"badge badge-pill badge-" . COLOURS[array_rand(COLOURS, 1)] . " mx-3\">#{$ht}</span>";
    }

    echo <<< heredoc
                                            </div>
                                        </div>
                                        <div class="col d-flex align-content-between flex-wrap mt-2 mt-lg-0">
                                            <p>{$data['description']}</p>
                                            <a href="{$_SERVER['PHP_SELF']}" class="btn btn-primary btn-block" title="Upload another post">Upload another post</a>
                                        </div>
                                    </div>
heredoc;

}
else
{

    echo <<< heredoc
                                    <img class="mx-auto img-fluid d-block" src="assets/img/upload.png" alt="Upload post to <?php echo CONFIG['APP_NAME']; ?>" width="250">
                                    <!-- Post form-->
heredoc;

    echo "<form method=\"post\" action=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "\" enctype=\"multipart/form-data\">";

    echo <<< heredoc
                                    <!-- Form Group (image)-->
                                    <div class="form-group">
                                        <label class="small mb-1" for="image">Image</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/x-png,image/gif,image/jpeg" required autofocus>
                                                <label class="custom-file-label" for="image">Choose an image</label>
                                                </div>
heredoc;

    if (!empty($errors) && array_key_exists('image', $errors)) echo "<p class=\"errors\">" . reset($errors['image']) . "</p>";

    echo <<< heredoc
            </div>
            <!-- Form Group (description)-->
            <div class="form-group">
                <label class="small mb-1" for="image">Description</label>
heredoc;

    echo "<textarea class=\"form-control\" name=\"description\" maxlength=\"" . VALIDATION['description']['length']['max'] . "\" rows=\"6\" cols=\"80\" aria-describedby=\"descriptionHelp\" placeholder=\"Enter a comment for the photo\"></textarea>";
    echo "<small id=\"emaidescriptionHelplHelp\" class=\"form-text text-muted\">Hashtags must be written with #.</small>";

    echo <<< heredoc
            </div>
            <!-- Form Group (upload box)-->
            <div class="form-group mt-4 mb-0">
                <button type="submit" class="btn btn-primary" title="Upload">Upload</button>
            </div>
heredoc;

    if (!empty($errors))
    {
        if (array_key_exists('noValidation', $errors))
        {
            echo "<p class=\"errors\">" . reset($errors['noValidation']) . "</p>";
        }
    }

    echo "</form>";
}

?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="footer mt-auto footer-light text-primary">
                <!-- Main page content-->
                <div class="container-fluid p-0">
                    <div class="d-sm-block d-lg-none">
                        <div class="row text-center shadow-lg border-lg rounded-lg">
                            <div class="col bg-white p-0">
                                <a class="nav-link" href="<?php echo CONFIG['URL'] . "/home.php"; ?>" title="Have fun"><i class="fas fa-home display-4"></i></a>
                            </div>
                            <div class="col bg-gradient-primary-to-secondary p-0">
                            <a class="nav-link" href="<?php echo CONFIG['URL'] . "/upload.php"; ?>" title="Upload a post"><i class="text-white fas fa-camera display-4"></i></a>
                            </div>
                            <div class="col bg-white p-0">
                            <a class="nav-link" href="<?php echo CONFIG['URL'] . "/profile.php"; ?>" title="Profile"><i class="fas fa-user display-4"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row py-1 px-2">
                        <div class="col-md-6 small text-center text-md-left">All rights reserved &copy; <a href="<?php echo CONFIG['URL'] . "/index.php"; ?>" title="<?php echo CONFIG['APP_NAME']; ?>"><?php echo CONFIG['APP_NAME']; ?></a> &middot; <?php echo date("Y"); ?></div>
                        <div class="col-md-6 small text-center text-md-right">
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
    <script src="js/general.js"></script>
</body>
</html>