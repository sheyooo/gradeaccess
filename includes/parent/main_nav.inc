<nav class="main-navigation" data-height="auto" data-size="6px" data-distance="0" data-rail-visible="true"
     data-wheel-step="10">
    <p class="nav-title">MENU</p>
    <ul class="nav">
        <!-- home -->
        <li>
            <a href="index.php">
                <i class="ti-home"></i>
                <span>Home</span>
            </a>
        </li>
        <!-- /home -->

        <!-- behaviour -->
        <li>
            <a href="behaviours.php">
                <i class="ti-eye"></i>
                <span>Behaviour</span>
            </a>
        </li>
        <!-- /behaviour -->

        <!-- chats -->
        <li>
            <a href="messages.php">
                <i class="ti-comment-alt"></i>
                <span>Chats</span>
            </a>
        </li>
        <!-- /chats -->

        <!-- news letter -->
        <li>
            <a href="news_letter.php">
                <i class="ti-announcement"></i>
                <span>News Letter</span>
            </a>
        </li>
        <!-- /news -->

        <!-- exam scores -->
        <li>
            <a href="assessment.php">
                <i class="ti-bar-chart"></i>
                <span>Exam Scores</span>
            </a>

        </li>
        <!-- /exam scores -->

        <?php


        $final = null;
        $parent_span = null;

        if($psu_check){

            $students = $parent->getStudentsID();

            //print_r($students);

            $count_prop = "bg-default";
            if (count($students) > 1){
                $count_prop = "bg-danger animated infinite pulse";
            }

            $final = "";

            foreach ($students as $key => $student_id) {
                    $studs = new User($student_id);                    

                    $final .= "<li>";
                    $final .= "<a href=\"process/workers/switch_stud.php?guid={$student_id} \"> ";
                    $final .= "<strong><span>{$studs->getFullName()}</span></strong>";
                    $final .= "</a>";
                    $final .= "</li>";
                }

                $cnt = count($students);
                $parent_span = "<span class=\"animated pulse infinite badge {$count_prop}\"> {$cnt} </span>";

        }else{  
                $parent_span = "<span class=\"animated pulse infinite badge bg-warning\"> 0 </span>";
            
                $final .= "<li>";
                $final .= "<a href=\"link.php\"> ";
                $final .= "<span>Click to link a student</span>";
                $final .= "</a>";
                $final .= "</li>";


            }
        ?>

        <!-- students -->
        <li>
            <a href="javascript:;">
                <i class="toggle-accordion"></i>
                <i class="ti-user"></i>
                <span>Children</span>
                <?php echo $parent_span ?>
            </a>
            <ul class="sub-menu">
                <?php echo $final; ?>
            </ul>
        </li>
        <!-- /students -->

        <!--SIGNOUT-->
        <li>
            <a href="signout.php">
                <i class="fa fa-power-off"></i>
                <span>Log Out!</span>
            </a>
        </li>
        <!--SIGNOUT-->


    </ul>

</nav>