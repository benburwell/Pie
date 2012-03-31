<?php

if ($record = $this->db->get($this->getModel(), $this->getRecordId())) {
	
	echo '<div class="button-group right"><a href="'.WEBROOT.$this->getModel().'/'.$record[0].'" class="button big danger">Cancel Editing</a>';
	echo '<a href="javascript:document.forms[0].submit();return false" onclick="document.forms[0].submit();return false" class="button big primary">Save</a></div>';
	echo '<h1><a href="'.WEBROOT.$this->getModel().'">'.capitalize($this->getModel()).'</a> &mdash; '.$record[1].'</h1>';
	
	echo '<form action="'.editLinkForModel($this->getModel(), $this->getRecordId()).'" method="post">';
	
	echo '<table class="recordtable">';
	
	foreach ($record as $key => $value) {
		if (!is_numeric($key) && $key != depluralize($this->getModel()).'_id') {
			echo textInput($key, $value);
		}
	}
	
	?>
	<!--<tr>
		<th class="required"><label for="box">Field</label></th>
		<td><input type="checkbox" name="box" value="1" id="box" /></td>
	</tr>-->
	<?php
	
	echo '</table>';
	
	echo '</form>';
	
} else {
	$this->setError(ERROR_NORECORD);
	echo '<p>no record</p>';
}

?>