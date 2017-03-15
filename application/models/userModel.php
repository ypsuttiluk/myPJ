<?php

class userModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($data) {
        $str = $data['username'];

        if ($str[0] == 't' || $str[0] == 'T') {
            $condition = "ID =" . "'" . $data['username'] . "' AND " . "tPassword =" . "'" . md5($data['password']) . "'";
            $this->db->select('*');
            $this->db->from('teacherdim');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
        } else if ($str[0] == 's' || $str[0] == 'S') {
            $condition = "ID =" . "'" . $data['username'] . "' AND " . "sPassword =" . "'" . md5($data['password']) . "'";
            $this->db->select('*');
            $this->db->from('studentdim');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
        } else {
            return false;
        }
      

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

}
