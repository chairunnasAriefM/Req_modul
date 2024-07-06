<?php

class CountStaffModel extends Model
{
    public function get_count_pending_modul(){
        $result = $this->db->select('COUNT(*) as count_pending_modul')
                           ->from('modul') 
                           ->where('status', 'pending')
                           ->get()
                           ->row_array();
        return $result['count_pending_modul'];               
    }

    public function get_count_proses_modul(){
        $result = $this->db->select('COUNT(*) as count_proses_modul')
                           ->from('modul')
                           ->where('status', 'proses eksekusi')
                           ->get()
                           ->row_array();
        return $result['count_proses_modul'];               
    }

    public function get_count_pending_buku(){
        $result = $this->db->select('COUNT(*) as count_pending_buku')
                           ->from('buku')
                           ->where('status', 'pending')
                           ->get()
                           ->row_array();
        return $result['count_pending_buku'];               
    }

    public function get_count_proses_buku(){
        $result = $this->db->select('COUNT(*) as count_proses_buku')
                           ->from('buku')
                           ->where('status', 'proses eksekusi')
                           ->get()
                           ->row_array();
        return $result['count_proses_buku'];               
    }
}
