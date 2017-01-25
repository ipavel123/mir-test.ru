<?php

class core {

    public $uri;
    public $uri_params;
    public $uri_action;

    public function connect() {

        $mysql = new mysqli("localhost", "root", "", "mir");

        if ($mysql->connect_errno) {
            return false;
        }
        return $mysql;
    }

    public function isAjax() {

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            return true;
        }
    }

    public function route($uri) {

        $uri = trim($uri);
        $uri = mb_substr($uri, 1);

        if (!$uri) {
            return;
        }

        $uri = urldecode($uri);
        $this->uri = $uri;

        // разбиваем URL на сегменты
        $segments = explode('/', $uri);

        if (isset($segments[0])) {
            $this->uri_action = $segments[0];
        }

        // Определяем параметры действия из всех остальных сегментов
        if (sizeof($segments) > 1) {
            $this->uri_params = array_slice($segments, 1);
        }
    }

    public function e_val($data, $n) {

        if (isset($data[$n]) && $data[$n] != '') {
            return true;
        } else {
            return false;
        }
    }

    public function run_query($sql, $mysql = null) {

        $result = array();

        if (empty($mysql)) {

            $mysql = $this->connect();
        }

        if (!($query = $mysql->query($sql))) {
            echo $query->error;
        }
        if ($query->num_rows) {

            while ($row = $query->fetch_assoc()) {

                $result[] = $row;
            }
        }
        return array('data' => $result, 'r' => $query);
    }

    public function getFieldsName($result) {

        $fields = array();

        foreach ($result->fetch_fields() as $f) {

            if (!in_array($f->name, $fields))
                $fields[] = $f->name;
        }

        return $fields;
    }

    public function redirect($url) {
        header('Location: ' . $url);
        die();
    }

    public function file_to_array($str) {

        $res = array();

        $rows = explode("\n", $str);
        $fields = array_shift($rows);
        $fields = explode("\t", $fields);

        foreach ($rows as $k => $r) {

            $rows_raw = explode("\t", $r);

            foreach ($rows_raw as $kr => $rr) {

                $res[$k][$fields[trim($kr)]] = trim($rr);
            }
        }
        return $res;
    }

    public function string_to_camel($delimiter, $string) {

        $result = '';
        $words = explode($delimiter, mb_strtolower($string));

        foreach ($words as $word) {
            $result .= ucfirst($word);
        }

        return $result;
    }

    public function render($tml, $data = null, $is_directly = false) {

        ob_start();

        extract($data ? : array());
        include(!$is_directly ? '/templates/' . $tml . '.php' : $tml);
        $html = ob_get_clean();

        if (!$this->isAjax() && !$is_directly) {

            ob_start();
            include('/templates/main.php');
            $main = ob_get_clean();
        } else {
            $main = $html;
        }
        echo $main;
    }

}

?>