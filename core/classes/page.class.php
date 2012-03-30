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

	private $title;
	private $header_file;
	private $content_file;
	private $footer_file;
	private $content_type = "text/html";
	private $http_status = "200";
	
	public function __construct() {
		
	}
	
	public function setTitle($string) {
		$this->title = $string;
	}
	
	public function setHeaderFile($filename) {
		$this->header_file = $filename;
	}
	
	public function setContentFile($filename) {
		$this->content_file = $filename;
	}
	
	public function setFooterFile($filename) {
		$this->footer_file = $filename;
	}
	
	public function write() {
		header('Content-type: '.$this->content_type);
		http_response_code($this->http_status);
		require_once($this->header_file);
		require_once($this->content_file);
		require_once($this->footer_file);
	}

}

?>