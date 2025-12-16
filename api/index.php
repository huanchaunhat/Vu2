<?php
// Bật hiện lỗi tối đa
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<div style='background:#222; color:#0f0; padding:20px; font-family:monospace;'>";
echo "--- BẮT ĐẦU DEBUG TẠI API ---<br>";

// 1. Giả lập môi trường
chdir(__DIR__ . '/../public');
echo "✅ Đã chuyển thư mục làm việc về: " . getcwd() . "<br>";

// 2. Xử lý URL
$request_uri = $_SERVER['REQUEST_URI'];
if (strpos($request_uri, '?') !== false) $request_uri = substr($request_uri, 0, strpos($request_uri, '?'));
$url = trim($request_uri, '/');
$_GET['url'] = $url;

echo "✅ URL nhận được: <b>" . ($url ?: '(Trang chủ)') . "</b><br>";

// 3. Gọi file index chính
echo "⏳ Đang gọi public/index.php...<br>";

if (file_exists('index.php')) {
    require 'index.php';
    echo "<br>✅ Đã chạy xong public/index.php (Nếu web trắng thì do View rỗng)<br>";
} else {
    echo "❌ LỖI: Không tìm thấy file public/index.php<br>";
}

echo "--- KẾT THÚC DEBUG ---</div>";
?>