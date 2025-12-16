<?php
// 1. Bật hiện lỗi để lỡ có gì còn biết
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. GIẢ LẬP MÔI TRƯỜNG (Fix lỗi trắng trang)
// Chuyển thư mục làm việc về public (để code tìm thấy view, model...)
chdir(__DIR__ . '/../public');

// Tự động tạo biến $_GET['url'] từ đường dẫn thực tế
// Vì Vercel không tự làm việc này như .htaccess
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME']; // Thường là /api/index.php

// Lọc bỏ phần query string (?id=1...)
if (strpos($request_uri, '?') !== false) {
    $request_uri = substr($request_uri, 0, strpos($request_uri, '?'));
}

// Xử lý đường dẫn thừa để lấy đúng cái MVC cần
// Ví dụ: /home/index -> home/index
$url = trim($request_uri, '/');
$_GET['url'] = $url;

// 3. Gọi file index chính
require 'index.php';