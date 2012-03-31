<?php

if ($record = $this->db->get($this->getModel(), $this->getRecordId())) {
	
	echo '<div class="button-group right">';
	echo '<a href="'.WEBROOT.$this->getModel().'" class="button big">&laquo; '.capitalize($this->getModel()).'</a>';
	echo '<a href="'.WEBROOT.$this->getModel().'/'.$record[0].'/edit" class="button big primary">Edit</a>';
	echo '</div>';
	echo '<h1><a href="'.WEBROOT.$this->getModel().'">'.capitalize($this->getModel()).'</a> &mdash; '.$record[1].'</h1>';
	
	echo '<table class="recordtable">';
	
	foreach ($record as $key => $value) {
		if (!is_numeric($key) && $key != depluralize($this->getModel()).'_id') {
			echo '<tr>';
			echo '<th>'.capitalize($key).'</th>';
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