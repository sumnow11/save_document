<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_information extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->model('users_models');
        $check['check'] = $this->users_models->check_status($this->session->userdata('user_id'));
        if ($this->session->userdata('role') != '0') {
            if ($this->session->userdata('role') != '1') {
                redirect("login");
            } else {
                if ($check['check']->delete_user_data != '0') {
                    redirect("login");
                }
            }
        } else {
            if ($check['check']->delete_user_data != '0') {
                redirect("login");
            }
        }
    }
    public function table_user()
    {

        $draw = intval($this->input->get("draw"));



        $user = $this->users_models->show_user();
        $position = $this->users_models->show_position();
        $data = array();



        if ($this->session->userdata('user_d') == '0') {
            if ($this->session->userdata('role') == '0') {
                if($this->input->post('position_id')==""){
                foreach ($user->result() as $r) { 
                    $array_p_id = explode(',', $r->position_id);
                    foreach ($array_p_id as $ur) {
                        foreach ($position as $p) {
                            if ($ur == $p->position_id) {
                                $position_r[] = $p->position_name;
                            }
                        }
                    }
                    array_unique($position_r);
                    $position_id_r = implode(',', $position_r);
                    unset($position_r);
                    if ($r->delete_user_data == 0) {

                        $sub_array = array();

                        if ($r->img != '') {
                            $sub_array[]  =  '<img class="fillwidth " style="width:50px; height: 50px; border-radius: 50px;" src="' . base_url("data_doc/img_user/$r->img") . '">';
                        } else {
                            $sub_array[]  =  '<img class="fillwidth " style="width:50px; height: 50px; border-radius: 50px;" src="' . base_url("data_doc/img_user/user.png") . '">';
                        }
                        $sub_array[]  = '<a style="color:#000000;" href="' . site_url("admin/profile/") . $r->user_id . '">' . $r->fname . " " . $r->lname . '</a>';
                        $sub_array[]  =  $r->email;
                        $sub_array[]  =  $r->phone;
                        $sub_array[]  =  $position_id_r;
                        $sub_array[]  =  $r->u_time;
                        if ($r->role == 0) {
                            $sub_array[]  =  '<span class="badge bg-dark corners shadow">ผู้ดูแลระบบ </span>';
                        } elseif ($r->role == 1) {
                            $sub_array[]  =  '<span class="badge bg-success corners shadow"> สมาชิก </span>';
                        }
                        if ($this->session->userdata('user_id') == $r->user_id) {
                            $sub_array[] = ' <a  type="button" class="btn btn-warning corners shadow d-none d-md-table-cell" href="' . site_url("admin/page_edit_user/") . $r->user_id . '" style="font-size: 15px;"><i class="fas fa-edit"></i></a>';
                        } else {
                            $sub_array[] = ' <a  type="button" class="btn btn-warning corners shadow d-none d-md-table-cell" href="' . site_url("admin/page_edit_user/") . $r->user_id . '" style="font-size: 15px;"><i class="fas fa-edit"></i></a>
                                <a type="button" class="btn btn-danger corners shadow" onclick="delete_user(' . $r->user_id . ')" style="font-size: 15px;"><i class="fas fa-ban"></i></a>';
                        }
                    } else {
                        $sub_array = array();

                        if ($r->img != '') {
                            $sub_array[]  =  '<img class="fillwidth " style="width:50px; height: 50px; border-radius: 50px;" src="' . base_url("data_doc/img_user/$r->img") . '">';
                        } else {
                            $sub_array[]  =  '<img class="fillwidth " style="width:50px; height: 50px; border-radius: 50px;" src="' . base_url("data_doc/img_user/user.png") . '">';
                        }
                        $sub_array[]  = '<a style="color:#FF0000;" href="' . site_url("admin/profile/") . $r->user_id . '">' . $r->fname . " " . $r->lname . '</a>';
                        $sub_array[]  =  '<a style="color:#FF0000;">' . $r->email . '</a>';
                        $sub_array[]  =  '<a style="color:#FF0000;">' . $r->phone . '</a>';
                        $sub_array[]  =  '<a style="color:#FF0000;">' . $position_id_r . '</a>';
                        $sub_array[]  =  '<a style="color:#FF0000;">' . $r->u_time . '</a>';
                        if ($r->role == 0) {
                            $sub_array[]  =  '<span class="badge bg-danger corners shadow">ผู้ดูแลระบบ </span>';
                        } elseif ($r->role == 1) {
                            $sub_array[]  =  '<span class="badge bg-danger corners shadow"> สมาชิก </span>';
                        }
                        if ($this->session->userdata('user_id') == $r->user_id) {
                            $sub_array[] = ' <a  type="button" class="btn btn-warning corners shadow d-none d-md-table-cell" href="' . site_url("admin/page_edit_user/") . $r->user_id . '" style="font-size: 15px;"><i class="fas fa-edit"></i></a>';
                        } else {
                            $sub_array[] = ' <a type="button" class="btn btn-warning corners shadow" onclick="recovery_user(' . $r->user_id . ')" style="font-size :15px;"><i class="fas fa-sync-alt"></i></a>';
                        }
                    }
                    $data[] = $sub_array;
                }
            }else{
                foreach ($user->result() as $r) { 
                    $array_p_id = explode(',', $r->position_id);
                    foreach ($array_p_id as $ur) {
                    if($ur==$this->input->post('position_id')){
                    foreach ($array_p_id as $ur2) {
                        foreach ($position as $p) {
                            if ($ur2 == $p->position_id) {
                                $position_r[] = $p->position_name;
                            }
                        }
                    }
                    array_unique($position_r);
                    $position_id_r = implode(',', $position_r);
                    unset($position_r);
                    if ($r->delete_user_data == 0) {

                        $sub_array = array();

                        if ($r->img != '') {
                            $sub_array[]  =  '<img class="fillwidth " style="width:50px; height: 50px; border-radius: 50px;" src="' . base_url("data_doc/img_user/$r->img") . '">';
                        } else {
                            $sub_array[]  =  '<img class="fillwidth " style="width:50px; height: 50px; border-radius: 50px;" src="' . base_url("data_doc/img_user/user.png") . '">';
                        }
                        $sub_array[]  = '<a style="color:#000000;" href="' . site_url("admin/profile/") . $r->user_id . '">' . $r->fname . " " . $r->lname . '</a>';
                        $sub_array[]  =  $r->email;
                        $sub_array[]  =  $r->phone;
                        $sub_array[]  =  $position_id_r;
                        $sub_array[]  =  $r->u_time;
                        if ($r->role == 0) {
                            $sub_array[]  =  '<span class="badge bg-dark corners shadow">ผู้ดูแลระบบ </span>';
                        } elseif ($r->role == 1) {
                            $sub_array[]  =  '<span class="badge bg-success corners shadow"> สมาชิก </span>';
                        }
                        if ($this->session->userdata('user_id') == $r->user_id) {
                            $sub_array[] = ' <a  type="button" class="btn btn-warning corners shadow d-none d-md-table-cell" href="' . site_url("admin/page_edit_user/") . $r->user_id . '" style="font-size: 15px;"><i class="fas fa-edit"></i></a>';
                        } else {
                            $sub_array[] = ' <a  type="button" class="btn btn-warning corners shadow d-none d-md-table-cell" href="' . site_url("admin/page_edit_user/") . $r->user_id . '" style="font-size: 15px;"><i class="fas fa-edit"></i></a>
                                <a type="button" class="btn btn-danger corners shadow" onclick="delete_user(' . $r->user_id . ')" style="font-size: 15px;"><i class="fas fa-ban"></i></a>';
                        }
                    } else {
                        $sub_array = array();

                        if ($r->img != '') {
                            $sub_array[]  =  '<img class="fillwidth " style="width:50px; height: 50px; border-radius: 50px;" src="' . base_url("data_doc/img_user/$r->img") . '">';
                        } else {
                            $sub_array[]  =  '<img class="fillwidth " style="width:50px; height: 50px; border-radius: 50px;" src="' . base_url("data_doc/img_user/user.png") . '">';
                        }
                        $sub_array[]  = '<a style="color:#FF0000;" href="' . site_url("admin/profile/") . $r->user_id . '">' . $r->fname . " " . $r->lname . '</a>';
                        $sub_array[]  =  '<a style="color:#FF0000;">' . $r->email . '</a>';
                        $sub_array[]  =  '<a style="color:#FF0000;">' . $r->phone . '</a>';
                        $sub_array[]  =  '<a style="color:#FF0000;">' . $position_id_r . '</a>';
                        $sub_array[]  =  '<a style="color:#FF0000;">' . $r->u_time . '</a>';
                        if ($r->role == 0) {
                            $sub_array[]  =  '<span class="badge bg-danger corners shadow">ผู้ดูแลระบบ </span>';
                        } elseif ($r->role == 1) {
                            $sub_array[]  =  '<span class="badge bg-danger corners shadow"> สมาชิก </span>';
                        }
                        if ($this->session->userdata('user_id') == $r->user_id) {
                            $sub_array[] = ' <a  type="button" class="btn btn-warning corners shadow d-none d-md-table-cell" href="' . site_url("admin/page_edit_user/") . $r->user_id . '" style="font-size: 15px;"><i class="fas fa-edit"></i></a>';
                        } else {
                            $sub_array[] = ' <a type="button" class="btn btn-warning corners shadow" onclick="recovery_user(' . $r->user_id . ')" style="font-size :15px;"><i class="fas fa-sync-alt"></i></a>';
                        }
                    }
                    $data[] = $sub_array;
                }
            }
            }
            }
            } else {
                redirect("login");
            }


            $output = array(
                "draw" => $draw,
                "recordsTotal" => $user->num_rows(),
                "recordsFiltered" => $user->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect("login");
        }
    }

    public function delete_table_user()
    {
        //Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $user = $this->users_models->show_user("");
        $data = array();



        if ($this->session->userdata('user_d') == '0') {
            if ($this->session->userdata('role') == '0') {
                foreach ($user->result() as $r) {
                    if ($r->delete_user_data == 1) {
                        $sub_array = array();

                        if ($r->img != '') {
                            $sub_array[]  =  '<img class="fillwidth " style="width:50px; height: 50px; border-radius: 50px;" src="' . base_url("data_doc/img_user/$r->img") . '">';
                        } else {
                            $sub_array[]  =  '<img class="fillwidth " style="width:50px; height: 50px; border-radius: 50px;" src="' . base_url("data_doc/img_user/user.png") . '">';
                        }
                        $sub_array[]  = '<a href="' . site_url("admin/profile/") . $r->user_id . '">' . $r->fname . " " . $r->lname . '</a>';
                        $sub_array[]  =  $r->email;
                        $sub_array[]  =  $r->phone;
                        $sub_array[]  =  $r->position_name;
                        $sub_array[]  =  $r->u_time;
                        if ($r->role == 0) {
                            $sub_array[]  =  '<span class="badge bg-dark corners shadow">ผู้ดูแลระบบ </span>';
                        } elseif ($r->role == 1) {
                            $sub_array[]  =  '<span class="badge bg-success corners shadow"> สมาชิก </span>';
                        }
                        $sub_array[] = '  <a type="button" class="btn btn-warning corners shadow" onclick="recovery_user(' . $r->user_id . ')" style="font-size :15px;"><i class="fas fa-sync-alt"></i></a>
                        <a type="button" class="btn btn-danger corners shadow "  onclick="delete_user_p(' . $r->user_id . ')" style="font-size :15px;"><i class="fas fa-trash "></i></a>';

                        $data[] = $sub_array;
                    }
                }
            } else {
                redirect("login");
            }


            $output = array(
                "draw" => $draw,
                "recordsTotal" => $user->num_rows(),
                "recordsFiltered" => $user->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect("login");
        }
    }
    public function email_check()
    {
        $this->users_models->email_check();
    }

    public function add_user()
    {

        $this->users_models->add_user();
    }
    public function edit_user()
    {


        $this->users_models->edit_user();
        redirect('', 'refresh');
    }

    public function delete_user()
    {
        $this->users_models->delete_user($this->input->post('user_id'));
    }

    public function user_recovery()
    {
        $this->users_models->user_recovery($this->input->post('user_id'));
    }

    public function delete_user_permanent()
    {
        $this->users_models->delete_user_permanent($this->input->post('user_id'));
    }
    public function password_check()
    {
        $this->users_models->password_check($this->input->post('password'));
    }
    public function password_new()
    {

        if ($this->input->post('pass') != $this->input->post('pass_c')) {
            echo 'error';
        } elseif ($this->input->post('pass') == $this->input->post('pass_c')) {
            echo 'good';
        }
    }

    public function newPassword()
    {
        $this->users_models->newPassword();
    }
    public function reset_Password()
    {
        $this->users_models->reset_Password();
    }
    public function check_phone(){
        $this->users_models->check_phone();
    }
}
