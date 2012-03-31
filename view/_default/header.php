<?php

################################################################################
##                                                                            ##
##  Copyright 2012 Ben Burwell                                                ##
##                                                                            ##
##  Licensed under the Apache License, Version 2.0 (the "License");           ##
##  you may not use this file except in compliance with the License.          ##
##  You may obtain a copy of the License at                                   ##
##                                                                            ##
##  http://www.apache.org/licenses/LICENSE-2.0                                ##
##                                                                            ##
##  Unless required by applicable law or agreed to in writing, software       ##
##  distributed under the License is distributed on an "AS IS" BASIS,         ##
##  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.  ##
##  See the License for the specific language governing permissions and       ##
##  limitations under the License.                                            ##
##                                                                            ##
################################################################################

?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->title; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo WEBROOT; ?>static/css/site.css" media="all" />
		<link rel="stylesheet" type="text/css" href="<?php echo WEBROOT; ?>static/css/gh-buttons.css" media="all" />
		<script type="text/javascript" src="<?php echo WEBROOT; ?>static/js/site.js"></script>
	</head>
	<body>
		<nav id="account">
			<?php if (true/*$this->session->loggedIn()*/): ?>
				<a href="<?php echo WEBROOT; ?>logout">Logout</a>
			<?php else: ?>
				<a href="<?php echo WEBROOT; ?>login">Logout</a>
			<?php endif; ?>
		</nav>
		<div id="main">
			<header>
				<h1><a href="<?php echo WEBROOT; ?>"><?php echo SITE; ?></a></h1>
				<nav>
						<?php
						
						$models = $this->db->getModels();
						
						if (count($models) > 0) {
							
							echo '<ul>';
							
							foreach ($models as $model) {
								$active = ($this->getModel() == $model)? ' class="active"' : '';
								echo '<li><a href="'.WEBROOT.$model.'"'.$active.'>'.capitalize($model).'</a></li>';
							}
							
							echo '</ul>';
						}
						
						?>
				</nav>
			</header>
			<article>