<?php
	
echo '<div class="button-group right"><a href="'.WEBROOT.$this->getModel().'" class="button big danger">Cancel</a>';
echo '<a href="javascript:document.forms[0].submit();return false" onclick="document.forms[0].submit();return false" class="button big primary">Save</a></div>';
echo '<h1>Create New '.depluralize(capitalize($this->getModel())).'</h1>';

echo '<form action="'.createLinkForModel($this->getModel(), $this->getRecordId()).'" method="post">';

echo '<table class="recordtable">';

foreach ($this->db->getFields($this->getModel()) as $field) {
	if ($field['Field'] != depluralize($this->getModel()).'_id') echo textInput($field['Field'], '');
}

echo '</table>';

echo '</form>';

?>