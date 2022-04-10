<?php
defined('BASEPATH') or exit('No direct script access allowed');

class search extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('doc_models');
        $this->load->model('users_models');
        $check['check'] = $this->users_models->check_status($this->session->userdata('user_id'));
       
        if ($check['check']->delete_user_data != '0') {
            redirect("login");
        }
    }

    public function search_doc()
    {

        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->doc_models->search_doc($query);
        $s_position = $this->users_models->show_position();
        $output .= '
        <div class="table-responsive">
            <table class="table display table-bordered table-striped " id="search">
            <tr>
                <th style="width:5%;">เลขที่</th>
                <th>เอกสาร</th>
                <th>ประเภท</th>
                <th>จัดการ</th>
            </tr>
        ';
        if ($data->num_rows() > 0) {
            if ($this->session->userdata('user_d') == '0') {
                if ($this->session->userdata('role') == '0') {
                    foreach ($data->result() as $row) {
                        if ($row->delete_doc_data == 0) {
                            $output .= '
             <tr>
                 <td>' . $row->number_doc . '</td>
                <td><a href="' . site_url("admin/page_show_doc/") . $row->document_id . '">' . $row->document_name . '</a></td>
                <td>' . $row->Category_name . '</td>
                <td> 
                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 14px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a>
                <a type="button" class="btn btn-warning corners shadow " href="' . site_url("admin/page_edit_doc/") . $row->document_id . '" style="font-size: 14px;"><i class="fas fa-edit"></i></a>
                 <a type="button" class="btn btn-danger corners shadow" onclick="delete_doc(' . $row->document_id . ')" style="font-size: 14px;"><i class="fas fa-ban"></i></a></td>
                </tr>
            ';
                        }else{
                            $output .= '
                            <tr>
                                <td><a style="color:#FF0000;">' . $row->number_doc . '</a></td>
                               <td><a style="color:#FF0000;" href="' . site_url("admin/page_show_doc/") . $row->document_id . '">' . $row->document_name . '</a></td>
                               <td><a style="color:#FF0000;">' . $row->Category_name . '</a></td>
                               <td> 
                               <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 14px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a>
                               <a type="button" class="btn btn-warning corners shadow " style="font-size: 14px;"onclick="recovery_doc(' . $row->document_id . ')"><i class="fas fa-sync-alt"></i></a>
                                
                               </tr>
                           ';
                        }
                    }
                } else if ($this->session->userdata('role') == '1') {
                    $id = '';
                    foreach ($data->result() as $row) {
                        $read = $this->doc_models->read($row->document_id);
                        $array_p_id = explode(',', $row->position_id);
                        $array_u_id = explode(',', $row->user_id);
                        $array_up2_id = explode(',', $this->session->userdata('position_id'));
                        if ($row->access == 0) {
                            if ($row->delete_doc_data == 0) {
                                $output .= '
                            <tr>
                               <td>' . $row->number_doc . '</td>
                               <td><a>' . $row->document_name . '</a></td>
                               <td>' . $row->Category_name . '</td>';
                                if ($row->important == 0) {
                                    if ($read->num_rows() < 1) {
                                        $output .= ' <td> <a type="button" class="btn btn-dark corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $row->document_id . '" style="font-size: 15px;"><i class="fas fa-book"></i>  อ่าน</a>
                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                                </td>';
                                    } else {
                                        $output .= ' <td> <a type="button" class="btn btn-primary corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $row->document_id . '" style="font-size: 15px;"><i class="fas fa-book-open"></i> อ่าน</a>
                                <a type="button" class="btn btn-secondary corners shadow in_doc "  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                                </td>';
                                    }
                                } elseif ($row->important == 1) {
                                    if ($read->num_rows() < 1) {
                                        $output .= ' <td> <a type="button" class="btn btn-dark corners shadow doc_check" id="' . $row->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c"style="font-size: 15px;"><i class="fas fa-book"></i>  อ่าน</a>
                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                                </td>';
                                    } else {
                                        $output .= ' <td> <a type="button" class="btn btn-primary corners shadow doc_check"id="' . $row->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c" style="font-size: 15px;"><i class="fas fa-book-open"></i> อ่าน</a>
                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                                </td>';
                                    }
                                }
                                $output .= '</tr>
                       ';
                            }
                        } else if ($array_p_id[0] != 0 || $array_u_id[0] != 0) {
                            foreach ($array_up2_id as $up) {
                                foreach ($array_p_id as $value) {
                                    if ($value == $up) {
                                        if ($id != $row->document_id) {
                                        if ($row->delete_doc_data == 0) {
                                            $output .= '
                     <tr>
                        <td>' . $row->number_doc . '</td>
                        <td><a>' . $row->document_name . '</a></td>
                        <td>' . $row->Category_name . '</td>';
                                            if ($row->important == 0) {
                                                if ($read->num_rows() < 1) {
                                                    $output .= ' <td> <a type="button" class="btn btn-dark corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $row->document_id . '" style="font-size: 15px;"><i class="fas fa-book"></i>  อ่าน</a>
                            <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                            </td>';
                                                } else {
                                                    $output .= ' <td> <a type="button" class="btn btn-primary corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $row->document_id . '" style="font-size: 15px;"><i class="fas fa-book-open"></i> อ่าน</a>
                            <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                            </td>';
                                                }
                                            } elseif ($row->important == 1) {
                                                if ($read->num_rows() < 1) {
                                                    $output .= ' <td> <a type="button" class="btn btn-dark corners shadow doc_check"id="' . $row->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c"style="font-size: 15px;"><i class="fas fa-book"></i>  อ่าน</a>
                            <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                            </td>';
                                                } else {
                                                    $output .= ' <td> <a type="button" class="btn btn-primary corners shadow doc_check"id="' . $row->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c" style="font-size: 15px;"><i class="fas fa-book-open"></i> อ่าน</a>
                            <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                            </td>';
                                                }
                                            }
                                            $output .= '</tr>
                ';
                                            $id = $row->document_id;
                                        }
                                    }
                                }
                                }
                            }
                            foreach ($array_u_id as $value_u) {
                                if ($id != $row->document_id) {
                                    if ($value_u == $this->session->userdata('user_id')) {
                                        if ($row->delete_doc_data == 0) {
                                            $output .= '
                                        <tr>
                                           <td>' . $row->number_doc . '</td>
                                           <td><a>' . $row->document_name . '</a></td>
                                           <td>' . $row->Category_name . '</td>';
                                            if ($row->important == 0) {
                                                if ($read->num_rows() < 1) {
                                                    $output .= ' <td> <a type="button" class="btn btn-dark corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $row->document_id . '" style="font-size: 15px;"><i class="fas fa-book"></i>  อ่าน</a>
                                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                                                </td>';
                                                } else {
                                                    $output .= ' <td> <a type="button" class="btn btn-primary corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $row->document_id . '" style="font-size: 15px;"><i class="fas fa-book-open"></i> อ่าน</a>
                                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                                                </td>';
                                                }
                                            } elseif ($row->important == 1) {
                                                if ($read->num_rows() < 1) {
                                                    $output .= ' <td> <a type="button" class="btn btn-dark corners shadow doc_check"id="' . $row->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c"style="font-size: 15px;"><i class="fas fa-book"></i>  อ่าน</a>
                                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                                                </td>';
                                                } else {
                                                    $output .= '<td> <a type="button" class="btn btn-primary corners shadow doc_check"id="' . $row->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c" style="font-size: 15px;"><i class="fas fa-book-open"></i> อ่าน</a>
                                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $row->document_id . '"><i class="fas fa-info"></i></a></td>
                                                </td>';
                                                }
                                            }
                                            $output .= '</tr>
                                   ';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $output .= '<tr>
    <td colspan="5">ไม่พบข้อมูล</td>
    </tr>';
        }
        $output .= '</table>';
        echo $output;
    }


    public function search_user()
    {
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->users_models->search_user($query);
        $output .= '
        <div class="table-responsive">
            <table class="table display table-bordered table-striped " id="search">
            <tr>
                
                <th>ชือ</th>
                <th>จัดการ</th>
            </tr>
        ';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                if($row->delete_user_data==0){
                $output .= '
             <tr>
                <td><a href="' . site_url("admin/profile/") . $row->user_id . '">' . $row->fname . " " . $row->lname . '</a></td>
              ';
                
                if($this->session->userdata('user_id') == $row->user_id){
                    $output .= '<td> <a  type="button" class="btn btn-warning corners shadow d-none d-md-table-cell" href="' . site_url("admin/page_edit_user/") . $row->user_id . '" style="font-size: 15px;"><i class="fas fa-edit"></i></a>';
                }else{
                    $output .= '<td> <a  type="button" class="btn btn-warning corners shadow d-none d-md-table-cell" href="' . site_url("admin/page_edit_user/") . $row->user_id . '" style="font-size: 15px;"><i class="fas fa-edit"></i></a>
                    <a type="button" class="btn btn-danger corners shadow" onclick="delete_user(' . $row->user_id . ')" style="font-size: 15px;"><i class="fas fa-ban"></i></a></td>
                    </tr>';
                }
               
            
            }else{
                $output .= '
                <tr>
                   <td><a style="color:#FF0000;" href="' . site_url("admin/profile/") . $row->user_id . '">' . $row->fname . " " . $row->lname . '</a></td>
                   <td> <a  type="button" class="btn btn-warning corners shadow" onclick="recovery_user(' .$row->user_id . ')" style="font-size: 15px;"><i class="fas fa-sync-alt"></i></a>
                   
                   </tr>
               ';
            }
        }
        } else {
            $output .= '<tr>
                <td colspan="5">ไม่พบข้อมูล</td>
                </tr>';
        }
        $output .= '</table>';
        echo $output;
    }
}
