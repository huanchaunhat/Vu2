<?php
// Bật chế độ soi lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>🕵️ MÁY SCAN HỆ THỐNG VERCEL</h1>";

// 1. Định vị thư mục Controllers
$controllerDir = __DIR__ . '/../app/controllers';

echo "<h3>📂 Đang quét thư mục: <code>app/controllers</code></h3>";

if (is_dir($controllerDir)) {
    $files = scandir($controllerDir);
    
    echo "<ul>";
    foreach ($files as $file) {
        // Bỏ qua thư mục hiện tại (.) và cha (..)
        if ($file === '.' || $file === '..') continue;
        
        // In ra tên file chính xác từng ký tự
        echo "<li>📄 <b>" . $file . "</b>";
        
        // Nếu là thư mục con (ví dụ 'admin') thì soi tiếp bên trong
        if (is_dir($controllerDir . '/' . $file)) {
            echo " ➡️ (Thư mục con)";
            $subFiles = scandir($controllerDir . '/' . $file);
            echo "<ul>";
            foreach ($subFiles as $sub) {
                if ($sub !== '.' && $sub !== '..') {
                     echo "<li>📄 " . $sub . "</li>";
                }
            }
            echo "</ul>";
        }
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "❌ <h3 style='color:red'>LỖI: Không tìm thấy thư mục app/controllers!</h3>";
    echo "Vui lòng kiểm tra lại cấu trúc thư mục code của bạn.";
}

echo "<hr>";
echo "<h3>⚠️ HƯỚNG DẪN ĐỌC KẾT QUẢ:</h3>";
echo "1. Nhìn danh sách trên, tìm xem có file <b>HomeController.php</b> không?<br>";
echo "2. Chú ý kỹ chữ <b>H</b> và chữ <b>C</b>. <br>";
echo "   - Nếu trên đó ghi là <code>homeController.php</code> mà code bạn gọi <code>HomeController</code> => <b>LỖI</b>.<br>";
echo "   - Nếu trên đó ghi là <code>HomeController.php</code> mà code bạn gọi <code>homeController</code> => <b>LỖI</b>.<br>";
echo "3. Tên file trên màn hình này và trong code <code>App.php</code> phải GIỐNG Y HỆT NHAU.";
?>