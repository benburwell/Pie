<?php

/*

	Session class
	--------------

	@file 		session.class.php
	@version 	1.0.0b
	@date 		2012-03-30 19:15:47 -0400 (Fri, 30 Mar 2012)
	@author 	Ben Burwell <bburwell1@gmail.com>

	Copyright (c) 2012 Ben Burwell <http://www.benburwell.com/>

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

class Session {
	
	private $db;
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function loggedIn() {
		return isset($_SESSION['user']);
	}
	
	public function getUserName() {
		return $_SESSION['user']->getUserName();
	}
	
	public function flash($message) {
		$_SESSION['messages'][] = $message;
	}
	
	public function getMessages($delete=truee) {
		$messages = $_SESSION['messages'];
		
		if ($delete) $_SESSION['messages'] = array();
		
		return $messages;
	}
	
	public function login($username, $password) {
		return $_SESSION['user'] = new User($this->db, 0, $username, $password);
	}
	
	public function logout() {
		$_SESSION['user'] = null;
	}
	
}

?>