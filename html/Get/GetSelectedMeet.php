<?php
session_start();
$meetID = $_SESSION["meet_id"];
$meet = array
    (
           'showMeet' => $meetID
          
     );
     echo json_encode($meet);
     
     ?>