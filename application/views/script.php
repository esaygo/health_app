<?php
  if(isset($this->session->userdata['login_info']['id']) && $this->session->userdata['login_info']['id'] != null){
    $interests = $this->session->userdata['interest_info'];
    $temp = [];

    for($i=0; $i<count($interests); $i++){
      $temp[] = $interests[$i]['type'];
    }

    echo json_encode($temp);
  }
  else{
    return false;
  }
?>
