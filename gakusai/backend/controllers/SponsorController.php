<?php

require_once(dirname(__FILE__) . "/../models/Sponsor.php");

class SponsorController extends ControllerBase
{   
    public function helloAction()
    {
        
        $sponsor = new Sponsor();
        
        $ary = $sponsor->getList();
        
        // echo "<pre>";
        // var_dump($ary);
        // echo "</pre>";

        $abcd = $this->json_safe_encode($ary);
        $this->view->assign('sponsor',$abcd);
    }

    public function json_safe_encode($data){
        return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }
}

?>