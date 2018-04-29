<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Light Bootstrap Dashboard - Free Bootstrap 4 Admin Dashboard by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
</head>

<body>
<div class="wrapper">
    <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
        <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

    Tip 2: you can also add an image using data-image tag
-->
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    INSAHNI
                </a>
            </div>
            <ul class="nav">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">
                        <i class="nc-icon nc-chart-pie-35"></i>
                        <p>Emotion Analysis</p>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard2.php">
                        <i class="nc-icon nc-chart-pie-35"></i>
                        <p>QR Results</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="./user.html">
                        <i class="nc-icon nc-circle-09"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="./table.html">
                        <i class="nc-icon nc-notes"></i>
                        <p>Table List</p>
                    </a>
                </li>
                <!--<li>
                               <a class="nav-link" href="./typography.html">
                                   <i class="nc-icon nc-paper-2"></i>
                                   <p>Typography</p>
                               </a>
                           </li>-->
                <!--<li>
                    <a class="nav-link" href="./icons.html">
                        <i class="nc-icon nc-atom"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="./maps.html">
                        <i class="nc-icon nc-pin-3"></i>
                        <p>Maps</p>
                    </a>
                </li> -->
                <li>
                    <a class="nav-link" href="./notifications.html">
                        <i class="nc-icon nc-bell-55"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                <!-- <li class="nav-item active active-pro">
                     <a class="nav-link active" href="upgrade.html">
                         <i class="nc-icon nc-alien-33"></i>
                         <p>Upgrade to PRO</p>
                     </a>
                 </li> -->
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
            <div class=" container-fluid  ">
                <a class="navbar-brand" href="#pablo"> Emotions Analysis </a>
                <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item">
                            <!-- <a href="#" class="nav-link" data-toggle="dropdown">
                                 <i class="nc-icon nc-palette"></i>
                                 <span class="d-lg-none">Emotions Analysis</span>
                             </a> -->
                        </li>
                        <!--<li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="nc-icon nc-planet"></i>
                                <span class="notification">5</span>
                                <span class="d-lg-none">Notification</span>
                            </a>
                            <ul class="dropdown-menu">
                                <a class="dropdown-item" href="#">Notification 1</a>
                                <a class="dropdown-item" href="#">Notification 2</a>
                                <a class="dropdown-item" href="#">Notification 3</a>
                                <a class="dropdown-item" href="#">Notification 4</a>
                                <a class="dropdown-item" href="#">Another notification</a>
                            </ul>
                        </li>  -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nc-icon nc-zoom-split"></i>
                                <span class="d-lg-block">&nbsp;Search</span>
                            </a>
                        </li>
                    </ul>
                    <!--<ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <span class="no-icon">Account</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="no-icon">Dropdown</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <span class="no-icon">Log out</span>
                            </a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card subject">
                            <div class=" ">
                                <h4 class=" subject-title">Chemistry Class</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header ">
                                <h4 class="card-title">Students List</h4>
                            </div>
                            <!--<div class="card-body ">
                                <ul class="list-unstyled">
                                    <li id="testStudent"><input type="checkbox" name="name" id="name">John Smith</li>
                                    <li>Abdulrahman Mohammad</li>
                                    <li>Saed Hamad</li>
                                </ul>
                            </div> -->


                            <div class="card-body ">
                                <form action="" class="students-filter">
                                    <p>
                                        <input type="checkbox" name="" id="st1">
                                        <label for="st1">John Smith</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" name="" id="st2">
                                        <label for="st2">Ahamd Saeed</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" name="" id="st3">
                                        <label for="st3">Abdulrahman Mohamamd</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" name="" id="st6">
                                        <label for="st1">John Smith</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" name="" id="st4">
                                        <label for="st2">Ahamd Saeed</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" name="" id="st5">
                                        <label for="st3">Abdulrahman Mohamamd</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" name="" id="st7">
                                        <label for="st2">Ahamd Saeed</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" name="" id="st9">
                                        <label for="st2">Ahamd Saeed</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" name="" id="st8">
                                        <label for="st3">Abdulrahman Mohamamd</label>
                                    </p>
                                </form>
                            </div>

                            <div class="card-footer ">

                                <hr>
                              <!--  <div class="stats">
                                    <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                </div>  -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card ">
                            <div class="card-header ">
                                <h4 class="card-title">Student(s) Behavior</h4>
                                <p class="card-category">Class performance</p>
                            </div>
                            <div class="card-body ">
                                <div id="chartHours" class="ct-chart"></div>
                            </div>
                            <div class="card-footer ">
                              <!--  <div class="legend">
                                    <i class="fa fa-circle text-info"></i> Open
                                    <i class="fa fa-circle text-danger"></i> Click
                                    <i class="fa fa-circle text-warning"></i> Click Second Time
                                </div> -->
                                <div class="legend">
                                   <!-- <i class="fa fa-circle text-info"-icon></i> --> <img class="emotion-icon" src="../assets/img/smile.png"  style="height: 30px; width: 30px;" alt=""> <span>100%</span>
                                    <!--   <i class="fa fa-circle text-danger"></i>  --> <img class="emotion-icon" src="../assets/img/001-sad-2.png"  style="height: 30px; width: 30px;" alt=""> <span>80%</span>
                                    <!-- <i class="fa fa-circle text-warning"></i> --> <img class="emotion-icon" src="../assets/img/002-sad-1.png"  style="height: 30px; width: 30px;" alt=""> <span>60%</span>
                                    <!-- <i class="fa fa-circle text-danger"></i>  --> <img class="emotion-icon" src="../assets/img/003-sad.png"  style="height: 30px; width: 30px;" alt=""> <span>40%</span>

                                </div>
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-history"></i> Updated 15 minutes ago
                                </div>
                                <button id="updateBtn">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title" align="center">Student Real Time Emotional Data </h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chartPreferences1" class="ct-chart ct-perfect-fourth"></div>
                                        <i class="fa fa-circle text-info"></i> Happy
                                        <i class="fa fa-circle text-danger"></i> Sad
                                    </div>
                                </div>
                            </div>
                        </div>

                
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <nav>
                    <ul class="footer-menu">
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-center">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                    </p>
                </nav>
            </div>
        </footer>
    </div>
</div>

</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<?php
$json = file_get_contents("../../sampleEmotion.json");
$json2 = file_get_contents("../../sampleQr.json");
?>

<script>
    
var vals = '<?=$json?>';
var quizData = '<?=$json2?>';
</script>

<script src="../assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script>

</html>