<?php
class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];
    protected $isAdmin = false;

    public function __construct()
    {
        $url = $this->parseUrl();

        // 1. XỬ LÝ ADMIN ROUTE
        if (isset($url[0]) && $url[0] === 'admin') {
            $this->isAdmin = true;
            array_shift($url);

            $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'DashboardController';
            $targetFile = __DIR__ . '/../controllers/admin/' . $controllerName . '.php';

            if (file_exists($targetFile)) {
                $this->controller = $controllerName;
                array_shift($url);
            } else {
                $this->controller = 'DashboardController';
            }
            
            // Debug Admin
            $adminFile = __DIR__ . '/../controllers/admin/' . $this->controller . '.php';
            if (file_exists($adminFile)) {
                require_once $adminFile;
            } else {
                $this->showError($this->controller, $adminFile);
            }

        } else {
            // 2. XỬ LÝ ROUTE THƯỜNG (CLIENT)
            if (!empty($url[0])) {
                $controllerName = ucfirst($url[0]) . 'Controller';
                // Kiểm tra xem file có tồn tại không trước khi gán
                if (file_exists(__DIR__ . '/../controllers/' . $controllerName . '.php')) {
                    $this->controller = $controllerName;
                    array_shift($url);
                }
            }

            // --- ĐOẠN DEBUG QUAN TRỌNG NHẤT ---
            $targetFile = __DIR__ . '/../controllers/' . $this->controller . '.php';
            
            if (file_exists($targetFile)) {
                require_once $targetFile;
            } else {
                // Nếu không thấy file, in lỗi ra màn hình ngay lập tức
                $this->showError($this->controller, $targetFile);
            }
            // ----------------------------------
        }

        // Khởi tạo Controller
        if (class_exists($this->controller)) {
            $this->controller = new $this->controller;
        } else {
            die("<h3 style='color:red'>Lỗi: Tìm thấy file nhưng không thấy Class tên là '{$this->controller}' bên trong!</h3>");
        }

        // Xử lý Method
        if (!empty($url[0]) && method_exists($this->controller, $url[0])) {
            $this->method = $url[0];
            array_shift($url);
        }

        // Params
        $this->params = $url ? array_values($url) : [];

        // Gọi hàm
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    // Hàm hiển thị lỗi đẹp
    private function showError($controllerName, $path) {
        echo "<div style='background:#333; color:white; padding:20px; font-family:monospace;'>";
        echo "<h2 style='color:red; border-bottom:1px solid red'>❌ LỖI KHÔNG TÌM THẤY FILE CONTROLLER</h2>";
        echo "<p>Code đang cố gắng tìm file: <b style='color:yellow'>{$controllerName}.php</b></p>";
        echo "<p>Tại đường dẫn: <b>{$path}</b></p>";
        echo "<hr>";
        echo "<h3>👉 CÁCH KHẮC PHỤC:</h3>";
        echo "<ul>";
        echo "<li>Kiểm tra lại thư mục <b>app/controllers/</b></li>";
        echo "<li>Xem file của bạn đang tên là <b>{$controllerName}.php</b> hay là <b>" . lcfirst($controllerName) . ".php</b>?</li>";
        echo "<li>Linux bắt buộc chữ Hoa/Thường phải giống y hệt nhau!</li>";
        echo "</ul>";
        echo "</div>";
        die();
    }
}
?>