<!-- load for summary table -->
<?php 
    include("../php/functions.php");
?>

<tr>
    <td><h6>Cash Transaction (CA)</h6></td>
    <td><?php summary('cash_trans'); ?></td>
</tr>
<tr>
    <td><h6>Depslip Transaction (DPSLP)</h6></td>
    <td><?php summary('depslip_trans'); ?></td>
</tr>
<tr>
    <td><h6>Check Transaction (CK)</h6></td>
    <td><?php summary('check_trans'); ?></td>
</tr>
<tr>
    <td><h6>Credit Card Transaction (CC)</h6></td>
    <td><?php summary('credit_trans'); ?></td>
</tr>
<tr>
    <td><h6>Provisional Receipt (PR)</h6></td>
    <td><?php summary('pr_trans'); ?></td>
</tr>
<tr>
    <td><h6>Send Bill</h6></td>
    <td><?php summary('bill_trans'); ?></td>
</tr>
<tr>
    <td><h6>TOTAL TRANSACTIONS</h6></td>
    <td><?php sum_all(); ?></td>
</tr>