<?php
// Bật chế độ "Nói nhiều" - Có gì báo nấy
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<div style='background:black; color:#0f0; padding:20px; font-family:monospace; z-index:9999; position:relative;'>";
echo "<h1>🚩 TRẠM KIỂM SOÁT SỐ 1</h1>";

// 1. Kiểm tra thư mục
echo "👉 Đang đứng tại: " . __DIR__ . "<br>";
chdir(__DIR__ . '/../public');
echo "👉 Đã nhảy sang: " . getcwd() . "<br>";

// 2. Giả lập Router (.htaccess)
$request_uri = $_SERVER['REQUEST_URI'];
if (strpos($request_uri, '?') !== false) $request_uri = substr($request_uri, 0, strpos($request_uri, '?'));
$url = trim($request_uri, '/');
$_GET['url'] = $url;
echo "👉 URL giả lập: <b>" . ($url ?: 'HOMEPAGE') . "</b><br>";

// 3. Gọi file index.php của public
echo "⏳ Chuẩn bị gọi public/index.php...<br>";

if (file_exists('index.php')) {
    require 'index.php';
    echo "<br>✅ ĐÃ CHẠY XONG public/index.php (Nếu bên dưới trắng trơn là do View rỗng)<br>";
} else {
    echo "❌ LỖI CHẾT NGƯỜI: Không tìm thấy file index.php trong thư mục public!<br>";
}

echo "</div>";
?>