<?php

require_once("../../includes/functions.inc");

if (Tools::valuePost("action") == "save_rules") {
    $data = Tools::valuePost("data");

    $school->setRules($data);
    echo("Rules and Regulations Successfully saved!");
};

if (Tools::valuePost("action") == "save_news") {
    if($id = Tools::valuePost("id") AND $title = Tools::valuePost("title") AND $content = Tools::valuePostAllowTags("content")){
        $newsletter = new Newsletter($id);

        if($newsletter->update($title, $content)){
            echo ("Newsletter saved");
        };
    }else{
        echo("Please do not leave any field empty");
    }    
};

if (Tools::valuePost("action") == "create_news") {

    if($title = Tools::valuePost("title") AND $content = Tools::valuePostAllowTags("content")){
        if($school->addNews($title, $content)){
            echo "Newsletter saved";
        }
    }else{
        echo("Please do not leave any field empty");
    }
};
?>