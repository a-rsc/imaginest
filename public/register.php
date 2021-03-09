<?php

session_start();

if (isset($_SESSION['user']))
{
    header("location: ./home.php");
    exit();
}

require_once(dirname(__DIR__, 1) . '/php/config/env.php');

require_once(dirname(__DIR__, 1) . '/php/config/validation.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $errors = array();

    if (
        (5 <= sizeof($_POST) && sizeof($_POST) <=7 &&
        isset($_POST['username']) &&
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['confirmPassword']) &&
        isset($_POST['termsAndConditions'])) ||
        (4 <= sizeof($_POST) && sizeof($_POST) <=6 &&
        isset($_POST['username']) &&
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['confirmPassword'])))
    {
        require_once(dirname(__DIR__, 1) . '/php/app/register.php');
    }
    else
    {
        // El formulario ha sido modificado por el usuario.
        $errors['noValidation'][] = VALIDATION['noValidation']['error']['msg'];
    }
}

?>
<!DOCTYPE html>
<html lang="<?php echo CONFIG['APP_LOCALE']; ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
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
            <a class="navbar-brand" href="<?php echo CONFIG['URL'] . "/index.php"; ?>" title="<?php echo CONFIG['APP_NAME']; ?>">
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
                            <div class="card-header justify-content-center"><h1 class="text-primary display-4 text-center my-2">Sign up</h1></div>
                                <div class="card-body">
                                    <!-- Registration form-->
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                        <!-- Form Group (username)-->
                                        <div class="form-group">
                                            <label class="small mb-1" for="username">Username</label>
                                            <input type="text" id="username" class="form-control" name="username" <?php echo "minlength='" . VALIDATION['username']['length']['min'] . "' maxlength='" . VALIDATION['username']['length']['max'] . "'"; ?> placeholder="Username" value="<?php if (!empty($data) && array_key_exists('username', $data)) echo $data['username']; ?>" autocomplete="username" required autofocus>
                                            <?php if (!empty($errors) && array_key_exists('username', $errors)) echo "<p class='errors'>" . reset($errors['username']) . "</p>"; ?>
                                        </div>
                                        <!-- Form Row-->
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <!-- Form Group (first name)-->
                                                <div class="form-group">
                                                    <label class="small mb-1" for="firstname">First name</label>
                                                    <input type="text" id="firstname" class="form-control" name="firstname" <?php echo "minlength='" . VALIDATION['firstname']['length']['min'] . "' maxlength='" . VALIDATION['firstname']['length']['max'] . "'"; ?> placeholder="First name" value="<?php if (!empty($data) && array_key_exists('firstname', $data)) echo $data['firstname']; ?>" autocomplete="given-name" >
                                                    <?php if (!empty($errors) && array_key_exists('firstname', $errors)) echo "<p class='errors'>" . reset($errors['firstname']) . "</p>"; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (last name)-->
                                                <div class="form-group">
                                                    <label class="small mb-1" for="lastname">Last name</label>
                                                    <input type="text" id="lastname" class="form-control" name="lastname" <?php echo "minlength='" . VALIDATION['lastname']['length']['min'] . "' maxlength='" . VALIDATION['lastname']['length']['max'] . "'"; ?> placeholder="Last name" value="<?php if (!empty($data) && array_key_exists('lastname', $data)) echo $data['lastname']; ?>" autocomplete="family-name" >
                                                    <?php if (!empty($errors) && array_key_exists('lastname', $errors)) echo "<p class='errors'>" . reset($errors['lastname']) . "</p>"; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form Group (email address) -->
                                        <div class="form-group">
                                            <label class="small mb-1" for="email">Email</label>
                                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="<?php if (!empty($data) && array_key_exists('email', $data)) echo $data['email']; ?>" autocomplete="email" required>
                                            <?php if (!empty($errors) && array_key_exists('email', $errors)) echo "<p class='errors'>" . reset($errors['email']) . "</p>"; ?>
                                        </div>
                                        <!-- Form Row    -->
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <!-- Form Group (password)-->
                                                <div class="form-group">
                                                    <label class="small mb-1" for="password">Password</label>
                                                    <input type="password" id="password" class="form-control" name="password" <?php echo "minlength='" . VALIDATION['password']['length']['min'] . "' maxlength='" . VALIDATION['password']['length']['max'] . "'"; ?> placeholder="Password" autocomplete="new-password" required>
                                                    <?php if (!empty($errors) && array_key_exists('password', $errors)) echo "<p class='errors'>" . reset($errors['password']) . "</p>"; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (confirm password)-->
                                                <div class="form-group">
                                                    <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                                    <input type="password" id="confirmPassword" class="form-control" name="confirmPassword" placeholder="Confirm Password" autocomplete="new-password" required>
                                                </div>
                                            </div>
                                        </div>

                                            <!-- Form Group (form submission)-->
                                            <div class="form-group d-flex align-items-center justify-content-between">
                                                <div class="custom-control custom-control-solid custom-checkbox">
                                                    <input class="custom-control-input small" id="termsAndConditions" type="checkbox" name="termsAndConditions" />
                                                    <label class="custom-control-label mr-3" for="termsAndConditions">
                                                        I accept the
                                                        <a href="<?php echo CONFIG['URL'] . "/terms.php"; ?>" title="Terms & Conditions." target="_black">Terms &amp; Conditions.</a>
                                                    </label>
                                                    <?php if (!empty($errors) && array_key_exists('termsAndConditions', $errors)) echo "<p class='errors'>" . reset($errors['termsAndConditions']) . "</p>"; ?>
                                                </div>
                                            <!-- Form Group (create account submit)-->
                                            <button type="submit" class="mt-3 btn btn-primary" title="Sign up">Sign up</button>
                                            </div>

                                        <?php
                                            if (!empty($errors))
                                            {
                                                if (array_key_exists('noValidation', $errors))
                                                {
                                                    echo "<p class='errors'>" . reset($errors['noValidation']) . "</p>";
                                                }
                                                else if (array_key_exists('noRegister', $errors))
                                                {
                                                    echo "<p class='errors'>" . reest($errors['noRegister']) . "</p>";
                                                }
                                            }
                                        ?>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="<?php echo CONFIG['URL'] . "/index.php"; ?>" title="Have an account? Go to login">Have an account? Go to login</a></div>
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
    <script src="js/general.js"></script>
</body>
</html>
