<?php
require_once(dirname(__FILE__) . '/ServerError.class.php');
class Database {
    private static $instance=null;
    private static $pdoObject=null;
    function __construct() {
        try {
            self::$pdoObject =
                new PDO('mysql:host=database;dbname=database', 'root', 'root');
            self::$pdoObject->
                setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            self::handlePDOException($e);
        }
    }
    public static function getInstance(): Database {
        if(self::$instance == null)
            self::$instance = new Database();
        return self::$instance;
    }
    public function getPDO(): PDO {
        return self::$pdoObject;
    }

    public static function prepare(string $stmt): PDOStatement {
        try {
            return Database::getInstance()->getPDO()->prepare($stmt);
        } catch (PDOException $e) {
            self::handlePDOException($e);
        }
    }
    public static function execute(PDOStatement $statement): bool {
        try {
            return $statement->execute();
        } catch (PDOException $e) {
            self::handlePDOException($e);
        }
    }
    public static function bindParam(
        PDOStatement $stmt,
        string|int $para,
        mixed &$var): bool {
        try {
            return $stmt->bindParam($para, $var);
        } catch (PDOException $e) {
            self::handlePDOException($e);
        }
    }

    private static function handlePDOException(PDOException $e) {
        $error = "Application DB Error:" . $e->getMessage();
        ServerError::ThrowError(500, $error);
    }
}
?>
