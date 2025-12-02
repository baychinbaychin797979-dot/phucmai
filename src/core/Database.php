<?php

namespace MT\Core;

/**
 * Database Connection Handler
 */
class Database
{
    protected $connection;
    protected $config;
    
    public function __construct($config)
    {
        $this->config = $config;
        $this->connect();
    }
    
    /**
     * Establish database connection
     */
    private function connect()
    {
        try {
            $dsn = sprintf(
                'mysql:host=%s;port=%d;dbname=%s;charset=%s',
                $this->config['host'],
                $this->config['port'],
                $this->config['database'],
                $this->config['charset']
            );
            
            $this->connection = new \PDO(
                $dsn,
                $this->config['username'],
                $this->config['password'],
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]
            );
        } catch (\PDOException $e) {
            throw new \Exception('Database connection failed: ' . $e->getMessage());
        }
    }
    
    /**
     * Execute a query
     */
    public function query($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    /**
     * Get single row
     */
    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }
    
    /**
     * Get all rows
     */
    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }
    
    /**
     * Insert record
     */
    public function insert($table, $data)
    {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $this->query($sql, array_values($data));
        
        return $this->connection->lastInsertId();
    }
    
    /**
     * Update record
     */
    public function update($table, $data, $where = [])
    {
        $set = implode(', ', array_map(fn($k) => "{$k} = ?", array_keys($data)));
        $whereClause = implode(' AND ', array_map(fn($k) => "{$k} = ?", array_keys($where)));
        
        $sql = "UPDATE {$table} SET {$set}";
        if ($whereClause) {
            $sql .= " WHERE {$whereClause}";
        }
        
        $params = array_merge(array_values($data), array_values($where));
        $this->query($sql, $params);
    }
    
    /**
     * Delete record
     */
    public function delete($table, $where = [])
    {
        $whereClause = implode(' AND ', array_map(fn($k) => "{$k} = ?", array_keys($where)));
        
        $sql = "DELETE FROM {$table}";
        if ($whereClause) {
            $sql .= " WHERE {$whereClause}";
        }
        
        $this->query($sql, array_values($where));
    }
}
