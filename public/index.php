<?php
// public/index.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // dùng session lưu thông tin đăng nhập

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/core/App.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';

// Chạy ứng dụng
$app = new App();
