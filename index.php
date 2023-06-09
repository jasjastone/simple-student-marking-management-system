<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//uncomment for production build
// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);
require "./config/app_config.php";
require "./views/layouts/header/header.php";
if (!isset($_SESSION['email'])) {
    header("Location:./views/auth/login.php?message=Please Login");
}
?>
<style>
    .nav .nav-item a {
        color: white;
        transition: 500ms all ease-in-out;
    }

    .nav .nav-item:hover a {
        color: black;
        border-radius: 10px;
    }

    .nav .nav-item {
        transition: all ease-in;
        border-radius: 10px;
        background-color: #a9d38c;
    }

    .nav .nav-item:hover {
        background-color: white;
    }
</style>
<div class="container-fluid">
    <main>
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block info-bg text-white sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a onclick="toggleActiveLink(this)" class="nav-link" href="./index.php?route=/home&name=Dashboard">
                                <span class="align-text-bottom"></span>
                                Dashboard
                            </a>
                        </li>
                        <?php if ($_SESSION['role'] == ADMISSIONOFFICER) : ?>
                            <li class="nav-item">
                                <a onclick="toggleActiveLink(this)" class="nav-link" href="./index.php?route=/pages/register/users&name=Manage Users">
                                    <span class="align-text-bottom"></span>
                                    Manage Users
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($_SESSION['role'] == ADMISSIONOFFICER) : ?>
                            <li class="nav-item">
                                <a onclick="toggleActiveLink(this)" class="nav-link" href="./index.php?route=/pages/register/adduser&name=Add User">
                                    <span class="align-text-bottom"></span>
                                    Add User
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($_SESSION['role'] == ADMISSIONOFFICER || $_SESSION['role'] == HOD || $_SESSION['role'] == TEACHER) : ?>
                            <li class="nav-item">
                                <a onclick="toggleActiveLink(this)" class="nav-link" href="./index.php?route=/pages/marks/upload&name=Upload Marks">
                                    <span class="align-text-bottom"></span>
                                    Upload Result
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($_SESSION['role'] == ADMISSIONOFFICER || $_SESSION['role'] == HOD || $_SESSION['role'] == TEACHER) : ?>
                            <li class="nav-item">
                                <a onclick="toggleActiveLink(this)" class="nav-link" href="./index.php?route=/pages/marks/showresults&name=Students Result">
                                    <span class="align-text-bottom"></span>
                                    View Students Result
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a onclick="toggleActiveLink(this)" class="nav-link" href="./index.php?route=/pages/profile&name=Profile">
                                <span class="align-text-bottom"></span>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a onclick="toggleActiveLink(this)" class="nav-link" href="./auth/logout.php">
                                <span class="align-text-bottom"></span>
                                Sign out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?= $_GET['name'] != null ? $_GET['name'] : '' ?></h1>

                </div>
                <?php
                if (isset($_GET['message'])) { ?>
                    <div class="info-color text-center text-capitalize p-2 rounded fw-bold"><?php echo $_GET['message']; ?></div>
                <?php } ?>
                <?php
                if (isset($_GET['error'])) { ?>
                    <div class="danger-color text-center text-capitalize p-2 rounded fw-bold"><?php echo $_GET['error']; ?></div>
                <?php } ?>
                <?php
                if (!isset($_GET['route'])) {
                    try {
                        require "./views/home.php";
                    } catch (\Throwable $th) {
                        header("Location:./index.php?route=/home");
                    }
                } else {
                    try {
                        require "./views" . $_GET['route'] . ".php";
                    } catch (Throwable $th) {
                        echo "<div class='text-danger'>Fail to process the request An error occured</div> <br>" . '<div class="text-danger bg-danger" style="color:red;">'
                            . var_dump($th) .
                            "</div>";
                    }
                }
                ?>
        </div>
    </main>
</div>

<?php require "./views/layouts/footer/footer.php";
