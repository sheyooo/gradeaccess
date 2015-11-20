<?php
include("../../includes/functions.inc");


if (Tools::valuePost("action") == "set") {

    $scores = Tools::valuePost("scores");
    $scores = explode(",", $scores);
    //print_r($raw_scores);

    $assID = 'NULL';

    if(Tools::valuePost("assID")) { //THIS IS TO UPDATE EXISTING ASSESSMENTS
        $assessment =  new Assessment(Tools::valuePost("assID"));
        //$assessment->getClassID();
        $ass_class = new SchoolClass($assessment->getClassID());
        $subjects = $ass_class->getSubjectsID();

        $assessment->setScores($scores);
    }else{ //THIS IS TO INSERT NEW ASSESSMENTS
        $student = new Student(Tools::valuePost("student"));

        if($ass_id = $student->addAssessment($user->getID(), Tools::valuePost("year"), Tools::valuePost("term"))){
            $assessment= new Assessment($ass_id);

            $assessment->setScores($scores);
            echo $ass_id;
        }
    }

}

if (Tools::valuePost("action") == "delete") {
    $assessment = new Assessment(Tools::valuePost("id"));
    $assessment->delete();
}


?>