<?php
defined('BASEPATH') or exit('No direct script access allowed');

class category extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('category_models');
        $this->load->model('users_models');
        $check['check']=$this->users_models->check_status($this->session->userdata('user_id'));
       
        if ($this->session->userdata('role') != '0') {
            redirect("login");
        }else{
            if ($check['check']->delete_user_data != '0') {
                redirect("login");
            }
        }
    }

    public function table_category()
    {
        //Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

       
            $category=  $this->category_models->show_category();
            $data = array();
           
          
        
        if ($this->session->userdata('user_d') == '0') {
            if ($this->session->userdata('role') == '0') {
                foreach ($category as $r) {
                    if ($r->delete_category == 0) {
                        $sub_array = array();
                      
                        $sub_array[]  =  '<a >'.$r->Category_name.'</a>';
                        $sub_array[]  =  $r->time_category ;
                        if($r->Category_id!="6"){
                        $sub_array[] = '  <a type="button" class="btn btn-warning corners shadow edit_categorys" id="'.$r->Category_id.'"    style="font-size: 15px;"><i class="fas fa-edit"></i></a>
                        <a type="button" class="btn btn-danger corners shadow" onclick="delete_category('.$r->Category_id.' )" style="font-size: 15px;"><i class="fas fa-trash"></i></a>';
                        }else{
                            $sub_array[]='';
                        }
                    }else{
                        $sub_array = array();
                      
                        $sub_array[]  =  '<a style="color:#FF0000;">'.$r->Category_name.'</a>';
                        $sub_array[]  =  '<a style="color:#FF0000;">'.$r->time_category.'</a>';
                        
                        $sub_array[] = '  <a type="button" class="btn btn-warning corners shadow" onclick="recover_category('.$r->Category_id.')"  style="font-size :15px;"><i class="fas fa-sync-alt"></i></a>';
                       
                    }
                        $data[] = $sub_array;
                    
                }
            } else {
                redirect("login");
            }

            $output = array(
                "draw" => $draw,
                
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect("login");
        }
    }

    public function delete_table_category()
    {
        //Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

       
            $category=  $this->category_models->show_category();
            $data = array();
           
          
        
        if ($this->session->userdata('user_d') == '0') {
            if ($this->session->userdata('role') == '0') {
                foreach ($category as $r) {
                    if ($r->delete_category == 1) {
                        $sub_array = array();
                        $sub_array[]  =  $r->Category_name;
                        $sub_array[] = ' <a type="button" class="btn btn-warning corners shadow" onclick="recover_category('.$r->Category_id.')"  style="font-size :10px;"><i class="fas fa-sync-alt"></i></a>
                        <a type="button" class="btn btn-danger corners shadow" onclick="delete_category_p('.$r->Category_id.')" style="font-size :10px;"><i class="fas fa-trash "></i></a>';
                       
                        $data[] = $sub_array;
                    }
                }
            } else {
                redirect("login");
            }

            $output = array(
                "draw" => $draw,
                
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect("login");
        }
    }

    public function category_table_index()
    {
        //Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

       
            $category=  $this->category_models->show_category();
            $data = array();
           
          
        
        if ($this->session->userdata('user_d') == '0') {
            if ($this->session->userdata('role') == '0') {
                foreach ($category as $r) {
                    if ($r->delete_category == '0') {
                        $sub_array = array();
                        $sub_array[]  =  $r->Category_name;
                        if($r->Category_id!="6"){
                            $sub_array[] = '  <a type="button" class="btn btn-warning corners shadow edit_categorys" id="'.$r->Category_id.'"    style="font-size: 15px;"><i class="fas fa-edit"></i></a>
                            <a type="button" class="btn btn-danger corners shadow" onclick="delete_category('.$r->Category_id.' )" style="font-size: 15px;"><i class="fas fa-trash"></i></a>';
                            }else{
                                $sub_array[]='';
                            }
                       
                        $data[] = $sub_array;
                    }
                }
            } else {
                redirect("login");
            }

            $output = array(
                "draw" => $draw,
                
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect("login");
        }
    }

    function category_id()  
      {  
           $output = array();  
           $data = $this->category_models->show_category_id($_POST["category_id"]);  
           foreach($data as $row)  
           {  
                $output['Category_id'] = $row->Category_id;  
                $output['Category_name'] = $row->Category_name;    
           }  
           echo json_encode($output);  
      }  
//-------------------เพิ่มหมวดหมู่---------------------------------------------
public function  add_category()
    {
        
        $this->category_models->add_category();
      
    }
//-----------------ลบหมวดหมู่-----------------------------------------------
    public function  delete_category()
    {
        $this->category_models->delete_category($this->input->post('Category_id'));
     
    }
//------------------กู้คืนเอกสาร-----------------------------------------------------------
public function  recover_category()
{
    $this->category_models->recover_category($this->input->post('Category_id'));
}
//--------------------ลบหมวดหมู่ ถาวร---------------------------------------------------------
public function  delete_category_p()
{
    $this->category_models->delete_category_p($this->input->post('Category_id'));
}
public function  edit_category()
{
    $this->category_models->edit_category();
}
}