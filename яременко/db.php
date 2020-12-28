<?php
    session_start();
    $mysqli = new mysqli("localhost", "root", "", "crud_app") or die("Connection failed: " .$mysqli->error);