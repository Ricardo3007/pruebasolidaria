<?php
/**
 * Created by PhpStorm.
 * User: RAFN
 * Date: 2019-01-16
 * Time: 15:20
 */

namespace clases;

date_default_timezone_set("America/Bogota");

class BaseDatos
{
    private $host = 'localhost';
    private $user = 'root';
    // private $pass = 'finsocial123';
    private $pass = '';
    private $bd = 'creditosolidario';
    private $sql = '';
    private $conn;


    private function connect()
    {
        //echo 'hola';
        $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->bd);
        if (mysqli_connect_errno($mysqli)) {
            die('Error de Conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }

        mysqli_set_charset($mysqli, "utf8");
        return $mysqli;
    }

    private function setCon()
    {
        $this->conn = $this->connect();
    }

    public function query($sql)
    {
        $resp = array();

        $this->setCon();

//        ini_set('display_errors',1);
//        error_reporting(E_ALL);
//        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $result = mysqli_query($this->conn, $sql) or
        die('Problemas en consulta.  Error: ' . $sql . " ");

        $this->diconnect();

        if (!is_bool($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $resp[] = $row;
            }
        } else {
            $resp = ["msg" => "err"];
        }

        return $resp;
    }

    private function diconnect()
    {
        mysqli_close($this->conn);
        return true;
    }

    public function insert($table, $column, $value, $user)
    {
        $sql = "INSERT INTO $table ($column) VALUES ($value)";

        //error_log("[QUERY INSERT]" . $sql);

        $this->sql = $sql;
        $this->setCon();

        $rs = mysqli_multi_query($this->conn, $sql) or
        die('Problemas con sentencia.  Error: ' . $sql);

        return $this->logs($table, $column, $value, $user, 'I');

    }

    public function logs($table, $column, $value, $user, $tipo, $valueOld = null)
    {
        $campos = explode(",", $column);
        $valores = explode(",", $value);
        $nCampos = count($campos);
        $pk = mysqli_insert_id($this->conn);
        for ($i = 0; $i < $nCampos; $i++) {
            $cam = trim($campos[$i]);
            $valoresF = str_replace("'", "", $valores[$i]);
            $sql = "INSERT INTO AUDITORIA (TIPO, TABLA, CAMPO, VALORO, VALORN, USUARIO, PK) VALUES
            ('$tipo', '$table', '$cam', '', '$valoresF', '$user', $pk)";
            $this->setCon();
//            $rs = mysqli_multi_query($this->conn, $sql) or
//            die('Problemas con sentencia. ' . $sql . ' Error: ' . mysqli_error($this->conn));
        }
        $this->diconnect();
    }

    public function update($table, $set, $where, $user)
    {
        if (($user != '') || ($user != 0) || ($user != null)) {
            $sets = explode(",", $set);
            // $rLog = $this->logsUp($table, $sets, $where, 'U', $user);
            $sql = "UPDATE $table SET $set WHERE $where";
            $this->setCon();
            $rs = mysqli_multi_query($this->conn, $sql) or
            die('Problemas con sentencia. Error: ' . $sql);
            // echo $rLog;
        } else {
            die("Usuario Necesario");
        }
    }

    private function logsUp($table, $set, $where, $tipo, $user)
    {
        foreach ($set as $s) {
            $sep = explode("=", $s);
            $colum[] = trim($sep[0]);
            $valor[] = trim($sep[1]);
        }
        $nC = implode(",", $colum);
        $trimComa = trim($nC, ',');

        $sqlCon = "SELECT $trimComa,ID FROM $table WHERE $where";
        $res = $this->query($sqlCon);
        $nR = count($res);
        $nC = count($colum);
        for ($i = 0; $i < $nR; $i++) {
            for ($a = 0; $a < $nC; $a++) {
                $valorOld = $res[$i][$colum[$a]];
                $valorNew = trim($valor[$a], "'");
                $idM = $res[$i]['ID'];
                if ($valorNew != $valorOld) {
                    $valoresI = str_replace("'", "", $valorNew);
                    $valoresF = str_replace("'", "", $valorOld);
                    $sql = "INSERT INTO AUDITORIA (TIPO, TABLA, CAMPO, VALORO, VALORN, USUARIO, PK) VALUES
                    ('$tipo', '$table', '$colum[$a]', '$valoresF', '$valoresI', '$user', $idM);";
                    $this->setCon();
                    $rs = mysqli_multi_query($this->conn, $sql) or
                    die('Problemas con sentencia. ' . $sql . ' Error: ' . mysqli_error($this->conn));
                }
            }
        }
    }

    public function loginLogs($userid, $ip)
    {
        $tabla = "login_log";
        $columnas = "id_usuario, ip";
        $valor = "$userid, '$ip'";
        $this->insert($tabla, $columnas, $valor, $userid);
    }

    public function obtenerIP()
    {
        $ip = "";
        if (isset($_SERVER)) {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        } else {
            if (getenv('HTTP_CLIENT_IP')) {
                $ip = getenv('HTTP_CLIENT_IP');
            } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
            } else {
                $ip = getenv('REMOTE_ADDR');
            }
        }
        // En algunos casos muy raros la ip es devuelta repetida dos veces separada por coma
        if (strstr($ip, ',')) {
            $ip = array_shift(explode(',', $ip));
        }
//        return "10.10.1.55";

        return $ip;
    }

    public function obtenerMAC()
    {
        #run the external command, break output into lines
        $arp = exec('arp -a ' . $this->obtenerIP());
        $lines = explode(" at ", $arp);

        $macAddr = trim(explode(" ", $lines[1])[0]);

        if ($macAddr == "") {
            $arp = exec('arp -a ');
            $lines = explode(" at ", $arp);

            $macAddr = trim(explode(" ", $lines[1])[0]);
        }

        return $macAddr;
    }
}
