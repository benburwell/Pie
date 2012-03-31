<?php

if ($record = $this->db->get($this->getModel(), $this->getRecordId())) {
	
	echo '<div class="button-group right"><a href="'.WEBROOT.$this->getModel().'/'.$record[0].'" class="button big danger">Cancel Editing</a>';
	echo '<a href="javascript:document.forms[0].submit();return false" onclick="document.forms[0].submit();return false" class="button big primary">Save</a></div>';
	echo '<h1>Editing '.depluralize(capitalize($this->getModel())).': '.$record[1].'</h1>';
	
	echo '<form action="'.editLinkForModel($this->getModel(), $this->getRecordId()).'" method="post">';
	
	echo '<table class="recordtable">';
	
	$fieldTypes = $this->db->getFieldTypes();
	$flags = $this->db->getFlags();
	
	$i = 1;
	
	foreach ($record as $key => $value) {
		if (!is_numeric($key) && $key != depluralize($this->getModel()).'_id') {
			echo writeRow($key, $value, $fieldTypes[$i], $flags[$i], true);
			$i++;
		}
	}
	
	echo '</table>';
	
	echo '</form>';
	
} else {
	$this->setError(ERROR_NORECORD);
	echo '<p>no record</p>';
}

?>