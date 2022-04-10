<?php
class category_models extends CI_Model
{

        //---------------------------ประเภทเอกสาร--------------------------------------------
        public function show_category()
        {
                $query = $this->db->get('category');
                return $query->result();
        }
        //------------------------แสดงตาม id-----------------------------------------------
        public function show_category_id($Category_id)
        {
                $this->db->select();
                $this->db->from('category as c ');
                $this->db->where('c.Category_id', $Category_id);
                $query = $this->db->get();
                return $query->result();
        
        }
        //-------------------------เพิ่มหมวดหมู่----------------------------------------------
        public function add_category()
        {
                $data = array(
                        'Category_name' => $this->input->post('Category_name'),
                );
                $query = $this->db->insert('category', $data);

                if ($query) {
                      
                } else {
                        echo '<script>';
                        echo ' alert("บันทึกหมวดหมู่ไม่สำเร็จ")';
                        echo 'window.history.back()';
                        echo '</script>';
                }
        }
        //---------------------ลบหมวดหมู่-----------------------------------------------------
        public function delete_category($Category_id)
        {
                $delete = 1;
                $data = array(
                        'delete_category' => $delete
                );
                $this->db->where('Category_id', $Category_id);
                $query = $this->db->update('category', $data);

                $category_id_doc = 6;
                $data_doc = array(
                        'category_id' => $category_id_doc
                );
                $this->db->where('category_id', $Category_id);
                $query = $this->db->update('document', $data_doc);

              

                if ($query) {
                        
                } else {
                        echo '<script>';
                        echo ' alert("ลบเอกสารไม่สำเร็จ")';
                        echo 'window.history.back()';
                        echo '</script>';
                }
        }
        //---------------------กู้คืนหมวดหมู่-----------------------------------------------------
        public function recover_category($Category_id)
        {
                $delete = 0;
                $data = array(
                        'delete_category' => $delete
                );
                $this->db->where('Category_id', $Category_id);
                $query = $this->db->update('category', $data);
                if ($query) {
                     
                } else {
                        echo '<script>';
                        echo ' alert("กู้คืนเอกสารไม่สำเร็จ")';
                        echo 'window.history.back()';
                        echo '</script>';
                }
        }
        public function  delete_category_p($Category_id)
        {

                $this->db->delete('category', array('Category_id' => $Category_id));
        }
        public function  edit_category()
        {

                  $data = array('Category_name' => $this->input->post('Category_name'),);
                  $this->db->where('Category_id', $this->input->post('Category_id'));
                  $query = $this->db->update('category', $data);
        }
}
