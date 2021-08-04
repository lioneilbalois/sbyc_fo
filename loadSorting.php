<?php
    $sortWay = $_POST['kind'];

    if ($sortWay == "daily") {
        echo "Date: <input type='text' id='datepicker1'>"; 
    } 
    elseif ($sortWay == "weeklyDef") {
        echo "From: ", '<input type="date" value="<?php echo $sel_date; ?>" id="date_begin">';
        echo "To: ", '<input type="date" id="date_end" disabled>';
    } 
    else {
        echo "From: ", '<input type="date" value="<?php echo $sel_date; ?>" id="date_begin">';
        echo "To: ", '<input type="date" id="date_end">';
    }
?>