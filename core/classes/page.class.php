<?php

/*

	Page class
	-----------

	@file 		page.class.php
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

class Page {

	private $title = SITE;
	private $header_file;
	private $content_file;
	private $footer_file;
	private $content_type = "text/html";
	private $http_status = "200";
	
	private $error;
	private $log;
	
	private $db;
	
	private $recordId;
	private $model;
		
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function setTitle($string) {
		$this->title = $string;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setHeaderFile($filename) {
		$this->header_file = $filename;
	}
	
	public function getHeaderFile() {
		return $this->header_file;
	}
	
	public function setContentFile($filename) {
		$this->content_file = $filename;
	}
	
	public function getContentFile() {
		return $this->content_file;
	}
	
	public function setFooterFile($filename) {
		$this->footer_file = $filename;
	}
	
	public function getFooterFile() {
		return $this->footer_file;
	}
	
	public function setError($code) {
		$this->error = $code;
	}
	
	public function getError() {
		return $this->error;
	}
	
	public function setRecordId($id) {
		$this->recordId = $id;
	}
	
	public function getRecordId() {
		return $this->recordId;
	}
	
	public function setModel($model) {
		$this->model = $model;
	}
	
	public function getModel() {
		return $this->model;
	}
	
	function log($message) {
		$this->log .= "\n".$message;
	}
	
	public function write() {
		
		// use error page if indicated
		if (isset($this->error)) $this->setContentFile('_error/record.php');
		
		// set http headers
		header('Content-type: '.$this->content_type);
		http_response_code($this->http_status);
		
		// include content
		require_once($this->header_file);
		echo "\n<!--\n".$this->log."\n-->\n";
		require_once($this->content_file);
		require_once($this->footer_file);
	}

}

?>