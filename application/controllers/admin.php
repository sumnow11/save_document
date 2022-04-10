<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_models');
        $this->load->model('category_models');
        $this->load->model('doc_models');
        $this->load->model('report_models');
        $check['check']=$this->users_models->check_status($this->session->userdata('user_id'));
        
        if ($this->session->userdata('role') != '0') {
            redirect("login");
        } else {
            if ($check['check']->delete_user_data != '0') {
                redirect("login");
            }
        }
      
        $data['user_nav'] = $this->users_models->show_user_id($this->session->userdata('user_id'));
        $this->load->view('Template/together/css');
        $this->load->view('Template/admin/navbar_admin', $data);
        $this->load->view('Template/admin/Modal');
        $this->load->view('Template/together/js');
        

    }

    public function index()
    {
        
       
       
        $data['year']= $this->report_models->year();
        $this->load->view('Template/admin/index',$data);
        $this->load->view('Template/together/footer');
    
    }
   
    
    //************************ User **********************************
    //-------------------------แสดงสมาชิก----------------------------------------------
    public function page_show_tableuser()
    {
        $this->load->view('Template/admin/show_tableuser',array());
        $this->load->view('Template/together/footer');
    }
    //--------------------------หน้าแก้ไขสมาชิก---------------------------------------------------------

    public function  page_edit_user($user_id)
    {
        $data['position'] = $this->users_models->show_position();
        $data['user'] = $this->users_models->show_user_id($user_id);
        $this->load->view('Template/together/edit_user', $data);
        $this->load->view('Template/together/footer');
    }
    //------------------------โปรไฟล์---------------------------------------------------------------------
    public function profile($user_id)
    {
        $data['user'] = $this->users_models->show_user_id($user_id);
        $data['show_position'] = $this->users_models->show_position();
        $this->load->view('Template/together/profile', $data);
        $this->load->view('Template/together/footer');
        

    }

    //*************************** Doc ******************************************** */
   
    //-------------------------แสดงตารางเอกสาร----------------------------------------------
    public function page_show_tabledoc()
    {
          $this->load->view('Template/together/tasdoc',array());
          $this->load->view('Template/together/footer');
    }
    //-------------------------หน้าแก้ไขเอกสาร----------------------------------------------
    public function page_edit_doc($document_id)
    {

        $data['doc'] = $this->doc_models->show_document_id($document_id);
        $data['position'] = $this->users_models->show_position();
        $data['category'] = $this->category_models->show_category();
        $data['user_'] = $this->users_models->show_user_();
        $this->load->view('Template/admin/edit_doc', $data);
        $this->load->view('Template/together/footer');
    }
    //-----------------------แสดงข้อมูลเอกสาร--------------------------------------------------
    public function page_show_doc($document_id)
    {

        $data['doc'] = $this->doc_models->show_document_id($document_id);
        $this->load->view('Template/together/show_doc', $data);
        $this->load->view('Template/together/footer');
    }
    //**************************ถังขยะ************************************************************ */
    public function page_show_delete()
    {
       

        $this->load->view('Template/admin/show_delete',array());
        $this->load->view('Template/together/footer');
    }
    //****************************หมวดหมู่**********************************************************
    //----------------------------แสดงหมวดหมู่ทั้งหมด-------------------------------------------------
    public function page_show_category()
    {

        $this->load->view('Template/admin/show_category');
        $this->load->view('Template/together/footer');
    }
    //---------------------------------------ค้นหา---------------------------------------------------------------
    public function page_search()
    {
      
      $this->load->view('Template/together/search');
      $this->load->view('Template/together/footer');
 
    }
    //--------------------------------------รายงาน------------------------------------------------
    public function page_report()
    {
      $data['category'] =$this->category_models->show_category();
      $data['user']=$this->users_models->show_user_();
      $this->load->view('Template/admin/report',$data);
      $this->load->view('Template/together/footer');
 
    }
   
    
}
