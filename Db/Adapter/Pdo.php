<?php
class Chco_Db_Adapter_Pdo extends Chco_Db_Abstract
{

    protected function connect()
    {
         $this->connection = new PDO(
                $this->options['dsn'],
                $this->options['username'],
                $this->options['password'],
                $this->options['options']
         );
    }

    
    public function isConnected()
    {
        return ((bool) ($this->connection instanceof PDO));
    }

    public function query($sql)
    {
        $rowSet = array();
        foreach($this->getConnection()->query($sql) as $row)
        {
            $rowSet[] = $row;
        }
        return $rowSet;
    }
    
    public function insert(array $row, $table)
    {
        $columns = array_keys($row);
        foreach ($row as &$value) {
            $value = '\'' . $value . '\'';
        }
        $sql = 'INSERT into ' . $table
                . ' '
                . '('
                . implode(',', $columns)
                . ') '
                . 'VALUES (' . implode(',', $row)
                . ');';
        return $this->getConnection()->exec($sql);
    }
    
    public function update(array $row, $where, $table)
    {
        $values = array();
        foreach ($row as $key => $value) {
            $values[] = $key . '=\'' . $value . '\'';
            $valuesb[] = $key;
            $values2[] = ':' . $key;
//            $this->getConnection()->bindParam(':' . $key, $$key);
            $$key = $value;
            echo '<br />';
            var_dump($$key);
        }
//        foreach ($row as $key => $value) {
//            $values2[] = ':' . $key;
//            $stmt->bindParam(':' . $key, $value);
//        }
        $valuesString  = implode(',', $values);
        $valuesStringb  = implode(',', $valuesb);
        $valuesString2 = implode(',', $values2);
        $sql = 'UPDATE ' . $table
                . ' SET ' . $valuesString
                . ' WHERE ' . $where
                . ';';
        $sqlTest = 'INSERT INTO REGISTRY ('
//                        . $valuesString
                        . implode(',', $valuesb)
                        . ') VALUES ('
                        . implode(',', $values2)
                        . ')';
        echo $sql;
        try {
            $this->getConnection()->exec($sql);
//            $this->getConnection()->beginTransaction();
//            $this->getConnection()->prepare(
//                            $sqlTest
//                        );
//            $this->getConnection()->execute();
//            $this->getConnection()->commit();
            echo '<br />OOOKKKK';
        } catch (Exception $e) {
            $this->getConnection()->rollBack();
            echo 'et merde... ' . $e->getMessage();
        }
    }
    
    public function delete($where, $table)
    {
        $sql = 'DELETE FROM ' . $table
                . ' ' . 'WHERE ' . $where
                . ';';
        return $this->getConnection()->exec($sql);
    }
}
