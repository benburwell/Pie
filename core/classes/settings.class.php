<?php

/*

	Site Settings Class
	--------------------

	@file 		settings.class.php
	@version 	1.0.0b
	@date 		2012-03-28 12:41:33 -0400 (Wed, 28 Mar 2012)
	@author 	Ben Burwell <bburwell1@gmail.com>

*/

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

class Settings {
	
	private static $settings = array();
	
	public function __construct() {
		$this->set('db.host', 'localhost');
		$this->set('db.user', 'username');
		$this->set('db.pass', 'password');
		$this->set('db.name', 'dbname');
		
		$this->set('page.title', 'Application');
		$this->set('page.title.pre', 'Application - ');
		$this->set('page.title.post', '');
		$this->set('page.title.prefixIfNull', false);
		$this->set('page.title.postfixIfNull', false);
		
	}
	
	public function get($key) {
		if (in_array($key, $this->settings)) {
			return $this->settings[$key];
		} else {
			return false;
		}
	}
	
	public function set($key, $value) {
		$this->settings[$key] = $value;
	}
	
}

?>