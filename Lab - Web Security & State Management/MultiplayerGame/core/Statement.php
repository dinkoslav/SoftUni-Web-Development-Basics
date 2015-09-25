<?php
namespace Core;

class Statement 
{
    /**
     *
     * @var \PDOStatement
     */
    private $stmt;
    
    public function __construct(\PDOStatement $stmt) 
    {
        $this->stmt = $stmt;
    }
    
    public function fetch($fetchStyle = \PDO::FETCH_ASSOC) 
    {
        return $this->stmt->fetch($fetchStyle);
    }
    
    public function fetchAll($fetchStyle = \PDO::FETCH_ASSOC) 
    {
        return $this->stmt->fetchAll($fetchStyle);
    }
    
    public function bindParams($parameter, $variable, $dataType = \PDO::PARAM_STR, $length = null, $driverOptions = null) 
    {
        return $this->stmt->bindParam($parameter, $variable, $dataType, $length, $driverOptions);
    }
    
    public function execute(array $params = []) 
    {
        return $this->stmt->execute($params);
    }
    
    public function rowCount() 
    {
        return $this->stmt->rowCount();
    }
}
