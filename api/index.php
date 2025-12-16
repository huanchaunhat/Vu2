<?php
// 1. Bật hiện lỗi tối đa
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<div style='background: #f0f0f0; padding: 10px; border-bottom: 2px solid red;'>";
echo "<h3>🔍 TRẠM KIỂM SOÁT DEBUG</h3>";

// 2. Kiểm tra biến môi trường (Database)
$host = getenv('DB_HOST');
if ($host) {
    echo "✅ Biến môi trường Vercel: <b>ĐÃ NHẬN</b> (Host: $host)<br>";
} else {
    echo "❌ Biến môi trường Vercel: <b>KHÔNG TÌM THẤY</b> (Hãy kiểm tra lại Settings trên Vercel)<br>";
}

// 3. Kiểm tra file public/index.php
$appFile = __DIR__ . '/../public/index.php';
echo "Checking path: $appFile<br>";

if (file_exists($appFile)) {
    echo "✅ Tìm thấy file public/index.php. Bắt đầu nạp...<br>";
    echo "</div>"; // Đóng khung debug
    
    // --- NẠP FILE CHÍNH ---
    require $appFile;
    // ----------------------
    
} else {
    echo "❌ <b>LỖI CHẾT NGƯỜI:</b> Không tìm thấy file public/index.php<br>";
    die();
}
?>