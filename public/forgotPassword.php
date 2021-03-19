<?php

session_start();

if (isset($_SESSION['user']))
{
    header("location: ./home.php");
    exit();
}

require_once(dirname(__DIR__, 1) . '/php/config/env.php');

require_once(dirname(__DIR__, 1) . '/php/config/validation.php');

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $errors = array();

    if (sizeof($_POST) === 4 && isset($_POST['email']) && isset($_POST['forgotPasswordCode']) && isset($_POST['password']) && isset($_POST['confirmPassword']))
    {
        require_once(dirname(__DIR__, 1) . '/php/app/changePassword.php');
    }
    else
    {
        // El formulario ha sido modificado por el usuario.
        $errors['noValidation'][] = VALIDATION['noValidation']['error']['msg'];
    }
}
else if (!(sizeof($_GET) === 2 && isset($_GET['forgotPasswordCode']) && isset($_GET['email'])))
{
    header("location: " . CONFIG['URL'] . "/index.php");
    exit();
}
else
{
    $data['email'] = filter_input(INPUT_GET, 'email');
    $data['forgotPasswordCode'] = filter_input(INPUT_GET, 'forgotPasswordCode');
}

?>
<!DOCTYPE html>
<html lang="<?php echo CONFIG['APP_LOCALE']; ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Imaginest is a web application to share and enjoy images" />
    <meta name="author" content="Inmanol Garcia, Alvaro Rodriguez" />
    <title><?php echo CONFIG['APP_NAME']; ?></title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link href="css/imaginest.css" rel="stylesheet" />
</head>
<body class="bodyAuthentication">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand text-primary" href="<?php echo CONFIG['URL'] . "/index.php"; ?>" title="<?php echo CONFIG['APP_NAME']; ?>">
                <h1><i class="fas fa-globe"></i> <?php echo CONFIG['APP_NAME']; ?></h1>
            </a>
        </div>
    </nav>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center mt-4">
                        <div class="col-lg-7">
                            <!-- Basic registration form-->
                            <div class="card shadow-lg border-lg border-primary rounded-lg mt-5">
                                <div class="card-header justify-content-center"><h1 class="text-primary display-4 text-center my-2">Forgot your password?</h1></div>
                                <div class="card-body">
                                    <!-- Registration form-->
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                                        <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
                                        <input type="hidden" name="forgotPasswordCode" value="<?php echo $data['forgotPasswordCode']; ?>">
                                        <!-- Form Group (password)-->
                                        <div class="form-group">
                                            <label class="small mb-1" for="password">Password</label>
                                            <input type="password" id="password" class="form-control" name="password" <?php echo "minlength='" . VALIDATION['password']['length']['min'] . "' maxlength='" . VALIDATION['password']['length']['max'] . "'"; ?> placeholder="Password" autocomplete="new-password" required autofocus>
                                            <?php if (!empty($errors) && array_key_exists('password', $errors)) echo "<p class='errors'>" . reset($errors['password']) . "</p>"; ?>
                                        </div>
                                        <!-- Form Group (confirm password)-->
                                        <div class="form-group">
                                            <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                            <input type="password" id="confirmPassword" class="form-control" name="confirmPassword" placeholder="Confirm Password" required>
                                        </div>
                                        <!-- Form Group (create account submit)-->
                                        <div class="form-group mt-4 Send-0">
                                            <button type="submit" class="mt-3 btn btn-primary w-100" title="Send">Send</button>
                                        </div>
                                        <?php
                                            if (!empty($errors))
                                            {
                                                if (array_key_exists('noValidation', $errors))
                                                {
                                                    echo "<p class='errors'>" . reset($errors['noValidation']) . "</p>";
                                                }
                                            }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="footer mt-auto footer-dark">
                <div class="container-fluid">
                    <div class="row">
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
