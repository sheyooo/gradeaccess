<li class="off-right">
        <a href="javascript:;" data-toggle="dropdown">
            <img src="<?php echo $user->getProfilePictureURL() ?>" class="header-avatar img-circle" alt="user" title="user">
            <span class="hidden-xs ml10">Hey <?php echo $user->getFirstName(); ?></span>
            <i style="color: white;" class="ti-angle-down ti-caret hidden-xs"></i>
        </a>
        <ul class="dropdown-menu animated fadeInUp">
            <li>
                <a href="javascript:;">
                    <div class="badge bg-danger pull-right"></div>
                    <span>Notifications</span>
                </a>
            </li>
            <!--<li>
                <a href="settings.php">
                    <span>Settings</span>
                </a>
            </li>-->

            <li>
                <a href="profile.php">
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="signout.php">
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </li>