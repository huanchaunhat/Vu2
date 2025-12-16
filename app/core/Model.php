<?php
// Nạp file Database vào để sử dụng
require_once __DIR__ . '/Database.php';

class Model {
    protected $db;

    public function __construct() {
        // KHÔNG DÙNG getPDO() NỮA (VÌ HÀM NÀY KHÔNG TỒN TẠI)
        // Thay bằng cách khởi tạo Class Database mới
        $database = new Database();
        
        // Lấy kết nối PDO gán vào biến $this->db
        $this->db = $database->getConnect();
    }
}
?>