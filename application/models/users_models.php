<?php
class users_models extends CI_Model
{

        //---------------------------แสดงตำแหน่งงาน--------------------------------------------
        public function show_position()
        {
                $query = $this->db->get('position');
                return $query->result();
        }
        //----------------------------แสดงสมาชิก-----------------------------------------------------
        public function show_user_()
        {
                $query = $this->db->get('user');
                return $query->result();
        }
        //-----------------------------แสดงตำแหน่ง ตาม id -------------------------------------------
        public function show_position_id($position_id)
        {
                $this->db->select();
                $this->db->from('position');
                $this->db->where('position.position_id', $position_id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                        $data = $query->row();
                        return $data;
                }
                return false;
        }
        //----------------------------เพิ่มสมาชิก-----------------------------------------------------------
        public function add_user()
        {
                $email = $this->input->post('email');
                $this->db->select('email');
                $this->db->where('email', $email);
                $query = $this->db->get('user');
                $num = $query->num_rows();
                if ($num > 0) {
                        echo 'taken_email';
                } else {
                        if ($this->input->post('position_id') == '') {
                                echo 'on_position';
                        } else {

                                $config['upload_path'] = './data_doc/img_user/';
                                $config['allowed_types'] = 'gif|jpg|png';
                                $config['encrypt_name']  = true;


                                $this->load->library('upload', $config);
                                if (!$this->upload->do_upload('img')) {


                                        $filename = '';
                                } else {
                                        $data = $this->upload->data();
                                        // print_r($data);
                                        $filename = $data['file_name'];
                                }




                                $password = "";
                                $position_id = implode(',', $this->input->post('position_id'));
                                $data = array(
                                        'fname' => $this->input->post('fname'),
                                        'lname' => $this->input->post('lname'),
                                        'email' => $this->input->post('email'),
                                        'phone' => $this->input->post('phone'),
                                        'position_id' => $position_id,
                                        'role' => $this->input->post('role'),
                                        'img' => $filename,
                                        'password' => $password

                                );
                                $query = $this->db->insert('user', $data);
                        }
                }
        }

