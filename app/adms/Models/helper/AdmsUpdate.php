<?php

namespace App\adms\Models\helper;

/**
 * Description of AdmsUpdate
 *
 * @author Gabriel Matheus
 */
class AdmsUpdate extends AdmsConn
{

    private string $table;
    private string $termos;
    private array $data;
    private array $values = [];
    private string $result;
    private object $update;
    private $query;
    private object $conn;
    
    function getResult(): string {
        return $this->result;
    }
    
    public function exeUpdate($table, array $data, $termos = null, $parseString = null): void {
        $this->table = (string) $table;
        $this->data = $data;
        
        $this->termos = (string) $termos;
        
        parse_str($parseString, $this->values);
        
        $this->exeReplaceValues();
        $this->exeIntruction();
    }
    
    private function exeReplaceValues() {
        foreach ($this->data as $key => $value) {
            $values[] = $key . '=:' . $key;
        }
        $values = implode(', ', $values);
        
        $this->query = "UPDATE {$this->table} SET {$values} {$this->termos}";
    }
    
    private function exeIntruction() {
        $this->connection();
        try {
            $this->update->execute(array_merge($this->data, $this->values));
            $this->result = true;
        } catch (Exception $ex) {
            $this->result = null;
        }
    }
    
    private function connection() {
        $this->conn = $this->connect();
        $this->update = $this->conn->prepare($this->query);
    }

    
}
