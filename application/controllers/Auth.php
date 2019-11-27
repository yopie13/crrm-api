<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller{

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    

    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
        $result = $this->db->get('db_users');

        if($result->num_rows() > 0)
        {
            //bikin response k mobile
            $data['pesan'] = "login berhasil";
            $data['sukses']  = true;
            $data['data'] = $result->row();
        }else{
            $data['pesan'] = "email atau password salah";
            $data['sukses']  = false;
        }
      
      echo json_encode($data);
    }

    public function register()
    {
        $nik = $this->input->post('nik');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $name_user = $this->input->post('name_user');
        $initial_name = $this->input->post('initial_name');
        $id_role = $this->input->post('id_role');
        $id_company = $this->input->post('id_company');
        $id_area = $this->input->post('id_area');
        $id_user_spv = $this->input->post('id_user_spv');
        $phone = $this->input->post('phone');
        $mobile_phone = $this->input->post('mobile_phone');
        $mobile_phone = $this->input->post('mobile_phone');

        $this->db->where('email',$email);
        $result = $this->db->get('db_users');

        if($result->num_rows() > 0)
        {
            $data["sukses"] = false ;
            $data["pesan"] = "Email Already Registered !";
        }else{

            $value = array(
                'nik' => $nik,
                'email' => $email,
                'password' => $password,
                'name_user' => $name_user,
                'initial_name' => $initial_name,
                'id_role' => $id_role,
                'id_company' => $id_company,
                'id_area' => $id_area,
                'id_user_spv' => $id_user_spv,
                'phone' => $phone,
                'mobile_phone' => $mobile_phone
            );

            $status = $this->db->insert('db_users',$value);

            $data = array();

            if($status)
            {
                $data["sukses"] = true ;
                $data["pesan"] = "register berhasil";

            }else{
                $data["sukses"] = false ;
                $data["pesan"] = "register failed,try again";
            }

           echo json_encode($data);

        }

        

    }


}