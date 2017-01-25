<?php

class agency extends core {

    public function xImport() {

        if (!($mysql = $this->connect())) {
            return false;
        }
        $tables = array('agency', 'agency_network', 'billing', 'users');

        foreach ($tables as $t) {

            $data = file_get_contents('raw_txt/' . $t . '.txt');
            $data = $this->file_to_array($data);

            foreach ($data as $r) {
                $sql = 'insert into ' . $t . "(" . implode(',', array_keys($r)) . ") values ('" . implode("','", $r) . "')";

                $this->run_query($sql);
            }
        }
        $this->redirect('/');
    }

    public function xGetList() {

        $mysql = $this->connect();
        $where = array();
        parse_str($_POST['form_data'], $input_val);

        if ($input_val) {

            $date_from = $input_val['date_from'];
            $date_sql_from = date('Y.m.d', strtotime($date_from));
            $date_to = $input_val['date_to'];
            $date_sql_to = date('Y.m.d', strtotime($date_to));
            $f_date = 'date(b.date)';

            if ($this->e_val($input_val, 'date_from'))
                $where[] = "{$f_date} >= '{$date_sql_from}'";

            if ($this->e_val($input_val, 'date_to'))
                $where[] = "{$f_date} <= '{$date_sql_to}'";

            if ($this->e_val($input_val, 'no_data'))
                $where[] = "b.agency_id is null";

            if ($this->e_val($input_val, 'amount_null'))
                $where[] = "b.amount = '0'";
        }
        $sql = 'select agency_network_name,agency_name,amount,date(date),user_name,b.id as billing_id  from agency a '
                . 'left join agency_network ag on a.agency_network_id=ag.agency_network_id '
                . 'left join billing b on a.agency_id=b.agency_id '
                . 'left join users u on u.user_id=b.user_id '
                . ($where ? 'where ' . (count($where) > 1 ? implode(' and ', $where) : $where[0] ) : '')
                . ' order by a.agency_id';
        $result = $this->run_query($sql, $mysql);


        $this->render('list_agency', array(
            'agency' => $result['data'],
            'input_val' => $input_val,
            'sql' => $sql
        ));
        return;
    }

    public function xAddEdit($id = null) {

        $mysql = $this->connect();
        $sql = 'select *  from agency';
        $agency = $this->run_query($sql, $mysql);

        $sql = 'select *  from users';
        $users = $this->run_query($sql, $mysql);

        if ($id) {
            $sql = "select * from billing where id='{$id}'";
            $billing = $this->run_query($sql, $mysql);
        }
        parse_str($_POST['form_data'], $input_val);

        if ($input_val) {

            if ($id) {

                $sql = 'UPDATE billing SET ';
                $f_update = array();

                foreach ($input_val as $k => $v) {

                    $f_update[] = $k . "='{$v}'";
                }
                $sql.= implode(',', $f_update);
                $sql.=' where id=' . $id;
            } else {

                $sql = 'insert into billing(' . implode(',', array_keys($input_val)) . ") values ('" . implode("','", array_values($input_val)) . "')";
            }
            $users = $this->run_query($sql, $mysql);
        }
        $this->render('add', array(
            'agency' => $agency['data'],
            'users' => $users['data'],
            'billing' => $billing['data'] ? array_shift($billing['data']) : array(),
        ));
    }

    public function xDelete($id) {

        $mysql = $this->connect();

        $sql = 'delete from billing where id=' . $id;
        $this->run_query($sql, $mysql);

        $this->redirect('/');
    }

    public function xFibonachchi() {

        $this->render('tasks/fibonachchi.php', null, true);
    }

    public function xRedCells() {

        $this->render('tasks/redcells.html', null, true);
    }

}

?>