<?php 

include("includes/functions.inc");

if( $user->getType() == "parent"){
    
}


    $sessions = $school->getAllSessions();
    $terms = $school->getAllTerms();
    $current_session = $school->getCurrentSession();
    $current_term = $school->getCurrentTermID();
    $options = null;
    $options1 = null;
    $period_reminder = null;

    $c_teacher = null;


    $scores = null;
    //print_r($terms);

if ($psu_check) {

    if ($get_year = Tools::valueGet("year") AND $get_term = Tools::valueGet("term")) {
        //FOR THE HEADER PANEL SELECTS
        $year = null;
        $term = null;

        foreach ($sessions as $key => $value) {
            if($value == $get_year){
                $options .= "<option selected value=\"{$value}\">{$value} SESSION</option>";
                $year = $value;
            }else{
                $options .= "<option value=\"{$value}\">{$value} SESSION</option>";
            }
        }

        foreach ($terms as $key => $value) {
            if($value['term_id'] == $get_term){
                $options1 .= "<option selected value=\"{$value['term_id']}\">{$value['nice_name']}</option>";

                $term = $value['nice_name'];
            }else{
                $options1 .= "<option value=\"{$value['term_id']}\">{$value['nice_name']}</option>";
            }
        }

        $period_reminder = $term . " of " . $year . " SESSION";

        //END HEADER PANEL SELECTS

        
        if($id = $student->getAssessmentId($get_year, $get_term)){

            $assessment = new Assessment($id);
            $c_t_id = $assessment->getAssessment()['teacher_id'];
            $c_teacher = new User($c_t_id);
            $scores = $assessment->getScores();
            //print_r($scores);
        }
    } 
    else{
        //FOR THE HEADER PANEL SELECTS
        $year = null;
        $term = null;
        $assessment;

        if($assessment = new Assessment($student->getLastAssessmentId())){
            $current_session = $assessment->getYear();
            $current_term = $assessment->getTermID();
        }

        foreach ($sessions as $key => $value) {
            if($value == $current_session){
                $options .= "<option selected value=\"{$value}\">{$value} SESSION</option>";
                $year = $value;
            }else{
                $options .= "<option value=\"{$value}\">{$value} SESSION</option>";
            }
        }

        foreach ($terms as $key => $value) {
            if($value['term_id'] == $current_term){
                $options1 .= "<option selected value=\"{$value['term_id']}\">{$value['nice_name']}</option>";

                $term = $value['nice_name'];
            }else{
                $options1 .= "<option value=\"{$value['term_id']}\">{$value['nice_name']}</option>";
            }
        }

        $period_reminder = $term . " of " . $year . " SESSION";

        //END HEADER PANEL SELECTS

        $c_t_id = $assessment->getAssessment()['teacher_id'];
        $c_teacher = new User($c_t_id);
        $scores = $assessment->getScores();
        //print_r($scores);
    };
}

include("app/parent/assessment.php");

?>