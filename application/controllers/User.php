<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user()
    {
        
       $hasil = $this->db->get("db_users");
      
       // cek kondisi ada datanya apa gak
       if ($hasil -> num_rows() > 0) {
        // Bikin respones k emobile
        $data["pesan"] = "datanya ada";
        $data["sukses"] = true;
        $data['data'] = $hasil->result();
       }
       else{
        $data["pesan"] = "datanya gak ada bang";
        $data["sukses"] = false;
       }

     echo json_encode($data);
    }
    
}