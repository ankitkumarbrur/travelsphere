<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'project');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if ($conn === false) {
    die('Error: could not connect to server'.mysqli_connect_error());
} else {
    $sql = 'create database if not exists project';
    mysqli_query($conn, $sql);
    
    mysqli_select_db($conn, "project");
    
    $sql = 'create table if not exists users(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(30) NOT NULL,
                email VARCHAR(30) NOT NULL UNIQUE,
                username VARCHAR(20) NOT NULL UNIQUE,
                password VARCHAR(80) NOT NULL, 
                privileges INT DEFAULT "0",
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP )';  
    mysqli_query($conn, $sql);

    $sql = 'create table if not exists queries(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(30) NOT NULL,
                email VARCHAR(30) NOT NULL UNIQUE,
                message VARCHAR(80) NOT NULL)';
    mysqli_query($conn, $sql);    
    
    $sql = 'create table if not exists offers(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                description varchar(220) NOT NULL,
                price varchar(20) NOT NULL,
                expirydate varchar(20) NOT NULL)';
    mysqli_query($conn, $sql);         

    $sql = 'create table if not exists hotels(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name varchar(20) NOT NULL,
                offer varchar(220) NOT NULL
                )';
    mysqli_query($conn, $sql);    

    $sql = 'create table if not exists packages(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name varchar(20) NOT NULL,
                offer varchar(220) NOT NULL
                )';
    mysqli_query($conn, $sql);         
}
?>
