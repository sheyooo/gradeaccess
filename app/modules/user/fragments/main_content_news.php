<?php
$title = null;
$time = null;

if ($newsletter) {
    $title = $newsletter['title'];
    $time = $newsletter['date'];
};


?>
<div class="col-xs-12 no-p" >
    <section class="panel panel-default" style="min-height: 100%;">
        <header class="panel-heading">
            
            <div class="col-xs-1"><a class="btn btn-default btn-rounded pull-left" 
            href="news_letter.php?news_id=<?php echo $previous_link ?>">
            <i class=" fa fa-arrow-left"></i></a></div>

            <?php if($user->getType() == "admin"){
                echo "<div class=\"col-xs-1\">
                        <a class=\"btn btn-default btn-rounded pull-left\" href=\"{$delete_link}\">
                        <i class=\" fa fa-close\"></i> Delete
                        </a>
                    </div>";
                }
            ?>
            <div class="col-xs-9 text-center">
                <h4 class="text-uppercase"><?php echo $title; ?>
                    <small class="pull-right text-capitalize col-xs-12">
                        <?php echo date("l, jS F Y", strtotime($time)); ?>
                    </small>
                </h4>
            </div>

            <div class="col-xs-1 pull-right"><a class="btn btn-default btn-rounded pull-right" 
            href="news_letter.php?news_id=<?php echo $next_link ?>">
            <i class=" fa fa-arrow-right"></i></a></div>

            <div class="clearfix"></div>
        </header>
        <div class="panel-body" style="">
            <div class="col-xs-12">
                <?php echo $newsletter['content'] ?>
            </div>

        </div>
    </section>
</div>