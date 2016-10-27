<?php

use yii\helpers\Html;

/* @var $leadDataObj \app\models\LeadEsign */

?>




<table border="1" >
	<tr>
		<td>Customer Name</td>
		<td>Title</td>
		<td><?= $leadDataObj->salutation ?></td>
		<td>Forename</td>
		<td><?= $leadDataObj->firstname ?></td>
		<td>Surname</td>
		<td><?= $leadDataObj->lastname ?></td>
	</tr>
</table>