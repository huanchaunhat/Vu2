<?php
// 1. Bật hiện lỗi để lỡ có gì còn biết
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. GIẢ LẬP MÔI TRƯỜNG (Fix lỗi trắng trang)
// Chuyển thư mục làm việc về public (để code tìm thấy view, model...)
// Dòng này cực quan trọng vì Vercel đang đứng ở thư mục /api
chdir(__DIR__ . '/../public');

// 3. XỬ LÝ ROUTER THỦ CÔNG (Thay thế .htaccess)
// Tự động lấy đường dẫn trên thanh địa chỉ
$request_uri = $_SERVER['REQUEST_URI'];

// Lọc bỏ phần query string (?id=1...) nếu có
if (strpos($request_uri, '?') !== false) {
    $request_uri = substr($request_uri, 0, strpos($request_uri, '?'));
}

// Xử lý đường dẫn thừa để lấy đúng cái MVC cần
// Ví dụ: /home/index -> home/index
$url = trim($request_uri, '/');

// Nạp vào biến $_GET để App.php đọc được
$_GET['url'] = $url;

// 4. Gọi file index chính để chạy App
require 'index.php';