<?php
class Database
{
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct()
    {
        $this->getConfig();
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function getConfig()
    {
        include(__DIR__ . '/../config.php');
        $this->host = $config['host'];
        $this->user = $config['username'];
        $this->password = $config['password'];
        $this->db_name = $config['db_name'];
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    // mengembalikan satu row (associative) — sesuai PDF get() awalnya fetch_assoc
    public function get($table, $where = null)
    {
        if ($where) {
            $where = " WHERE " . $where;
        }
        $sql = "SELECT * FROM " . $table . $where;
        $res = $this->conn->query($sql);
        if ($res && $res->num_rows > 0) {
            return $res->fetch_assoc();
        }
        return null;
    }

    // helper ambil banyak data
    public function getAll($table, $where = null)
    {
        if ($where) $where = " WHERE " . $where;
        $sql = "SELECT * FROM " . $table . $where;
        $res = $this->conn->query($sql);
        $rows = [];
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    public function insert($table, $data)
    {
        if (is_array($data) && count($data) > 0) {
            $column = [];
            $value = [];
            foreach ($data as $key => $val) {
                $column[] = $key;
                $value[] = "'" . $this->conn->real_escape_string($val) . "'";
            }
            $columns = implode(",", $column);
            $values = implode(",", $value);
            $sql = "INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")";
            $res = $this->conn->query($sql);
            return $res ? $this->conn->insert_id : false;
        }
        return false;
    }

    public function update($table, $data, $where)
    {
        if (!is_array($data) || empty($where)) return false;
        $update_value = [];
        foreach ($data as $key => $val) {
            $update_value[] = "$key='" . $this->conn->real_escape_string($val) . "'";
        }
        $update_value = implode(",", $update_value);
        $sql = "UPDATE " . $table . " SET " . $update_value . " WHERE " . $where;
        $res = $this->conn->query($sql);
        return $res ? true : false;
    }

    public function delete($table, $where)
    {
        if (empty($where)) return false;
        $sql = "DELETE FROM " . $table . " WHERE " . $where;
        return $this->conn->query($sql);
    }
}
?>
