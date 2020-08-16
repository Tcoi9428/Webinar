<?php

namespace App\Db;
class MySql
{
    private $host;
    private $user;
    private $password;
    private $db_name;
    private $connect;


    public function __construct(string $host , string $user , string $password , string $db_name)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db_name = $db_name;
    }

    private function connect()
    {
        if(!$this->connect){
            $this->connect = mysqli_connect($this->host , $this->user , $this->password , $this-> db_name);
            mysqli_set_charset($this->connect, 'utf8');
            $mysql_error = mysqli_connect_errno();
            if ($mysql_error > 0) {
                $message = "Mysql connect error: $mysql_error ";
                die($message);
            }
        }
        return $this->connect;
    }

    public function query($query)
    {
        $result = mysqli_query($this->connect(), $query);
        $this->checkErrors();
        return $result;
    }
    public function  fetchAll($query, string $class_name)
    {
        $result = $this->query($query);
        $data = [];
        while($row = mysqli_fetch_object($result, $class_name)) {
            $data[] = $row;
        }
        return $data;
    }
    public function fetchRow($query, string $class_name)
    {
        $result = $this->query($query);
        return mysqli_fetch_object($result, $class_name);
    }
    public function insert( string $table_name , array $values)
    {
        $table_name = $this->escape($table_name);

        $values  = $values;
        $insert_fields = [];
        $insert_values = [];
        foreach ($values as $key=> $value) {
            $insert_fields[] = $this->escape($key);
            $insert_values[] = "'$value'";
        }
        $insert_fields = implode(',' , $insert_fields);
        $insert_values = implode(',' , $insert_values);
        $query = "INSERT INTO $table_name($insert_fields) VALUES ($insert_values)";
        $this->query($query);
        return mysqli_insert_id($this->connect());
    }
    public  function update(string $table_name , array $values , string $where)
    {
        $table_name = $table_name;
        $values = $values;
        $where = $where;
        $insert_values = [];
        foreach ($values as $key=> $value){
            $insert_values[] = "$key"."=" ."'$value'";
        }
        $insert_values = implode(',',$insert_values);
        $query = "UPDATE $table_name SET $insert_values WHERE $where";
        return $this->query($query);
    }
    public function deleteItem(string $table_name , string $where)
    {
        if ($where){
            $query = "DELETE FROM $table_name WHERE $where";
        }
        return $this->query($query);
    }

    private function checkErrors()
    {
        $mysqli_errno = mysqli_errno($this->connect());
        if (!$mysqli_errno) {
            return true;
        }
        $mysqli_error = mysqli_error($this->connect());
        $message = "Mysql query error: ($mysqli_errno) $mysqli_error";
        die($message);
    }
    public function escape(string $value)
    {
        return mysqli_real_escape_string($this->connect(), $value);
    }
}