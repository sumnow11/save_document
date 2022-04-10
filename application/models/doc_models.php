<?php
class doc_models extends CI_Model
{



        //----------------------------เพิ่มเอกสาร-----------------------------------------------------------
        public function add_doc()
        {
                $config['upload_path'] = './data_doc/doc/';
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name']  = true;


                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('pdf')) {


                        echo $this->upload->display_errors();
                } else {
                        $data = $this->upload->data();
                        // print_r($data);
                        $filename = $data['file_name'];
                }

                if ($this->input->post('privilege') == 0) {
                        $position_id = 0;
                        $access = 0;
                        $user_id = 0;
                } elseif ($this->input->post('privilege') == 1) {
                        if ($this->input->post('privilege_position') == 1 && $this->input->post('privilege_user') == 1) {
                                if ($this->input->post('position_id') == '' && $this->input->post('user_id') == '') {
                                        $position_id = 0;
                                        $access = 0;
                                        $user_id = 0;
                                } elseif (($this->input->post('position_id') == '' && $this->input->post('user_id') != '')) {
                                        $access = 1;
                                        $user_id = implode(',', $this->input->post('user_id'));
                                        $position_id = 0;
                                } elseif (($this->input->post('position_id') != '' && $this->input->post('user_id') == '')) {
                                        $access = 1;
                                        $position_id = implode(',', $this->input->post('position_id'));
                                        $user_id = 0;
                                } else {
                                        $access = 1;
                                        $user_id = implode(',', $this->input->post('user_id'));
                                        $position_id = implode(',', $this->input->post('position_id'));
                                }
                        } elseif ($this->input->post('privilege_position') == 1 && $this->input->post('privilege_user') == '') {
                                if ($this->input->post('position_id') == '') {
                                        $position_id = 0;
                                        $access = 0;
                                        $user_id = 0;
                                } else {
                                        $access = 1;
                                        $position_id = implode(',', $this->input->post('position_id'));
                                        $user_id = 0;
                                }
                        } elseif ($this->input->post('privilege_position') == '' && $this->input->post('privilege_user') == 1) {
                                if ($this->input->post('user_id') == '') {
                                        $position_id = 0;
                                        $access = 0;
                                        $user_id = 0;
                                } else {
                                        $access = 1;
                                        $user_id = implode(',', $this->input->post('user_id'));
                                        $position_id = 0;
                                }
                        } else {
                                $position_id = 0;
                                $access = 0;
                                $user_id = 0;
                        }
                }



                /*  print_r($_POST);

                        print_r($position_id);

                        print_r($filename);*/


                $document = $this->input->post('information');
                $document = str_replace("\n", "<br>", "$document");

                $data = array(
                        'document_name' => $this->input->post('document_name'),
                        'category_id' => $this->input->post('category'),
                        'doc_pdf' => $filename,
                        'document' => $document,
                        'time' => $this->input->post('day'),
                        'agency' => $this->input->post('agency'),
                        'number_doc' => $this->input->post('number_doc')


                );
                $query = $this->db->insert('document', $data);
                $insertId = $this->db->insert_id();

