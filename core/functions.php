<?php

/*

	Site-wide functions
	--------------------

	@file 		functions.php
	@version 	1.0.0b
	@date 		2012-03-29 23:04:16 -0400 (Thu, 29 Mar 2012)
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

function goToReferer() {
	$referer = $_SERVER['HTTP_REFERER'];
	
	if ($referer != "") {
		header("Location: $referer");
	} else {
		header("Location: ".APP_ROOT);
	}
	
	exit();
}

if (!function_exists('http_response_code')) {
	function http_response_code($code) {
			
		switch ($code) {
			case 100: $text = 'Continue'; break;
			case 101: $text = 'Switching Protocols'; break;
			case 200: $text = 'OK'; break;
			case 201: $text = 'Created'; break;
			case 202: $text = 'Accepted'; break;
			case 203: $text = 'Non-Authoritative Information'; break;
			case 204: $text = 'No Content'; break;
			case 205: $text = 'Reset Content'; break;
			case 206: $text = 'Partial Content'; break;
			case 300: $text = 'Multiple Choices'; break;
			case 301: $text = 'Moved Permanently'; break;
			case 302: $text = 'Moved Temporarily'; break;
			case 303: $text = 'See Other'; break;
			case 304: $text = 'Not Modified'; break;
			case 305: $text = 'Use Proxy'; break;
			case 400: $text = 'Bad Request'; break;
			case 401: $text = 'Unauthorized'; break;
			case 402: $text = 'Payment Required'; break;
			case 403: $text = 'Forbidden'; break;
			case 404: $text = 'Not Found'; break;
			case 405: $text = 'Method Not Allowed'; break;
			case 406: $text = 'Not Acceptable'; break;
			case 407: $text = 'Proxy Authentication Required'; break;
			case 408: $text = 'Request Time-out'; break;
			case 409: $text = 'Conflict'; break;
			case 410: $text = 'Gone'; break;
			case 411: $text = 'Length Required'; break;
			case 412: $text = 'Precondition Failed'; break;
			case 413: $text = 'Request Entity Too Large'; break;
			case 414: $text = 'Request-URI Too Large'; break;
			case 415: $text = 'Unsupported Media Type'; break;
			case 500: $text = 'Internal Server Error'; break;
			case 501: $text = 'Not Implemented'; break;
			case 502: $text = 'Bad Gateway'; break;
			case 503: $text = 'Service Unavailable'; break;
			case 504: $text = 'Gateway Time-out'; break;
			case 505: $text = 'HTTP Version not supported'; break;
			default:
				exit('Unknown http status code "' . htmlentities($code) . '"');
				break;
		}
		
		$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
		
		header($protocol . ' ' . $code . ' ' . $text);
	}
}

function depluralize($string) {
	return substr($string, 0, strlen($string)-1);
}

function capitalize($string) {
	$firstletter = strtoupper(substr($string, 0, 1));
	return $firstletter.substr($string, 1);
}

function editLinkForModel($model, $id=true) {
	if ($id===true)
		return (file_exists(ROOT.'action/update_'.$model.'.php'))? WEBROOT.'action/update_'.$model.'.php' : WEBROOT.'action/update.php?_model='.$model;
	else
		return (file_exists(ROOT.'action/update_'.$model.'.php'))? WEBROOT.'action/update_'.$model.'.php?_id='.$id : WEBROOT.'action/update.php?_model='.$model.'&_id='.$id;
}

function deleteLinkForModel($model, $id=true) {
	if ($id===true)
		return (file_exists(ROOT.'action/delete_'.$model.'.php'))? WEBROOT.'action/delete_'.$model.'.php' : WEBROOT.'action/delete.php?_model='.$model;
	else
		return (file_exists(ROOT.'action/delete_'.$model.'.php'))? WEBROOT.'action/delete_'.$model.'.php?_id='.$id : WEBROOT.'action/delete.php?_model='.$model.'&_id='.$id;
}

function createLinkForModel($model) {
	return (file_exists(ROOT.'action/create_'.$model.'.php'))? WEBROOT.'action/create_'.$model.'.php' : WEBROOT.'action/create.php?_model='.$model;
}

function sanitizeModel($model) {
	return capitalize(str_replace("_", "", str_replace("_id", "", $model)));
}

// error definitions
define('ERROR_UNAUTHORIZED', 'unauthorized');
define('ERROR_NOMODEL', 'nomodel');
define('ERROR_NORECORD', 'norecord');
define('ERROR_INTERNAL', 'internal');
define('ERROR_DBERROR', 'db');

// permission definitions
define('PERMISSION_CREATE', 1);
define('PERMISSION_READ', 2);
define('PERMISSION_UPDATE', 3);
define('PERMISSION_DELETE', 4);


function writeRow($name, $value, $type, $flags, $edit=false) {
	
	global $db;
	
	if (preg_match('/_id/', $name)) {
		$table = substr($name, 0, strlen($name)-3).'s';
		$field = $name;
		$name = substr($name, 0, strlen($name)-3);
		$record = $db->query("SELECT * FROM ".DB_PREFIX.$table);
		$options = array();
		while ($record = $db->nextRecord()) {
			$options[$record[0]] = $record[1];
		}
		$type=1000;
	}
	
	
	echo '<tr><th';
	echo ($flags & 1 && $edit)? ' class="required"' : '';
	echo '><label for="input_'.$name.'">'.capitalize($name).'</label></td><td>';
	
	if ($edit) {
		if ($type==1) { // checkbox
			if ($value != 0) {
				echo '<input type="hidden" name="'.$name.'" value="0" />';
			}
			echo '<input type="checkbox" name="'.$name.'" value="1" id="input_'.$name.'"';
			echo ($value==1)? ' checked="checked"' : '';
			echo ' />';
		} else if ($type==252) { // text area
			echo '<textarea name="'.$name.'">'.$value.'</textarea>';
		} else if ($type==1000) { // model
			echo '<select name="'.$field.'">';
			foreach ($options as $k => $v) {
				echo '<option value="'.$k.'"';
				echo ($k==$value)? ' selected="selected"' : '';
				echo '>'.$v.'</option>';
			}
		} else {
			echo '<input type="text" name="'.$name.'" value="'.$value.'" id="input_'.$name.'" />';
		}
	} else {
		if ($type==1) {
			echo ($value==1)? 'Yes' : 'No';
		} else if ($type==1000) {
			echo $options[$value];
		} else {
			echo $value;
		}
	}
	
	echo '</td>';	
	echo '</tr>';
	
}

?>