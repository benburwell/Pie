<?php

if ($record = $this->db->get($this->getModel(), $this->getRecordId())) {
	
	echo '<table>';
	
	foreach ($record as $key => $value) {
		if (!is_numeric($key) && $key != depluralize($this->getModel()).'_id') {
			echo '<tr>';
			echo '<td>'.capitalize($key).'</td>';
			echo '<td>'.$value.'</td>';
			echo '</tr>';
		}
	}
	
	echo '</table>';
	
} else {
	$this->setError(ERROR_NORECORD);
	echo '<p>no record</p>';
}

?>