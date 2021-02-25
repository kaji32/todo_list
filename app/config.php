<?php

session_start();

$db = new PDO("sqlite:todo.db");

require_once(__DIR__.'/functions.php');
