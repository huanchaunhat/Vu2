<?php
// Bật hiện lỗi NGAY TỪ CỔNG VÀO (để bắt lỗi cú pháp của file khác)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kiểm tra xem file có tồn tại không trước khi gọi
$file = __DIR__ . '/../public/index.php';

if (file_exists($file)) {
    require $file;
} else {
    echo "LỖI: Không tìm thấy file public/index.php tại đường dẫn: " . $file;
}