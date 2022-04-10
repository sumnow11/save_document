<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_models');
        $this->load->model('category_models');
        $this->load->model('doc_models');
    }

    public function index()
    {
        $data['site_url']=site_url();
        if($this->session->userdata('user_id')!=null){
        $check['check']=$this->users_models->check_status($this->session->userdata('user_id'));
        if ($check['check']->delete_user_data == '0') {
            if ($this->session->userdata('role') == '0') {
                redirect("admin");
            } elseif ($this->session->userdata('role') == '1') {
                $r = $this->users_models->show_user_id($this->session->userdata('user_id'));
        
                if($r->password==''){
                    $this->load->view('Template/together/login_css');
                    $this->load->view('Template/together/pin',$data);
                    
                }else if($r->password!=''){
                    redirect("user");
                }
            } else {
                $this->session->unset_userdata(array('user_id', 'position_id', 'role', 'user_d'));
                $this->load->view('Template/together/login_css');
                $this->load->view('Template/together/login',$data);
                $this->load->view('Template/together/loginjs');
            }
        } else {
            $this->session->unset_userdata(array('user_id', 'position_id', 'role', 'user_d'));
            $this->load->view('Template/together/login_css');
            $this->load->view('Template/together/login',$data);
            $this->load->view('Template/together/loginjs');
        }
        }else {
            $this->session->unset_userdata(array('user_id', 'position_id', 'role', 'user_d'));
            $this->load->view('Template/together/login_css');
            $this->load->view('Template/together/login',$data);
            $this->load->view('Template/together/loginjs');
        }
    }
    public function process()
    {
        $result = $this->users_models->login($this->input->post('email'));
        //print_r($result);
        if (!empty($result)) {
            if($result->delete_user_data==0){
            $s_user = array(
                'user_id' => $result->user_id,
                'position_id' => $result->position_id,
                'role' => $result->role,
                'user_d' => $result->delete_user_data
            );
            $this->session->set_userdata($s_user);
            echo 'login_success';
            // print_r($_SESSION);
            //redirect("login");
        }else{
            $this->session->unset_userdata(array('user_id', 'position_id', 'role', 'user_d'));
            redirect("login");
        }
        } else {
            $this->session->unset_userdata(array('user_id', 'position_id', 'role', 'user_d'));
            redirect("login");
        }
    }
    public function logout()
    {
        $this->session->unset_userdata(array('user_id', 'position_id', 'role', 'user_d'));
        $this->session->sess_destroy();
        //print_r($this->session->userdata());
        redirect("login");
      
    }
}
