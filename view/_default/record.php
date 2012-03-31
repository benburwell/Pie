<?php

if ($record = $this->db->get($this->getModel(), $this->getRecordId())) {
	
	echo '<div class="button-group right">';
	echo '<a href="'.WEBROOT.$this->getModel().'" class="button big">&laquo; '.capitalize($this->getModel()).'</a>';
	echo '<a href="'.WEBROOT.$this->getModel().'/'.$record[0].'/edit" class="button big primary">Edit</a>';
	echo '</div>';
	echo '<h1>'.depluralize(capitalize($this->getModel())).': '.$record[1].'</h1>';
	
	echo '<table class="recordtable">';
	
	$fieldTypes = $this->db->getFieldTypes();
	$flags = $this->db->getFlags();
	
	$i = 1;
	
	foreach ($record as $key => $value) {
		if (!is_numeric($key) && $key != depluralize($this->getModel()).'_id') {
			
			echo writeRow($key, $value, $fieldTypes[$i], $flags[$i]);
			echo '<!-- '.$flags[$i].'-->';
			
			$i++;
		}
	}
	
	echo '</table>';
	
} else {
	$this->setError(ERROR_NORECORD);
	echo '<p>no record</p>';
}

?>