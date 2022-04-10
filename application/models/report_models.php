<?php
class report_models extends CI_Model
{
    public function count_category()
    {
       
        $this->db->select('COUNT(delete_category) as c_total');
        $this->db->from('category');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_doc()
    {
       
        $this->db->select('COUNT(document_id) as d_total');
        $this->db->from('document');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_user()
    {
    
        $this->db->select('COUNT(user_id) as u_total');
        $this->db->from('user');
       
        $query = $this->db->get();
        return $query->result();
    }


    /*public function count_d()
    {
        $i=0;
           $this->db->select('COUNT(user_id) as u_dtotal');
           $this->db->from('user');
           $this->db->where('delete_user_data',$i);
           $user=$this->db->get();
          
           $this->db->select('COUNT(document_id) as d_dtotal');
           $this->db->from('document');
           $this->db->where('delete_doc_data',$i);
           $doc=$this->db->get();
         
           $this->db->select('COUNT(delete_category) as c_dtotal');
           $this->db->from('category');
           $this->db->where('delete_category',$i);
           $category=$this->db->get();

           
           
           
    }*/

    public function count_doc_month($year)
    {

        if ($year == "") {
            $this->db->select('DATE_FORMAT(h.time,"%Y") as year,COUNT(h.document_id) as d_p_total');
            $this->db->from('document as h');
            $this->db->group_by('DATE_FORMAT(h.time,"%Y")');
            return $this->db->get();
        } else if ($year != "") {
            $this->db->select('DATE_FORMAT(h.time,"%Y") as year,DATE_FORMAT(h.time,"%M") as month,COUNT(h.document_id) as d_p_total');
            $this->db->from('document as h');
            $this->db->group_by('DATE_FORMAT(h.time,"%Y%M")');
            return $this->db->get();
        }
    }
    public function year()
    {
        $this->db->select('DATE_FORMAT(h.time,"%Y") as year');
        $this->db->from('document as h');
        $this->db->group_by('DATE_FORMAT(h.time,"%Y%")');
        $this->db->order_by('h.time', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function report_h($day_s, $day_e)
    {
        if ($day_s == '' && $day_e == '') {
            $this->db->select('COUNT(document_id) as h_total');
            $this->db->from('document');
            $query = $this->db->get();
            return $query->result();
        } else if ($day_s != '' && $day_e != '') {
            $this->db->select('COUNT(document_id) as h_total');
            $this->db->from('document as h');
            $this->db->where('h.time>=', $day_s)->where('h.time<=', $day_e);
            $query = $this->db->get();
            return $query->result();
        }else if ($day_s != '' && $day_e == '') {
            $this->db->select('COUNT(document_id) as h_total');
            $this->db->from('document as h');
            $this->db->where('h.time>=', $day_s);
            $query = $this->db->get();
            return $query->result();
        }else if ($day_s == '' && $day_e != '') {
            $this->db->select('COUNT(document_id) as h_total');
            $this->db->from('document as h');
            $this->db->where('h.time<=', $day_e);
            $query = $this->db->get();
            return $query->result();
        }

    }
    public function report_c($day_s, $day_e)
    {
        if ($day_s == '' && $day_e == '') {
            $this->db->select('h.time,c.Category_name,COUNT(document_id) as c_total');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.category_id');
            $this->db->group_by('h.category_id');
            $query = $this->db->get();
            return $query->result();
        } else if ($day_s != '' && $day_e != '') {
            $this->db->select('h.time,c.Category_name,COUNT(document_id) as c_total');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.category_id');
            $this->db->where('h.time>=', $day_s)->where('h.time<=', $day_e);
            $this->db->group_by('h.category_id');
            $query = $this->db->get();
            return $query->result();
        } else if ($day_s != '' && $day_e == '') {
            $this->db->select('h.time,c.Category_name,COUNT(document_id) as c_total');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.category_id');
            $this->db->where('h.time>=', $day_s);
            $this->db->group_by('h.category_id');
            $query = $this->db->get();
            return $query->result();
        } else if ($day_s == '' && $day_e != '') {
            $this->db->select('h.time,c.Category_name,COUNT(document_id) as c_total');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.category_id');
            $this->db->where('h.time<=', $day_e);
            $this->db->group_by('h.category_id');
            $query = $this->db->get();
            return $query->result();
        }
    }
    public function report_d($day_s, $day_e)
    {
        if ($day_s == '' && $day_e == '') {
            $this->db->select('DATE_FORMAT(h.time,"%d/%m/%Y") as year,h.document_id,h.time,h.document_name,h.number_doc,h.delete_doc_data,h.category_id,c.Category_id,c.Category_name,a.*');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.Category_id');
            $this->db->join('access_doc as a', 'a.document_id = h.document_id');
            $this->db->order_by('h.time', 'DESC');
            $query = $this->db->get();
            return $query->result();
        } else if ($day_s != '' && $day_e != '') {
            $this->db->select('DATE_FORMAT(h.time,"%d/%m/%Y") as year,h.document_id,h.time,h.document_name,h.number_doc,h.delete_doc_data,h.category_id,c.Category_id,c.Category_name,a.*');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.Category_id');
            $this->db->join('access_doc as a', 'a.document_id = h.document_id');
            $this->db->where('h.time>=', $day_s)->where('h.time<=', $day_e);
            $this->db->order_by('h.time', 'DESC');
            $query = $this->db->get();
            return $query->result();
        } else if ($day_s == '' && $day_e != '') {
            $this->db->select('DATE_FORMAT(h.time,"%d/%m/%Y") as year,h.document_id,h.time,h.document_name,h.number_doc,h.delete_doc_data,h.category_id,c.Category_id,c.Category_name,a.*');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.Category_id');
            $this->db->join('access_doc as a', 'a.document_id = h.document_id');
            $this->db->where('h.time<=', $day_e);
            $this->db->order_by('h.time', 'DESC');
            $query = $this->db->get();
            return $query->result();
        } else if ($day_s != '' && $day_e == '') {
            $this->db->select('DATE_FORMAT(h.time,"%d/%m/%Y") as year,h.document_id,h.time,h.document_name,h.number_doc,h.delete_doc_data,h.category_id,c.Category_id,c.Category_name,a.*');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.Category_id');
            $this->db->join('access_doc as a', 'a.document_id = h.document_id');
            $this->db->where('h.time>=', $day_s);
            $this->db->order_by('h.time', 'DESC');
            $query = $this->db->get();
            return $query->result();
        }
    }
    public function report_u($day_s, $day_e,$user_id,$position_id){
        $sql = array('0'); // Stop errors when $words is empty
        $array_p_id = explode(',', $position_id);
       // $position_id = implode(',', $array_p_id);
        foreach($array_p_id as $p){
                    $sql[] = 'position_id LIKE %'.$p.'%';
            }
            $this->db->select('a.*');
            $this->db->from('access_doc as a');
            //$this->dv->join('document as h','a.document_id = h.document_id');
            $this->db->like('a.position_id',$sql); 
            $query = $this->db->get();
            return $query->result();
       
    }

    public function report_d_c($day_s, $day_e,$category_id)
    {
        if ($day_s == '' && $day_e == '') {
            $this->db->select('DATE_FORMAT(h.time,"%d/%m/%Y") as year,h.document_id,h.time,h.document_name,h.number_doc,h.delete_doc_data,h.category_id,c.Category_id,c.Category_name,a.*');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.Category_id');
            $this->db->join('access_doc as a', 'a.document_id = h.document_id');
            $this->db->where('h.category_id',$category_id);
            $this->db->order_by('h.time', 'DESC');
            $query = $this->db->get();
            return $query->result();
        } else if ($day_s != '' && $day_e != '') {
            $this->db->select('DATE_FORMAT(h.time,"%d/%m/%Y") as year,h.document_id,h.time,h.document_name,h.number_doc,h.delete_doc_data,h.category_id,c.Category_id,c.Category_name,a.*');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.Category_id');
            $this->db->join('access_doc as a', 'a.document_id = h.document_id');
            $this->db->where('h.time>=', $day_s)->where('h.time<=', $day_e)->where('h.category_id',$category_id);
            $this->db->order_by('h.time', 'DESC');
            $query = $this->db->get();
            return $query->result();
        } else if ($day_s == '' && $day_e != '') {
            $this->db->select('DATE_FORMAT(h.time,"%d/%m/%Y") as year,h.document_id,h.time,h.document_name,h.number_doc,h.delete_doc_data,h.category_id,c.Category_id,c.Category_name,a.*');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.Category_id');
            $this->db->join('access_doc as a', 'a.document_id = h.document_id');
            $this->db->where('h.time<=', $day_e)->where('h.category_id',$category_id);
            $this->db->order_by('h.time', 'DESC');
            $query = $this->db->get();
            return $query->result();
        } else if ($day_s != '' && $day_e == '') {
            $this->db->select('DATE_FORMAT(h.time,"%d/%m/%Y") as year,h.document_id,h.time,h.document_name,h.number_doc,h.delete_doc_data,h.category_id,c.Category_id,c.Category_name,a.*');
            $this->db->from('document as h');
            $this->db->join('category as c', 'h.category_id = c.Category_id');
            $this->db->join('access_doc as a', 'a.document_id = h.document_id');
            $this->db->where('h.time>=', $day_s)->where('h.category_id',$category_id);;
            $this->db->order_by('h.time', 'DESC');
            $query = $this->db->get();
            return $query->result();
        }
    }
    
}
