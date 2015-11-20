<?php
    require_once("../../includes/functions.inc");

    if($sch_name = Tools::valuePost('sch_name') AND $sch_phone = Tools::valuePost('sch_phone') AND $current_session = Tools::valuePost('current_session')
        AND $current_term = Tools::valuePost('current_term') AND $owner = Tools::valuePost('owner') AND $owner_rank = Tools::valuePost('owner_rank')
        AND $assistant = Tools::valuePost('assistant') AND $assistant_rank = Tools::valuePost('assistant_rank') AND $location = Tools::valuePost('location')
    ){
        $school->setSchoolInfo($sch_name, $sch_phone, $current_session, $current_term, $owner, $owner_rank, $assistant, $assistant_rank, $location);
    	Tools::redirect("../../school_data.php?status=1");
    }else{
    	Tools::redirect("../../school_data.php?status=2");
    }
?>