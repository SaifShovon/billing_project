<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 30-May-18
 * Time: 3:21 PM
 */

class Super_admin extends CI_Controller
{

    public function __construct() {
        parent::__construct();

        $admin =$this->session->userdata('admin');
        $admin_id = $admin['id'];
        //echo $admin_id ; exit;
        if($admin_id == NULL)
        {
            redirect('Admin_login','refresh');
        }
        //$this->load->model('super_admin_model','sa_model');
    }
    
    public function index(){
        $data = array();
        $data['maincontent'] = $this->load->view('admin/home', $data, true);
        $this->load->view('admin/master',$data);
    }
    public function logout(){
        $this->session->unset_userdata('admin');
        $sdata = array();
        $sdata['message']='Sign Out Done';
            $this->session->set_userdata($sdata);
             redirect('Admin','refresh');
    }
}