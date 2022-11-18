<?php
    class DBQuerys {
        private $_db;
        public function __construct() {
            include '../../DB/DBConnection.php';
            $this->_db = DbHandler();
        }

        public function crearRegistro($table, $columns, $values) {
            $query = $this->_db->prepare("INSERT INTO $table(`".str_replace(" , ", " ", implode("`, `", $columns))."`) VALUES('".str_replace(" , ", " ", implode("', '", $values))."');");
            $query->execute(array());
            $response = $query->fetchAll();
        }

        public function editarRegistro($table, $columns, $values, $indexColumn, $index) {
            $update = array();
            foreach ($columns as $key => $column) {
                $update[] = "`" . $column . "`='" . $values[$key] . "'";
            }
            $query = $this->_db->prepare("UPDATE $table SET ".str_replace(" , ", " ", implode(", ", $update))." WHERE $indexColumn = $index;");
            $query->execute(array());
            $response = $query->fetchAll();
        }

        public function estadoRegistro($table, $indexColumn, $index, $status) {
            $query = $this->_db->prepare("UPDATE $table SET Estado = '$status', Editado = '" . date('Y-m-d H:i:s') . "' WHERE $indexColumn = $index;");
            $query->execute(array());
            $response = $query->fetchAll();
        }

        public function select($table, $indexColumn, $columns, $where) {
            if ($where == 'Estado = 0') {
                $status = '1';
            } else {
                $status = 'Estado = 1';
            }
            $query = $this->_db->prepare("SELECT `".str_replace(" , ", " ", implode("`, `", $columns))."` FROM $table WHERE $status" . ($where != '' ? " AND $where" : "") . ";");
            $query->execute(array());
            $response = $query->fetchAll();
            return $response;
        }

        public function count($table, $indexColumn, $where, $status) {
            $query = $this->_db->prepare("SELECT COUNT($indexColumn) FROM $table " . ($status != "" ? "WHERE Estado = $status" : "") . ($where != '' ? " AND $where" : "") . ";");
            $query->execute(array());
            $response = $query->fetchAll();
            return $response;
        }

        public function promedioRespuesta($table, $columnInicio, $columnFinal, $as) {
            $query = $this->_db->prepare("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND, $columnInicio, $columnFinal)) AS $as FROM $table;");
            $query->execute(array());
            $response = $query->fetchAll();
            $unix = array();
            for ($c = 0; $c < count($response); $c++) {
                $unix[] = strtotime('1970-01-02 ' . $response[$c]['Diferencia']);
            }
            $total = array_sum($unix);
            return date('H:i:s', $total / count($response));
        }

        public function verificarExistenciaRegistro($table, $indexColumn, $column, $value, $where, $as) {
            $query = $this->_db->prepare("SELECT COUNT($indexColumn) AS 'count', $indexColumn FROM $table WHERE $column = '$value' " . ($where != '' ? " AND $where" : "") . ";");
            $query->execute(array());
            $response = $query->fetchAll();
            return $response;
        }
    }
?>