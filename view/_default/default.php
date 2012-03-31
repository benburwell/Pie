<a href="<?php echo WEBROOT.$this->getModel(); ?>/create" class="button big primary right">New <?php echo capitalize(depluralize($this->getModel())); ?></a>
<h1><?php echo capitalize($this->getModel()); ?></h1>
<table class="linktable">
<?php

if ($this->db->get($this->getModel()) > 0) {
	while ($record = $this->db->nextRecord()) {
		echo '<tr>';
		
		echo '<td>'.$record[1].'</td>';

		echo '<td class="actions"><div class="button-group">';
		echo '<a href="#" class="button danger" onclick="verifyUrl(\''.deleteLinkForModel($this->getModel()).'&_id='.$record[0].'\');">Delete</a> ';
		echo '<a href="'.WEBROOT.$this->getModel().'/'.$record[0].'" class="button primary">View</a></div></td>';
		
		echo '</tr>';
	}
}

?>
</table>