<li class="dropdown hidden-xs">
        <a href="javascript:;" data-toggle="dropdown">
            <i style="color: white;" class="ti-more-alt fa-lg"></i>
        </a>
        <ul class="dropdown-menu animated fadeInUp">
            <li class="dropdown-header">Quick Links</li>
            <li>
                <a href="ch_pass.php">Change Password</a>
            </li>
            <li>
                <a href="help.php">Help</a>
            </li>
            <li>
                <a href="bug.php">Report a Problem</a>
            </li>
        </ul>
    </li>

     <?php
        include(__DIR__ . "/../../app/modules/user/fragments/header_chat_icon_button.php");
    ?>

    <?php
        include(__DIR__ . "/../../app/modules/user/fragments/header_notification_icon_button.php");
    ?>

    <?php
        include(__DIR__ . "/../../app/modules/user/fragments/header_user_icon_button.php");
    ?>