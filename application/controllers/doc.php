<?php
defined('BASEPATH') or exit('No direct script access allowed');

class doc extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('doc_models');
        $this->load->model('users_models');
        $check['check']=$this->users_models->check_status($this->session->userdata('user_id'));
        if ($check['check']->delete_user_data != '0') {
            redirect("login");
        }
    }
    //*************************************แสดงเอกสาร**********************************/
    public function tabledoc()
    {
        //Datatables Variables
        $draw = intval($this->input->get("draw"));
      


        $doc = $this->doc_models->show_document($this->input->post('Category_id'));

        $data = array();


        $i=1;
   
        if ($this->session->userdata('user_d') == '0') {
            if ($this->session->userdata('role') == '0') {
                foreach ($doc->result() as $r) {
                    if ($r->delete_doc_data == 0) {
                        $sub_array = array();
                        $sub_array[]  =  $i;
                        $sub_array[]  =  $r->number_doc;
                        $sub_array[]  = '<a style="color:#000000;" href="' . site_url("admin/page_show_doc/") . $r->document_id . '">' . $r->document_name . '</a>';
                        $sub_array[]  =  $r->Category_name;
                        $sub_array[]  =  $r->d_time;
                      
                        $sub_array[] = '<div style="width:100% "align ="left">
                        <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                        <a type="button" class="btn btn-warning corners shadow " href="' . site_url("admin/page_edit_doc/") . $r->document_id . '" style="font-size: 15px;"><i class="fas fa-edit"></i></a>
                        <a type="button" class="btn btn-danger corners shadow" onclick="delete_doc(' . $r->document_id . ')" style="font-size: 15px;"><i class="fas fa-ban"></i></a>
                        </div>';
                        }else{
                            $sub_array = array();
                            $sub_array[]  =  '<a style="color:#FF0000;">'.$i.'</a>';
                            $sub_array[]  =  '<a style="color:#FF0000;">'.$r->number_doc.'</a>';
                            $sub_array[]  = '<a style="color:#FF0000;" href="' . site_url("admin/page_show_doc/") . $r->document_id . '">' . $r->document_name . '</a>';
                            $sub_array[]  =  '<a style="color:#FF0000;">'.$r->Category_name.'</a>';
                            $sub_array[]  =  '<a style="color:#FF0000;">'.$r->d_time.'</a>';
                          
                            $sub_array[] = '<div style="width:100% "align ="left">
                            <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px; " id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                            <a type="button" class="btn btn-warning corners shadow recovery_doc" onclick="recovery_doc(' . $r->document_id . ')" style="font-size :15px;"><i class="fas fa-sync-alt"></i></a>
                            </div>
                            ';
                        }
                        $data[] = $sub_array;
                        $i=$i+1;
                    
                }
            } elseif ($this->session->userdata('role') == '1') {
                $a=0;
                foreach ($doc->result() as $r) {
                    $read = $this->doc_models->read($r->document_id);
                if ($r->delete_doc_data == 0) {
                    if ($r->access == 0) {
                            $sub_array = array();
                            $sub_array[]  =  $a=$a+1;
                            $sub_array[]  =  $r->number_doc;
                            $sub_array[]  =  $r->document_name;
                            $sub_array[]  =  $r->Category_name;
                            $sub_array[]  =  $r->d_time;
                            if ($r->important == 0) {
                                $sub_array[]  =  '<span class="badge bg-success corners shadow">ทั่วไป </span>';
                                if($read->num_rows() <1) {
                                    $sub_array[] = '
                                    <a type="button" class="btn btn-dark corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $r->document_id . '" style="font-size: 15px;"><i class="fas fa-book"></i> อ่าน</a>
                                    <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                    ';
                                }else{
                                    $sub_array[] = '
                                    <a type="button" class="btn btn-primary corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $r->document_id . '" style="font-size: 15px;"><i class="fas fa-book-open"></i>อ่าน</a>
                                    <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                    ';
                                }
                               
                            } elseif ($r->important == 1) {
                                $sub_array[]  =  '<span class="badge btn-warning corners shadow"><i class="fas fa-lock"></i> สำคัญ </span>';
                                if($read->num_rows() <1) {
                                $sub_array[] = '  
                                <a type="button" class="btn btn-dark corners shadow doc_check"id="' . $r->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c" type="button" style="font-size: 15px;"  ><i class="fas fa-book"></i>อ่าน</a>
                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                ';
                                }else{
                                    $sub_array[] = '  
                                    <a type="button" class="btn btn-primary corners shadow doc_check"id="' . $r->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c" type="button" style="font-size: 15px;"  ><i class="fas fa-book-open"></i>อ่าน</a>
                                    <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                    ';
                                }
                            }
                            /*  $sub_array[] = '  <a type="button" class="btn btn-dark corners shadow " data-bs-toggle="modal" data-bs-target="#password_c" type="button" style="font-size: 15px;"  ><i class="fas fa-lock"></i> อ่าน</a>';
                            }*/


                            $data[] = $sub_array;
                        }
                     else if ($r->access == 1) {
                        $id = '';
                        $array_p_id = explode(',', $r->position_id);
                        $array_u_id = explode(',', $r->user_id);
                        $array_up_id = explode(',',$this->session->userdata('position_id'));
                        if ($array_p_id[0] != 0 || $array_u_id[0] != 0) {
                        foreach ($array_up_id as $up) {
                            foreach ($array_p_id as $value) {
                                if ($value == $up) {
                                    if ($id != $r->document_id) {
                                        $sub_array = array();
                                        $sub_array[]  = $a=$a+1;
                                        $sub_array[]  =  $r->number_doc;
                                        $sub_array[]  =  $r->document_name;
                                        $sub_array[]  =  $r->Category_name;
                                        $sub_array[]  =  $r->d_time;
                                        if ($r->important == 0) {
                                            $sub_array[]  =  '<span class="badge bg-success corners shadow">ทั่วไป </span>';
                                            if($read->num_rows() <1) {
                                                $sub_array[] = '
                                                <a type="button" class="btn btn-dark corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $r->document_id . '" style="font-size: 15px;"><i class="fas fa-book"></i> อ่าน</a>
                                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                                ';
                                            }else{
                                                $sub_array[] = '
                                                <a type="button" class="btn btn-primary corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $r->document_id . '" style="font-size: 15px;"><i class="fas fa-book-open"></i>อ่าน</a>
                                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                                ';
                                            }
                                           
                                        } elseif ($r->important == 1) {
                                            $sub_array[]  =  '<span class="badge btn-warning corners shadow"><i class="fas fa-lock"></i> สำคัญ </span>';
                                            if($read->num_rows() <1) {
                                            $sub_array[] = '  
                                            <a type="button" class="btn btn-dark corners shadow doc_check"id="' . $r->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c" type="button" style="font-size: 15px;"  ><i class="fas fa-book"></i>อ่าน</a>
                                            <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                            ';
                                            }else{
                                                $sub_array[] = '  
                                                <a type="button" class="btn btn-primary corners shadow doc_check"id="' . $r->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c" type="button" style="font-size: 15px;"  ><i class="fas fa-book-open"></i>อ่าน</a>
                                                <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                                ';
                                            }
                                        }
                                        /*  $sub_array[] = '  <a type="button" class="btn btn-dark corners shadow " data-bs-toggle="modal" data-bs-target="#password_c" type="button" style="font-size: 15px;"  ><i class="fas fa-lock"></i> อ่าน</a>';
                                }*/


                                        $data[] = $sub_array;
                                        $id = $r->document_id;
                                       
                                } 
                                }
                            }
                            foreach ($array_u_id as $value_u) {
                                if ($id != $r->document_id) {
                                    if ($value_u == $this->session->userdata('user_id')) {
                                        if ($id != $r->document_id) {
                                            if ($r->delete_doc_data == 0) {
                                                $sub_array = array();
                                                $sub_array[]  =  $i;
                                                $sub_array[]  =  $r->number_doc;
                                                $sub_array[]  =  $r->document_name;
                                                $sub_array[]  =  $r->Category_name;
                                                $sub_array[]  =  $r->d_time;
                                                if ($r->important == 0) {
                                                    $sub_array[]  =  '<span class="badge bg-success corners shadow">ทั่วไป </span>';
                                                    if($read->num_rows() <1) {
                                                        $sub_array[] = '
                                                        <a type="button" class="btn btn-dark corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $r->document_id . '" style="font-size: 15px;"><i class="fas fa-book"></i> อ่าน</a>
                                                        <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                                        ';
                                                    }else{
                                                        $sub_array[] = '
                                                        <a type="button" class="btn btn-primary corners shadow " href="' . site_url("user/page_show_doc/show_doc/") . $r->document_id . '" style="font-size: 15px;"><i class="fas fa-book-open"></i>อ่าน</a>
                                                        <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                                        ';
                                                    }
                                                   
                                                } elseif ($r->important == 1) {
                                                    $sub_array[]  =  '<span class="badge btn-warning corners shadow"><i class="fas fa-lock"></i> สำคัญ </span>';
                                                    if($read->num_rows() <1) {
                                                    $sub_array[] = '  
                                                    <a type="button" class="btn btn-dark corners shadow doc_check"id="' . $r->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c" type="button" style="font-size: 15px;"  ><i class="fas fa-book"></i>อ่าน</a>
                                                    <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                                    ';
                                                    }else{
                                                        $sub_array[] = '  
                                                        <a type="button" class="btn btn-primary corners shadow doc_check"id="' . $r->document_id . '" data-bs-toggle="modal" data-bs-target="#password_c" type="button" style="font-size: 15px;"  ><i class="fas fa-book-open"></i>อ่าน</a>
                                                        <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                                                        ';
                                                    }
                                                }
                                                /*  $sub_array[] = '  <a type="button" class="btn btn-dark corners shadow " data-bs-toggle="modal" data-bs-target="#password_c" type="button" style="font-size: 15px;"  ><i class="fas fa-lock"></i> อ่าน</a>';
                                        }*/


                                                $data[] = $sub_array;
                                                $id = $r->document_id;
                                                
                                        }
                                    }
                                }
                                }
                            }
                        }
                        } 
                        }
                       
                    }
                  
                }
            } else {
                redirect("login");
            }

          
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $doc->num_rows(),
                "recordsFiltered" => $doc->num_rows(),
                "data" => $data
            );
            
            echo json_encode($output);
            exit();
        } else {
            redirect("login");
        }
    }


    public function delete_tabledoc()
    {
        //Datatables Variables
        $draw = intval($this->input->get("draw"));


        $doc = $this->doc_models->show_document($this->input->post('Category_id'));
        $data = array();



        if ($this->session->userdata('user_d') == '0') {
            if ($this->session->userdata('role') == '0') {
                foreach ($doc->result() as $r) {
                    if ($r->delete_doc_data == 1) {
                        $sub_array = array();
                        $sub_array[]  =  $r->number_doc;
                        $sub_array[]  = '<a href="' . site_url("admin/page_show_doc/") . $r->document_id . '">' . $r->document_name . '</a>';
                        $sub_array[]  =  $r->Category_name;
                        $sub_array[]  =  $r->d_time;
                        $sub_array[] = '
                        <a type="button" class="btn btn-secondary corners shadow in_doc"  style="font-size: 15px;" id="' . $r->document_id . '"><i class="fas fa-info"></i></a>
                        <a type="button" class="btn btn-warning corners shadow recovery_doc" onclick="recovery_doc(' . $r->document_id . ')" style="font-size :15px;"><i class="fas fa-sync-alt"></i></a>
                        <a type="button" class="btn btn-danger corners shadow" onclick="delete_doc_p(' . $r->document_id . ')"><i class="fas fa-trash " style="font-size :15px;"></i></a>';
                        $data[] = $sub_array;
                    }
                }
            } else {
                redirect("login");
            }


            $output = array(

                "draw" => $draw,
                "recordsTotal" => $doc->num_rows(),
                "recordsFiltered" => $doc->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect("login");
        }
    }



    //*************************** Doc ******************************************** */
    //---------------------------บันทึกเอกสาร------------------------------------------
    public function add_doc()
    {
       
        $this->doc_models->add_doc();
        
    }
    //--------------------------แก้ไขเอกสาร-----------------------------------------
    public function edit_doc()
    {
       
        $this->doc_models->edit_doc();
        redirect('', 'refresh');
    }
    //-------------------------ลบเอกสาร----------------------------------------------------
    public function delete_doc()
    {
        

        $this->doc_models->delete_doc($this->input->post('document_id'));
    }
    //----------------------ลบเอกสาร ถาวร---------------------------------------------------
    public function  delete_doc_permanent()
    {
        
        $this->doc_models->delete_doc_permanent($this->input->post('document_id'));
      
    }
    //----------------------กู้เอกสาร-------------------------------------------------------
    public function  recovery_doc()
    {
       
        $this->doc_models->recovery_doc($this->input->post('document_id'));
        
    }
    //---------------รายละเอียดเอกสาร-----------------------------------------------------
    function in_doc()
    {

        $data = $this->doc_models->show_document_id($_POST["document_id"]);
        echo json_encode($data);
    }
}
