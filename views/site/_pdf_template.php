<?php
/**
 * @var $newLeadForm app\models\NewLeadForm
 * @var $this yii\web\View
 */

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<style>
    body {
        
    }
    table {
        background: black;
        border: 0.1px solid white;
    }
    table tr td{
        background: white;
        padding: 10px;
        border: 0.1px solid white;
    }
</style>
<div style="float:left; width: 50%">
	<h4>Mis-sold Packaged Bank Account Claim Pack</h4>
	<h4>Please check and sign where highlighted</h4>
</div>
<div style="float:left; width: 50%;text-align: right">
	<h1>[LOGO]</h1>
</div>
<table border="1" width="100%">
	<tr>
	    <td>Customer Name(s)</td>
	    <td>Title</td>
	    <td>Firstname</td>
	    <td>Lastname</td>
	</tr>
	<tr>
	    <td width="230px"></td>
	    <td><?= $newLeadForm->salutation ?></td>
	    <td><?= $newLeadForm->firstname ?></td>
	    <td><?= $newLeadForm->lastname ?></td>
	</tr>
</table>
<br>
<br>
<br>
<br>
<center>
	<img src="<?php echo $publishedSignatureImage ?>" alt="" width="330">
	<h3 style="padding-left: 20px;">Customer Signature</h3>
</center>

</body>
</html>