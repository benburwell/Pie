<?php
	
echo '<div class="button-group right"><a href="'.WEBROOT.$this->getModel().'" class="button big danger">Cancel</a>';
echo '<a href="javascript:document.forms[0].submit();return false" onclick="document.forms[0].submit();return false" class="button big primary">Save</a></div>';
echo '<h1>Create New '.depluralize(capitalize($this->getModel())).'</h1>';

echo '<form action="'.createLinkForModel($this->getModel(), $this->getRecordId()).'" method="post">';

echo '<table class="recordtable">';

$fieldTypes = $this->db->getFieldTypes($this->getModel());
$flags = $this->db->getFlags($this->getModel());

$i = 1;

foreach ($this->db->getFields($this->getModel()) as $field) {
	if ($field['Field'] != depluralize($this->getModel()).'_id') {
		echo writeRow($field['Field'], '', $fieldTypes[$i], $flags[$i], true);
		$i++;
	}
}

echo '</table>';

echo '</form>';

?>