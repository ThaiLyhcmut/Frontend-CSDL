<?php
// app/core/App.php

class App {
    protected $controller = 'HomeController'; // Controller mặc định
    protected $method = 'index'; // Phương thức mặc định
    protected $params = []; // Tham số

    public function __construct() {
        // Phân tích URL
        $url = $this->parseUrl();

        // Kiểm tra controller
        if (!empty($url) && isset($url[0]) && file_exists('controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        echo "$this->controller\n";
        // Khởi tạo controller
        require_once 'controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Kiểm tra method
        if (!empty($url) && isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Lấy tham số còn lại
        $this->params = !empty($url) ? array_values($url) : [];
    }

    public function run() {
        // Gọi phương thức và truyền tham số
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return []; // Trả về mảng rỗng nếu không có URL
    }
}

