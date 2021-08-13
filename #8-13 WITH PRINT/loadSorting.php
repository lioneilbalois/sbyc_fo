<!-- for loading the sort controls below the main navbar -->
<?php
    date_default_timezone_set('Asia/Manila');	
    $sel_date = date("Y-m-d");

    $sortWay = $_POST['kind'];

    if ($sortWay == "daily") {
        echo "Date: <input type='text' id='datepicker' onmouseover='datepick_apply();' value=", $sel_date, ">"; 
    } 
    else {
        echo "From: ", '<input type="date" value=', $sel_date, ' id="date_begin" onchange="date_begin_change(', "'false'" ,');">';
        echo "To: ", '<input type="date" id="date_end" onchange="date_begin_change(', "'true'", ');">';
    } 
?>
