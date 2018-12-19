


<?php
header("Access-Control-Allow-Origin: *");
require 'dbOptions.php';


        $conn = new DB;
        
        $db = $conn->openDp();

        $sqlQuery = 'select av1, av2, av3, av4, av5 from history01 where reporttimeunix = 1531888125
        
        UNION
        
        select av1, av2, av3, av4, av5 from history01 where reporttimeunix = 1531888142
        
        UNION
        
        select av1, av2, av3, av4, av5 from history01 where reporttimeunix = 1531888154';

        $query = mysqli_query($db, $sqlQuery);
        
        $temp = array();
        
        while($test = mysqli_fetch_assoc($query))
        {
            $temp[] = $test;
        }
       // header('Content-Type: application/json');
        echo json_encode($temp);
        
?>