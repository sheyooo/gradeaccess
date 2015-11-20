<?php 
if($news_id = $school->getLastNewsId()){
    $news = new Newsletter($news_id);
    $news_row = $news->getFields();

    $date = date("F j, Y", strtotime($news_row['date']));

    echo "<a href=\"news_letter.php?guid={$news_row['news_id']}\">
    <section class=\"widget  bg-primary material-shadow\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"\" data-original-title=\"Newsletter: {$news_row['title']}\">
        <div class=\"equal-blocks\">
            <div class=\"col-xs-6 block\">
                <div class=\"text-center\">
                    <i class=\"fa fa-envelope-o fa-5x\"></i>
                    <h6 class=\"text-uppercase\">News Letter</h6>
                </div>
            </div>
            <div class=\"col-xs-6 block bg-primary brtr brbr p15\">
                <div class=\"arrow left\"></div>
                <div class=\"widget-body\">
                    <em>
                        {$news_row['title']}<br>
                        <span class=\"small\">{$date}</p></em>
                    </div>
                </div>
            </div>
        </section>
        </a>";

} else {

    echo "
    <section class=\"widget  bg-primary material-shadow\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"\" data-original-title=\"No Newsletter\">
        <div class=\"equal-blocks\">
            <div class=\"col-xs-6 block\">
                <div class=\"text-center\">
                    <i class=\"fa fa-envelope-o fa-5x\"></i>
                    <h6 class=\"text-uppercase\">News Letter</h6>
                </div>
            </div>
            <div class=\"col-xs-6 block bg-primary brtr brbr p15\">
                <div class=\"arrow left\"></div>
                <div class=\"widget-body\">
                    <em>School Management hasn't updated any News Letter
                        <a></a><br>
                        <a class=\"small\"></a></em>
                    </div>
                </div>
            </div>
        </section>";
}

?>