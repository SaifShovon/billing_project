<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 30-May-18
 * Time: 11:36 AM
 */

class Admin extends CI_Controller
{
    public function __construct() {
        parent::__construct();

        $admin =$this->session->userdata('admin');
        $admin_id = $admin['id'];
        //echo $admin_id ; exit;
        if($admin_id != NULL)
        {
            redirect('Super_admin','refresh');
        }
        //$this->load->model('super_admin_model','sa_model');
    }
    public function index(){
        $this->load->view('admin/admin_login');
    }

    public function check_admin_login(){
        $post = $this->input->post();
        $email = $post['email'];
        $password = md5($post['password']);

        $query_result = $this->db->query("SELECT id, `name`, email FROM admin_info WHERE email = '$email' AND password = '$password'")->row();
        $sdata=array();
        if($query_result)
        {
            $sdata['admin']['id'] = $query_result->id;
            $sdata['admin']['name'] = $query_result->name;
            $sdata['admin']['email'] = $query_result->email;
            $this->session->set_userdata($sdata);
            //echo '<pre>'; print_r($this->session->userdata()); exit;
            redirect('super_admin');
        }
        else{
            $sdata['message']='Your User Id / Password Invalid!';
            $this->session->set_userdata($sdata);
            $this->load->view('admin/admin_login');
        }


    }


}