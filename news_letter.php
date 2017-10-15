<?php 

include("includes/functions.inc");

$news = null;
$next_link = null;
$previous_link = null;
$del = Tools::valueGet("news_id");

if ($news_id = Tools::valueGet("news_id")) {

    $news = new Newsletter($news_id);
    $newsletter = $news->getFields();
    $del = $news_id;
} else{
    $news = new Newsletter($school->getLastNewsId());
    $newsletter = $news->getFields();
    $del = $news->getID();
}

if($news_id = $news->getNextId($school->getId())){

    $next_link = $news_id;
} else{

    $next_link = $school->getLastNewsId();
}

if ($news_id = $news->getPreviousId($school->getId())) {

    $previous_link = $news_id;
}else{

    $previous_link = $school->getLastNewsId();
}


//echo $user->getType();
if( $user->getType() == "parent"){
    include("app/parent/news_letter.php");
}elseif($user->getType() == "admin"){
    $delete_link = "process/workers/del_news.php?guid={$del}";
    include("app/admin/news_letter.php");
}

?>