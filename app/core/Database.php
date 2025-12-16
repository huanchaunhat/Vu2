<?php
class Database {
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $port;
    private $dbh; // Database Handler
    private $error;

    public function __construct() {
        // Lấy thông tin từ biến môi trường (Vercel/Render), nếu không có thì lấy mặc định (Localhost)
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->user = getenv('DB_USER') ?: 'root';
        $this->pass = getenv('DB_PASS') ?: '';
        $this->dbname = getenv('DB_NAME') ?: 'acen_center';
        $this->port = getenv('DB_PORT') ?: '3306';

        // Cấu hình DSN (Data Source Name)
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname . ';charset=utf8mb4';
        
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Tạo kết nối PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo "Lỗi kết nối Database: " . $this->error;
            die(); // Dừng chương trình nếu không kết nối được
        }
    }

    // Hàm trả về kết nối để Model sử dụng
    public function getConnect() {
        return $this->dbh;
    }
}
?>