        //----------------------แสดงรายชื่อสมาชิก-------------------------------------
        public function show_user()
        {
                //if ($position_id == '') {
                $this->db->select('DATE_FORMAT(u.user_time,"%d/%m/%y") as u_time,u.*');
                $this->db->from('user as u');
                // $this->db->join('position as p', 'u.position_id = p.position_id');
                return $this->db->get();
                /*} else {

                        $this->db->select('DATE_FORMAT(u.user_time,"%d/%m/%y") as u_time,u.*,p.*');
                        $this->db->from('user as u');
                        $this->db->join('position as p', 'u.position_id = p.position_id');
                        $this->db->where('p.position_id', $position_id);
                        return $this->db->get();
                }*/
        }
        //-------------------------แสดงรายชื่อตาม id ----------------------------------------
        public function show_user_id($user_id)
        {
                $this->db->select('u.password ,u.user_id,u.fname,u.lname,u.email,u.phone,u.position_id,u.role,u.user_time,u.img,u.delete_user_data');
                $this->db->from('user as u');
                //$this->db->join('position as p', 'u.position_id = p.position_id');
                $this->db->where('u.user_id', $user_id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                        $data = $query->row();
                        return $data;
                }
                return false;
        }
        //-------------------------แสดงรายชื่อตาม ตำแหน่ง ----------------------------------------
        public function show_user_p($position_id)
        {
                $this->db->select('u.*,p.*');
                $this->db->from('user as u');
                $this->db->join('position as p', 'u.position_id = p.position_id');
                $this->db->where('u.position_id', $position_id);
                $query = $this->db->get();
                return $query->result();
        }
        //--------------------------แก้ไขผู้ใช้งาน----------------------------------------------------------
        public function edit_user()
        {
                $config['upload_path'] = './data_doc/img_user/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['encrypt_name']  = true;


                $this->load->library('upload', $config);
                if ($this->session->userdata('role') == '0') {
                        if ($this->input->post('position_id') == '') {
                                echo 'not_position';
                        } else {
                                $position_id_r = implode(',', $this->input->post('position_id'));
                                $array_p_id = explode(',', $position_id_r);
                                $array_p_id_r = array_unique($array_p_id);
                                $position_id = implode(',', $array_p_id_r);

                                if (!$this->upload->do_upload('img')) {
                                        $data = array(
                                                'fname' => $this->input->post('fname'),
                                                'lname' => $this->input->post('lname'),
                                                'email' => $this->input->post('email'),
                                                'phone' => $this->input->post('phone'),
                                                'position_id' =>  $position_id,
                                                'role' => $this->input->post('role'),

                                        );
                                } else {
                                        $data = $this->upload->data();
                                        // print_r($data);
                                        $filename = $data['file_name'];
                                        $data = array(
                                                'fname' => $this->input->post('fname'),
                                                'lname' => $this->input->post('lname'),
                                                'email' => $this->input->post('email'),
                                                'phone' => $this->input->post('phone'),
                                                'position_id' => $position_id,
                                                'role' => $this->input->post('role'),
                                                'img' => $filename,
                                        );
                                }
                                $this->db->where('user_id', $this->input->post('id'));
                                $query = $this->db->update('user', $data);
                        }
                } else if ($this->session->userdata('role') == '1') {
                        if (!$this->upload->do_upload('img')) {
                                $data = array(
                                        'fname' => $this->input->post('fname'),
                                        'lname' => $this->input->post('lname'),
                                        'phone' => $this->input->post('phone'),


                                );
                        } else {
                                $data = $this->upload->data();
                                // print_r($data);
                                $filename = $data['file_name'];
                                $data = array(
                                        'fname' => $this->input->post('fname'),
                                        'lname' => $this->input->post('lname'),
                                        'phone' => $this->input->post('phone'),
                                        'img' => $filename,
                                );
                        }
                        $this->db->where('user_id', $this->input->post('id'));
                        $query = $this->db->update('user', $data);
                }
        }

