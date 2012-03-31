<?php

/*

	Database class
	---------------

	@file 		database.class.php
	@version 	1.0.0b
	@date 		2012-03-28 12:55:52 -0400 (Wed, 28 Mar 2012)
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

class Database {
	
	// database link
	private $dbc;
	
	// result of last query
	private $result;
	
	// connection variables
	private $host;
	private $user;
	private $pass;
	private $name; // database name
	private $prefix; // table prefix
	
	private $queryCount = 0;
	
	// Constructor
	// Gets database settings and makes connection
	public function __construct() {
		
		// access database config variables
		require_once(ROOT.'core/db.php');
		
		// set fields
		$this->host = DB_HOST;
		$this->user = DB_USER;
		$this->pass = DB_PASS;
		$this->name = DB_NAME;
		$this->prefix = DB_PREFIX;
		
		// connect to MySQL
		$this->connect();
	}
	
	// Query
	// Querys the database
	// Returns the number of rows in the result
	public function query($query) {
		$this->result = @ mysqli_query($this->dbc, $query);
		$this->queryCount++;
		return @ mysqli_num_rows($this->result);
	}
	
	// Get QueryCount
	// Returns the number of querys that have been executed
	public function getQueryCount() {
		return $this->queryCount;
	}
	
	// Delete
	// Deletes record with id $id from model $model
	// Returns result
	public function delete($model, $id) {
	
		// ensure params are OK
		if (!is_numeric($id) || !$this->modelExists($model)) return false;
		
		return $this->query("DELETE FROM ".$this->prefix.$model." WHERE ".depluralize($model)."_id=".$id." LIMIT 1");
	}
	
	// Create
	// Creates a record of type $model using $params
	public function create($model, $params) {
		
		// ensure model exists
		if (!$this->modelExists($model)) return false;
		
		// begin query string
		$q = "INSERT INTO ".$this->prefix.$model." (";
		
		// counter variables for correct comma placement
		$i = 0;
		$num = count($params);
		
		// create the set of field names
		foreach ($params as $key => $value) {
			
			$q .= $key;
			
			// add a comma if not the last element
			if ($i < $num) $q .= ', ';
			
			// increment
			$i++;
		}
		
		// reset counter as we will use it again
		$i = 0;
		
		// end fields, begin the values
		$q .= ") VALUES (";
		
		// create the set of values
		foreach ($params as $key => $value) {
			
			$q .= "'".$this->escape($value)."'";
			
			// add comma if not the last element
			if ($i < $num) $q .= ", ";
			
			// increment counter
			$i++;
		}
		
		// finally run the query
		return $this->query($q);
		
	}
	
	// Get
	// Gets record $id of type $model
	// Returns an array of the values
	public function get($model, $id=true) {
		// ensure id is a number
		if (is_numeric($id)) {
			$this->query("SELECT * FROM ".$this->prefix.$model." WHERE ".depluralize($model)."_id=".$id." LIMIT 1");
			return $this->nextRecord();
		} else if ($id === true) {
			return $this->query("SELECT * FROM ".$this->prefix.$model);
		}
		return false;
	}
	
	// Update
	// Updates the values of $id of type $model to have the values of $params
	public function update($model, $id, $params) {
		
		// ensure id is numeric
		if (!is_numeric($id)) return false;
		
		// begin query string
		$q = "UPDATE ".$this->prefix.$model." SET ";
		
		// initialize counter vars
		$i = 0;
		$num = count($params);
		
		// list updated vars
		foreach ($params as $key => $value) {
			$q .= $key."='".$this->escape($value)."'";
			
			// add a comma if not the last element
			if ($i < $num) $q .= ", ";
			$i++;
		}
		
		// finish query string
		$q .= " WHERE ".$model."_id=".$id." LIMIT 1";
		
		// finally run the query
		return $this->query($q);
		
	}
	
	// ModelExists
	// Returns the boolean value of whether $model exists
	public function modelExists($model) {
		return ($this->query("SHOW TABLES IN ".$this->name." WHERE Tables_in_".$this->name."='".$this->prefix.$this->escape($model)."'") == 1)? true : false;
	}
	
	// NextRecord
	// Returns an array of key/value pairs for the subsequent record in $this->result
	// Returns false if no more records
	public function nextRecord() {
		@ $record = mysqli_fetch_array($this->result);
		
		if (is_array($record)) {
			return $record;
		} else {
			return false;
		}
	}
	
	// Connect
	// Connects to the database
	public function connect() {
		$this->dbc = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
	}
	
	// Disconnect
	// Closes the connection to the database
	public function disconnect() {
		mysqli_close($this->dbc);
	}
	
	// Escape
	// Escapes data in keeping with the charset of the database
	// Returns the escaped value of $string
	public function escape($string) {
		return mysqli_real_escape_string($this->dbc, $string);
	}
	
	// GetModels
	// Returns an array of models in the database
	public function getModels() {
		
		// get table list
		$this->query("SHOW TABLES IN ".$this->name);
		
		$models = array();
		
		while ($record = $this->nextRecord()) {
			if (substr($record[0], 0, strlen($this->prefix))==$this->prefix && substr($record[0], strlen($this->prefix), 1) != "_") {
				$models[] = substr($record[0], strlen($this->prefix));
			}
		}
		
		return $models;
	}
	
}

?>