                if ($query) {
                        $data2 = array(
                                'document_id' => $insertId,
                                'position_id' => $position_id,
                                'important' => $this->input->post('important'),
                                'access' => $access,
                                'user_id' => $user_id,
                                'position_id' => $position_id

                        );
                        $query2 = $this->db->insert('access_doc', $data2);
                        if ($query2) {
                                $data3 = array(
                                        'id_doc' => $insertId,
                                        'document_name' => $this->input->post('document_name'),
                                        'day' => $this->input->post('day'),
                                        'category_id' => $this->input->post('category'),
                                        'number_doc' => $this->input->post('number_doc')
                                );
                               
                        } else {
                                echo '<script>';
                                echo ' alert("บันทึกไม่เอกสารสำเร็จ")';
                                echo 'window.history.back()';
                                echo '</script>';
                        }
                } else {
                        echo '<script>';
                        echo ' alert("บันทึกไม่เอกสารสำเร็จ")';
                        echo 'window.history.back()';
                        echo '</script>';
                }
        }
        //-----------------------------------แสดงเอกสารตามหมวดหมู่---------------------------------------------
        public function show_document($Category_id)
        {
                if ($Category_id == '') {
                        $this->db->select('DATE_FORMAT(d.time,"%d/%m/%y") as d_time,d.*,c.*,a.*');
                        $this->db->from('document as d');
                        $this->db->join('category as c', 'c.Category_id = d.category_id');
                        $this->db->join('access_doc as a', 'a.document_id = d.document_id');
                        $this->db->order_by('d.document_id', 'desc');
                        return $this->db->get();
                } else {
                        $this->db->select('DATE_FORMAT(d.time,"%d/%m/%y") as d_time,d.*,c.*,a.*');
                        $this->db->from('document as d');
                        $this->db->join('category as c', 'c.Category_id = d.category_id');
                        $this->db->join('access_doc as a', 'a.document_id = d.document_id');
                        $this->db->where('c.Category_id', $Category_id);
                        return $this->db->get();
                }
        }
        //-----------------------------------แสดงเอกสารตาม id---------------------------------------------
        public function show_document_id($document_id)
        {
                $this->db->select('d.*,c.*,a.*');
                $this->db->from('document as d');
                $this->db->join('category as c', 'c.Category_id = d.category_id');
                $this->db->join('access_doc as a', 'a.document_id = d.document_id');

                $this->db->where('d.document_id', $document_id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                        $data = $query->row();
                        return $data;
                }else if($query->num_rows() <= 0){
                        redirect("login");
                }
                return false;
        }

        public function doc_id($document_id)
        {
                $this->db->select();
                $this->db->from('document as d');
                $this->db->where('d.document_id', $document_id);
                $query = $this->db->get();
                return $query->result();
        }
        //-------------------------------แสดงเอกสารตามหมวดหมู่---------------------------------------------
        public function show_document_c($Category_id)
        {
                $this->db->select('c.*,d.*,a.*');
                $this->db->from('category as c ');
                $this->db->join('document as d', 'c.Category_id = d.category_id');
                $this->db->join('access_doc as a', 'a.document_id = d.document_id');
                $this->db->where('c.Category_id', $Category_id);
                return $this->db->get();
        }
        //-----------------------------แก้ไขเอกสาร--------------------------------------------------------
        public function edit_doc()
        {
                $document = $this->input->post('information');
                $document = str_replace("\n", "<br>", "$document");

                if ($this->input->post('privilege') == 0) {
                        $position_id = 0;
                        $access = 0;
                        $user_id = 0;
                } elseif ($this->input->post('privilege') == 1) {
                        if ($this->input->post('privilege_position') == 1 && $this->input->post('privilege_user') == 1) {
                                if ($this->input->post('position_id') == '' && $this->input->post('user_id') == '') {
                                        $position_id = 0;
                                        $access = 0;
                                        $user_id = 0;
                                } elseif (($this->input->post('position_id') == '' && $this->input->post('user_id') != '')) {
                                        $access = 1;

                                        $user_id_r = implode(',', $this->input->post('user_id'));
                                        $array_user_id = explode(',',$user_id_r);
                                        $array_user_id_r = array_unique($array_user_id);
                                        $user_id = implode(',',$array_user_id_r);

                                        $position_id = 0;
                                } elseif (($this->input->post('position_id') != '' && $this->input->post('user_id') == '')) {
                                        $access = 1;

                                        $position_id_r = implode(',', $this->input->post('position_id'));
                                        $array_p_id = explode(',',$position_id_r);
                                        $array_p_id_r = array_unique($array_p_id);
                                        $position_id = implode(',',$array_p_id_r);

                                        $user_id = 0;
                                } else {
                                        $access = 1;
                                      
                                        $user_id_r = implode(',', $this->input->post('user_id'));
                                        $array_user_id = explode(',',$user_id_r);
                                        $array_user_id_r = array_unique($array_user_id);
                                        $user_id = implode(',',$array_user_id_r);


                                        $position_id_r = implode(',', $this->input->post('position_id'));
                                        $array_p_id = explode(',',$position_id_r);
                                        $array_p_id_r = array_unique($array_p_id);
                                        $position_id = implode(',',$array_p_id_r);
                                }
                        } elseif ($this->input->post('privilege_position') == 1 && $this->input->post('privilege_user') == '') {
                                if ($this->input->post('position_id') == '') {
                                        $position_id = 0;
                                        $access = 0;
                                        $user_id = 0;
                                } else {
                                        $access = 1;

                                        $position_id_r = implode(',', $this->input->post('position_id'));
                                        $array_p_id = explode(',',$position_id_r);
                                        $array_p_id_r = array_unique($array_p_id);
                                        $position_id = implode(',',$array_p_id_r);

                                        $user_id = 0;
                                }
                        } elseif ($this->input->post('privilege_position') == '' && $this->input->post('privilege_user') == 1) {
                                if ($this->input->post('user_id') == '') {
                                        $position_id = 0;
                                        $access = 0;
                                        $user_id = 0;
                                } else {
                                        $access = 1;
                                      
                                        $user_id_r = implode(',', $this->input->post('user_id'));
                                        $array_user_id = explode(',',$user_id_r);
                                        $array_user_id_r = array_unique($array_user_id);
                                        $user_id = implode(',',$array_user_id_r);
                                        
                                        $position_id = 0;
                                }
                        } else {
                                $position_id = 0;
                                $access = 0;
                                $user_id = 0;
                        }
                }





                $config['upload_path'] = './data_doc/doc/';
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name']  = true;
                $this->load->library('upload', $config);


                if (!$this->upload->do_upload('pdf')) {
                        $data = array(
                                'document_name' => $this->input->post('document_name'),
                                'category_id' => $this->input->post('category'),
                                'document' => $document,
                                'time' => $this->input->post('day'),
                                'agency' => $this->input->post('agency'),
                                'number_doc' => $this->input->post('number_doc')

                        );
                } else {
                        $data = $this->upload->data();
                        // print_r($data);
                        $filename = $data['file_name'];
                        $data = array(
                                'document_name' => $this->input->post('document_name'),
                                'category_id' => $this->input->post('category'),
                                'doc_pdf' => $filename,
                                'document' => $document,
                                'time' => $this->input->post('day'),
                                'agency' => $this->input->post('agency'),
                                'number_doc' => $this->input->post('number_doc')

                        );
                }
                $this->db->where('document_id', $this->input->post('id'));
                $query = $this->db->update('document', $data);
                if ($query) {
                        $data2 = array(
                                'position_id' => $position_id,
                                'important' => $this->input->post('important'),
                                'access' => $access,
                                'user_id' => $user_id,
                                'position_id' => $position_id

                        );
                        $this->db->where('document_id', $this->input->post('id'));
                        $query2 = $this->db->update('access_doc', $data2);

                        $data3 = array(
                                'document_name' => $this->input->post('document_name'),
                                'day' => $this->input->post('day'),
                                'category_id' => $this->input->post('category'),
                                'number_doc' => $this->input->post('number_doc')
                                );
                               
                
                
                } else {
                        echo '<script>';
                        echo ' alert("แก้ไขเอกสารไม่สำเร็จ")';
                        echo 'window.history.back()';
                        echo '</script>';
                }
        }
        public function delete_doc($document_id)
        {
                $delete = 1;
                $data = array(
                        'delete_doc_data' => $delete
                );
                $this->db->where('document_id', $document_id);
                $query = $this->db->update('document', $data);
                if ($query) {
                } else {
                        echo '<script>';
                        echo ' alert("ลบเอกสารไม่สำเร็จ")';
                        echo 'window.history.back()';
                        echo '</script>';
                }
        }
        //------------------------ลบเอกสาร ถาวร----------------------------------------------
        public function delete_doc_permanent($document_id)
        {
                $this->db->select('d.*');
                $this->db->from('document as d');
                $this->db->where('d.document_id', $document_id);
                $query = $this->db->get();
                $data = $query->row();
                $filename="././data_doc/doc/$data->doc_pdf";
                (unlink($filename));
                $this->db->delete('document', array('document_id' => $document_id));
                $this->db->delete('access_doc', array('document_id' => $document_id));
                

                
        }
        //-------------------------กู้คืน เอกสาร----------------------------------------------------
        public function recovery_doc($document_id)
        {
                $delete = 0;
                $data = array(
                        'delete_doc_data' => $delete
                );
                $this->db->where('document_id', $document_id);
                $query = $this->db->update('document', $data);
                if ($query) {
                } else {
                        echo '<script>';
                        echo ' alert("กู้คืนเอกสารไม่สำเร็จ")';
                        echo 'window.history.back()';
                        echo '</script>';
                }
        }
        //-----------------------ค้นหา--------------------------------------------------------------
        function search_doc($query)
        {
                $this->db->select("d.*,c.*,a.*");
                $this->db->from("document as d");
                $this->db->join('category as c', 'c.Category_id = d.category_id');
                $this->db->join('access_doc as a', 'a.document_id = d.document_id');

                if ($query != '') {
                        $this->db->like('d.document_name', $query);
                        $this->db->or_like('c.Category_name', $query);
                        $this->db->or_like('d.time', $query);
                        $this->db->or_like('d.number_doc', $query);
                }
                $this->db->order_by('d.document_id', 'DESC');
                return $this->db->get();
        }
        //------------------------บันทึกการอ่าน------------------------------------------------------
        function read_s($document_id){
                $this->db->select();
                $this->db->from("history_read");
                $this->db->where('document_id_hr',$document_id)->where('user_id_hr',$this->session->userdata('user_id'));
                $query = $this->db->get();
                if ($query->num_rows() < 1) {
                       $data = array(
                         "user_id_hr" =>$this->session->userdata('user_id'),
                         "document_id_hr" => $document_id,
                       );
                       $this->db->insert('history_read', $data);

                }
                return false;
                
        }
        //------------------เช็คอ่าน------------------------------------------------------------
        function read($document_id){
                $this->db->select();
                $this->db->from("history_read");
                $this->db->where('document_id_hr',$document_id)->where('user_id_hr',$this->session->userdata('user_id'));
                return $this->db->get();
        }
      
}
