<?php
    // -1 GLOBAL / 0 USER / 1 ADMIN
    $RAWpermissions = array(
        array('Dashboard', -1),
        array('Employee', 0),
        array('Payrolls', 0),
        array('Employees', 1),
        array('Company', 1)
    );
    $activeUserPermissions = array();

    foreach($RAWpermissions as $i) {
        if($i[1] == -1) {
            $activeUserPermissions[] = $i[0];
        }
        if($i[1] == $_SESSION['admin']) {
            $activeUserPermissions[] = $i[0];
        }
    }
?>

<div class="main-pg">
<nav class="left-navbar">
    <a href="" class="navbar-logo">PATROCLE.me</a>

    <div class="navbar-user-info">
        <div class="navbar-user-info-avatar">
            <div class="avatar"></div>
            <!-- <img src="inc/assets/avatar.png" alt="avatar"> -->
        </div>
        <div class="navbar-user-info-details">
            <a href="" id="logged-user-name"><?php echo $_SESSION['display_name']; ?></a><br>
            <span id="logged-user-position"><?php echo $_SESSION['title']; ?></span>
        </div>
    </div>

    <div class="nav-container">
        <ul class="inner-nav top">
            <li class="nav-label"><span>MENU</span></li>
            <?php
                foreach($activeUserPermissions as $lbl) {
                    echo '<li class="nav-btn';
                    if(strpos($_SERVER['REQUEST_URI'], strtolower($lbl))) {
                        echo ' active';
                    }
                    echo '">';
                    echo '<a href="'.strtolower($lbl).'">';
                    echo '<img src="'.ASSETS.'/'.strtolower($lbl).'-icon.svg">';
                    echo '<span>'.$lbl.'</span>';
                    echo '</a>';
                    echo '</li>';
                }
            ?>
        </ul>

        <ul class="inner-nav bottom">
            <li class="nav-label"><span>ACCOUNT</span></li>
            <li class="nav-btn">
                <a href="">
                    <img src="inc/assets/settings-icon.svg" alt="">
                    <span>Settings</span>
                </a>
            </li>
            <li class="nav-btn">
                <a href="dashboard/logout">
                    <img src="inc/assets/logout-icon.svg" alt="">
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- ----- EXAMPLE FOR BTN
    <li class="nav-btn">
        <a href="">
            <img src="inc/assets/dashboard-icon.svg" alt="">
            <span>Dashboard</span>
        </a>
    </li>
 -->