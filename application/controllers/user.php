<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_models');
        $this->load->model('category_models');
        $this->load->model('doc_models');
        $check['check'] = $this->users_models->check_status($this->session->userdata('user_id'));
        if ($this->session->userdata('role') != '1') {
            redirect("login");
        } else {
            if ($check['check']->delete_user_data != '0') {
                redirect("login");
            }
        }
        $data['category'] =  $this->category_models->show_category();
        $data['user_nav'] = $this->users_models->show_user_id($this->session->userdata('user_id'));
        $this->load->view('Template/together/css');
        $this->load->view('Template/user/navbar_user', $data);
        $this->load->view('Template/user/Modal');
        $this->load->view('Template/together/user_js');
    }

    public function index()
    {
        $this->load->view('Template/together/tasdoc', array());
        $this->load->view('Template/together/footer');
    }
    //--------------------โปรไฟล์------------------------------------------------------------
    public function profile($user_id)
    {
        if ($this->session->userdata('user_id') == $user_id) {
            $data['user'] = $this->users_models->show_user_id($user_id);
            $data['show_position'] = $this->users_models->show_position();
            $this->load->view('Template/together/profile', $data);
            $this->load->view('Template/together/footer');
        } else {
            redirect("login");
        }
    }

    //-----------------------------แสดงเอกสาร---------------------------------------------
    public function page_show_doc($a, $document_id)
    {

        $data['doc'] = $this->doc_models->show_document_id($document_id);
        $array_p_id = explode(',', $data['doc']->position_id);
        $array_u_id = explode(',', $data['doc']->user_id);
        $array_up_id = explode(',', $this->session->userdata('position_id'));
        $p_count = count($array_p_id);
        $u_count = count($array_u_id);
        $p_test = '';
        $u_test = '';
        $i = 0;
        $s = 0;
        if ($data['doc']->delete_doc_data == 0) {
            if ($data['doc']->access == 0) {
                $this->doc_models->read_s($document_id);
                if ($data['doc']->important == '0') {
                    $this->load->view('Template/together/show_doc', $data);
                } else {
                    if ($a == 'show__doc') {
                        $this->load->view('Template/together/show_doc', $data);
                    } else {
                        redirect("login");
                    }
                }

?>

                <?php  } else if ($data['doc']->access == 1) {
                $id = '';
                foreach ($array_up_id as $up) {
                    foreach ($array_p_id as $value) {
                        if ($value == $up) {
                            if ($data['doc']->important == '0') {
                                if ($id !=  $data['doc']->document_id) {
                                $this->load->view('Template/together/show_doc', $data);
                                $this->doc_models->read_s($document_id);
                                }
                            } else {
                                if ($a == 'show__doc') {
                                    if ($id !=  $data['doc']->document_id) {
                                    $this->load->view('Template/together/show_doc', $data);
                                    $this->doc_models->read_s($document_id);
                                    }
                                } else {
                                    redirect("login");
                                }
                            }
                ?>
                     
                        <?php $id =  $data['doc']->document_id;
                        } else {
                            $i++;
                        }
                        if ($p_count <= $i) {
                            $p_test = 'on';
                        }
                    }
                }
                foreach ($array_u_id as $value) {
                    if ($id !=  $data['doc']->document_id) {
                        if ($value == $this->session->userdata('user_id')) {

                            if ($data['doc']->important == '0') {
                                $this->load->view('Template/together/show_doc', $data);
                                $this->doc_models->read_s($document_id);
                            } else {
                                if ($a == 'show__doc') {
                                    $this->load->view('Template/together/show_doc', $data);
                                    $this->doc_models->read_s($document_id);
                                } else {
                                    redirect("login");
                                }
                            }
                        ?>
                            
<?php
                        } else {
                            $s++;
                        }
                        if ($u_count <= $s) {
                            $u_test = 'on';
                        }
                    }
                }
                if ($p_test == 'on' && $u_test == 'on') {
                    redirect("login");
                }
            } else {
                redirect("login");
            }
        }else {
            redirect("login");
        }
    }
    //----------------------แก้ไขโปรไฟล์------------------------------
    public function page_edit_profile($user_id)
    {
        if ($this->session->userdata('user_id') == $user_id) {
            $data['user'] = $this->users_models->show_user_id($user_id);
            $this->load->view('Template/together/edit_user', $data);
            $this->load->view('Template/together/footer');
        } else {
            redirect("login");
        }
    }
    //------------------------ค้นหาเอกสาร---------------------------------
    public function page_search()
    {
        $this->load->view('Template/together/search');
        $this->load->view('Template/together/footer');
    }
}
