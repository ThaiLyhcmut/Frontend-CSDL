<?php
class Database {
    private static $instance = null;
    private $conn;

    // Thông tin kết nối cơ sở dữ liệu
    private $servername;
    private $username;
    private $password;
    private $dbname;

    // Constructor riêng tư để ngăn chặn việc khởi tạo trực tiếp
    private function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        // Tạo kết nối
        try {
            if (!extension_loaded('mysqli')) {
                throw new Exception('The MySQLi extension is not available.');

            }
            $this->conn = new mysqli();
            $this->conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);
            $this->conn->real_connect($this->servername, $this->username, $this->password, $this->dbname);

            if (!$this->conn->set_charset("utf8mb4")) {
                throw new Exception("Không thể thiết lập mã hóa UTF-8: " . $this->conn->error);
            }

        }
        catch (Exception $e) {
            throw new Exception("Không thể kết nối db, " . $e->getMessage());
        }
        // Kiểm tra kết nối
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }

    // Phương thức để lấy thể hiện duy nhất của lớp
    public static function getInstance($servername, $username, $password, $dbname) {
        if (self::$instance === null) {
            self::$instance = new self($servername, $username, $password, $dbname);
        }
        return self::$instance;
    }

    // Phương thức để lấy kết nối
    public function getConnection() {
        return $this->conn;
    }

    // Ngăn chặn việc nhân bản đối tượng
    private function __clone() {}

    // Ngăn chặn việc unserializing đối tượng
    public function __wakeup() {}
}


?>