        public function delete_user($user_id)
        {
                $delete = 1;
                $data = array(
                        'delete_user_data' => $delete
                );
                $this->db->where('user_id', $user_id);
                $query = $this->db->update('user', $data);
                if ($query) {
                } else {
                        echo '<script>';
                        echo ' alert("ลบใช้ไม่สำเร็จ")';
                        echo 'window.history.back()';
                        echo '</script>';
                }
        }
        public function user_recovery($user_id)
        {
                $delete = 0;
                $data = array(
                        'delete_user_data' => $delete
                );
                $this->db->where('user_id', $user_id);
                $query = $this->db->update('user', $data);
                if ($query) {
                } else {
                        echo '<script>';
                        echo ' alert("ลบใช้ไม่สำเร็จ")';
                        echo 'window.history.back()';
                        echo '</script>';
                }
        }
        public function delete_user_permanent($user_id)
        {
                $this->db->select();
                $this->db->from('user');
                $this->db->where('user.user_id ', $user_id);
                $query = $this->db->get();
                $data = $query->row();
                if ($data->img == '') {
                        $this->db->delete('user', array('user_id' => $user_id));
                } else {
                        $filename = "././data_doc/img_user/$data->img";
                        (unlink($filename));
                        $this->db->delete('user', array('user_id' => $user_id));
                }
        }
        //------------------login---------------------------------------------
        public function login($email)
        {
                $this->db->select('u.*');
                $this->db->from('user as u');
                $this->db->where('u.email', $email);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                        $data = $query->row();
                        return $data;
                }
                return false;
        }
        //------------------------------------เช็คอีเมล-------------------------
        public function email_check()
        {
                $email = $this->input->post('email');
                $user_id = $this->input->post('user_id');
                $this->db->select();
                $this->db->where('email', $email);
                $query = $this->db->get('user');
                $num = $query->num_rows();
                $data = $query->row();
                if ($user_id == '' || $user_id == null) {
                        if ($num > 0) {
                                echo 'taken';
                        } else {
                                echo 'not_taken';
                        }
                } else {
                        if ($num <= 0) {
                                echo 'not_taken';
                        } else if ($num > 0 && $user_id == $data->user_id) {
                                echo 'not_taken';
                        } else if ($num > 0 && $user_id != $data->user_id) {
                                echo 'taken';
                        }
                }

                exit();
        }
        //-----------------------------เช็ครหัสผ่าน-----------------------------------
        public function password_check()
        {
                $password = $this->input->post('password');
                $this->db->select('u.user_id,u.password');
                $this->db->from('user as u');
                $this->db->where('u.user_id', $this->session->userdata('user_id'));
                $query = $this->db->get();
                $data = $query->row();
                if (password_verify($password, $data->password)) {
                        echo 'correct';
                } else {
                        echo 'incorrect';
                }
                exit();
        }
        //------------------------------เปลี่ยนรหัสผ่าน---------------------------------------------------------
        public function newPassword()
        {
                //$d_password = $this->input->post('d_password');
                $n_password = $this->input->post('n_password');
                //if (password_verify($d_password, $data->password)) {
                $options = [
                        'cost' => 12,
                ];
                $password_new = password_hash($n_password, PASSWORD_BCRYPT, $options);
                $data = array(
                        'password' => $password_new
                );
                $this->db->where('user_id', $this->session->userdata('user_id'));
                $query = $this->db->update('user', $data);
                if ($query) {
                        echo 'correct';
                } else {
                        echo 'failed';
                }
                /* } else {
                        echo 'incorrect';
                }*/
                exit();
        }
        //------------------------------reset รหัสผ่าน---------------------------------------------------------
        public function reset_Password()
        {
                $password = "";

                $data = array(
                        'password' => $password
                );
                $this->db->where('user_id', $this->input->post('user_id'));
                $query = $this->db->update('user', $data);

                exit();
        }
        //----------------------ค้นหา------------------------------------------------------------------
        function search_user($query)
        {
                $this->db->select('u.*,p.*');
                $this->db->from('user as u');
                $this->db->join('position as p', 'u.position_id = p.position_id');

                if ($query != '') {
                        $this->db->like('u.fname', $query);
                        $this->db->or_like('u.lname', $query);
                        $this->db->or_like('u.lname', $query);
                        $this->db->or_like('p.position_name', $query);
                }
                $this->db->order_by('u.user_id', 'DESC');
                return $this->db->get();
        }
        //-------------------เช็คสถานะ--------------------------------------------------
        public function check_status($user_id)
        {
                $this->db->select('user.user_id,user.delete_user_data');
                $this->db->from('user');
                $this->db->where('user.user_id', $user_id);
                $query = $this->db->get();
                return $query->row();
        }
        //-------------------เช็คเบอร์โทร---------------------------------------
        public function check_phone()
        {
                $phone = $this->input->post('phone');
                $user_id = $this->input->post('user_id');
                $this->db->select();
                $this->db->where('phone', $phone);
                $query = $this->db->get('user');
                $num = $query->num_rows();
                $data = $query->row();
                if ($user_id == '' || $user_id == null) {
                        if ($num > 0) {
                                echo 'taken';
                        } else {
                                echo 'not_taken';
                        }
                } else {
                        if ($num <= 0) {
                                echo 'not_taken';
                        } else if ($num > 0 && $user_id == $data->user_id) {
                                echo 'not_taken';
                        } else if ($num > 0 && $user_id != $data->user_id) {
                                echo 'taken';
                        }
                }

                exit();
        }

        public function user_id($user_id)
        {
                $this->db->select('u.user_id,u.position_id');
                $this->db->from('user as u');
                $this->db->where('u.user_id', $user_id);
                
                $query = $this->db->get();
                return $query->result();
        }
}
