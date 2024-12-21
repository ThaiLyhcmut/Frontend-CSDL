<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/envLoaderService.php';
class Model {
    protected $db;

    public function __construct() {
        envLoaderService::loadEnv();
        $DB_HOST = envLoaderService::getEnv("DB_HOST");
        $DB_NAME = envLoaderService::getEnv("DB_NAME");
        $DB_USER = envLoaderService::getEnv("DB_USER");
        $DB_PASS = envLoaderService::getEnv("DB_PASS");
        $this->db = Database::getInstance($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    }
}
