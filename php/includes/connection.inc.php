<?php

require(__DIR__ . '/../vendor/autoload.php');

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$servername = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'localhost';
$username = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'root';
$password = $_ENV['DB_PASS'] ?? getenv('DB_PASS') ?? '';
$database = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'dduserdb';

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) die('Database connection error: ' . mysqli_connect_error());
