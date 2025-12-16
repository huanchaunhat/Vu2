<?php
// Cấu hình Database thông minh (Tự nhận diện Local hay Cloud)

define('DB_HOST', getenv('DB_HOST') ?: 'mysql-huanchaunhat-test-huanchaunhat-6586.j.aivencloud.com');
define('DB_USER', getenv('DB_USER') ?: 'avnadmin');
define('DB_PASS', getenv('DB_PASS') ?: '');
// QUAN TRỌNG: Tên DB trên Aiven thường là 'defaultdb', hãy kiểm tra lại trong Workbench
define('DB_NAME', getenv('DB_NAME') ?: 'defaultdb'); 
define('DB_PORT', getenv('DB_PORT') ?: '12293');

// Nếu code của bạn dùng PDO, hãy đảm bảo chuỗi kết nối dùng đúng biến trên:
// Ví dụ: $conn = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS);
?>