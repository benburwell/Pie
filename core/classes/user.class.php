<?php

/*

	User class
	-----------

	@file 		user.class.php
	@version 	1.0.0b
	@date 		2012-03-28 13:05:35 -0400 (Wed, 28 Mar 2012)
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

class User {
	
	private $user_id;
	private $username;
	private $ameil;
	private $password;
	private $password_reset_key;
	private $password_reset_expires;
	
	private $groups = array();
	
	private $db;
	
	public function __construct($db, $id, $username="", $password="") {
		
		$this->db = $db;
		
		if ($id===0) {
			if ($this->db->query('SELECT * FROM '.DB_PREFIX.'_users WHERE username="'.$username.'" AND password="'.md5($password).'"') === 1) {
				
				$record = $this->db->nextRecord();
				
				$this->user_id = $record['user_id'];
				$this->username = $record['username'];
				$this->email = $record['email'];
				$this->password = $record['password'];
				$this->password_reset_key = $record['password_reset_key'];
				$this->password_reset_expires = $record['password_reset_expires'];
				
				
				
				return true;
			}
		} else {
			
			$record = $this->db->get('_users', $id);
			
			$this->user_id = $record['user_id'];
			$this->username = $record['username'];
			$this->email = $record['email'];
			$this->password = $record['password'];
			$this->password_reset_key = $record['password_reset_key'];
			$this->password_reset_expires = $record['password_reset_expires'];
			
			return true;
			
		}
		
		return false;
	}
	
	public function getUsername() {
		return $this->username;
	}
	
	public function checkPassword($password) {
		return ($password === $this->password);
	}
	
	public function setPassword($password, $confirm) {
				
		if ($password === $confirm) {
			return $this->db->update('_users', $this->user_id, array('password' => md5($password)));
		}
		
		return false;
		
	}
	
	public function generatePasswordResetKey() {
		
		// generate values
		$key = md5(date('Y i h s l u Z', time()-173183401));
		$expires = date('Y-m-d H:i:s', time()+(60*60*2));
		
		// set object fields
		$this->password_reset_key = $key;
		$this->password_reset_expires = $expires;
		
		$link = ($_SERVER['HTTPS'] != "")? 'https://'.$_SERVER['SERVER_NAME'] : 'http://'.$_SERVER['SERVER_NAME'];
		$link .= WEBROOT.'reset/'.$key;
		
		$body = "Hi ".$this->username.",\n\nA request was received to reset your password on ".SITE."\n\n";
		$body .= "To continue on to choose a new password, go to $link\n\nIf you did not request this password reset, ";
		$body .= "no further action is required. The link will expire in 2 hours. You will still be able to log into ";
		$body .= "your account normally.\n\nSincerely,\nThe ".SITE." Team";
		
		mail($this->email, "Instructions to reset your password on ".SITE, $body, 'From: "'.SITE.' Admin <admin@'.$_SERVER['SEVER_NAME'].'>"');
		
		// update in database
		return $this->db->update('_users', $this->user_id, array('password_reset_key' => $key, 'password_reset_expires' => $expires));
	}
	
	public function resetPassword($key, $password, $confirm) {
		
		if ($key == $this->password_reset_key && strtotime($this->password_reset_date) >= time()) {
			return $this->setPassword($password, $confirm);
		}
		
		return false;
		
	}
	
	public function hasPermission($model, $permission=PERMISSION_READ) {
		$value = 0;
		foreach ($this->groups as $group) {
			$this->db->query('SELECT value FROM '.DB_PREFIX.'_acl WHERE model="'.$model.'" AND group_id="'.$group.'" AND permission='.$permission);
			$record = $this->db->nextRecord();
			$value += $record[0];
		}
		
		return ($value > 0)? true : false;
	}
	
}

?>