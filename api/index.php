<?php
// 1. Bật hiển thị lỗi NGAY TỪ ĐẦU
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Định nghĩa đường dẫn file cần gọi
$appFile = __DIR__ . '/../public/index.php';

// 3. Kiểm tra và gọi file
if (file_exists($appFile)) {
    require $appFile;
} else {
    // Nếu sai đường dẫn thì báo ngay
    http_response_code(500);
    echo "<h1>LỖI: Không tìm thấy file public/index.php</h1>";
    echo "<p>Đường dẫn hiện tại: " . __DIR__ . "</p>";
    echo "<p>Đang tìm tại: " . $appFile . "</p>";
}