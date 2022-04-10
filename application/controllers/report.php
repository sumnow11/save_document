<?php
defined('BASEPATH') or exit('No direct script access allowed');

class report extends CI_Controller
{
     function __construct()
     {
          parent::__construct();

          $this->load->model('report_models');
          $this->load->model('users_models');
          $this->load->model('category_models');
          $check['check'] = $this->users_models->check_status($this->session->userdata('user_id'));

          if ($check['check']->delete_user_data != '0') {
               redirect("login");
          }
     }
     function report_category()
     {
          $output = array();
          $data = $this->report_models->count_category();
          foreach ($data as $row) {
               $output['Category_total'] = $row->c_total;
          }
          echo json_encode($output);
     }
     function report_doc()
     {
          $output = array();
          $data = $this->report_models->count_doc();
          foreach ($data as $row) {
               $output['doc_total'] = $row->d_total;
          }
          echo json_encode($output);
     }

     function report_user()
     {
          $output = array();
          $data = $this->report_models->count_user();
          foreach ($data as $row) {
               $output['user_total'] = $row->u_total;
          }
          echo json_encode($output);
     }


     function chart_doc()
     {

          $chart_data = $this->report_models->count_doc_month($this->input->post('year'));
          $output = array();
          $data = array();
          if ($this->input->post('year') == '') {
               foreach ($chart_data->result() as $row) {
                    $chart = array();
                    $chart['x'] = $row->year;
                    $chart['y'] = $row->d_p_total;

                    $data[] = $chart;
               }
               $output = $data;
               echo json_encode($output);
          } else if ($this->input->post('year') != '') {
               foreach ($chart_data->result() as $row) {
                    if ($row->year == $this->input->post('year')) {
                         $chart = array();
                         $chart['x'] = $row->month;
                         $chart['y'] = $row->d_p_total;

                         $data[] = $chart;
                    }
               }
               $output = $data;
               echo json_encode($output);
          }
     }
     function report_h()
     {
          $report_h = $this->report_models->report_h($this->input->post('day_s'), $this->input->post('day_e'));
          $report_c = $this->report_models->report_c($this->input->post('day_s'), $this->input->post('day_e'));
          $report_d = $this->report_models->report_d($this->input->post('day_s'), $this->input->post('day_e'));
          $output_h = '';
          if (empty($report_d) || empty($report_c)) {
               $output_h .= '  <div>
                              <hr>
                                   <h4 class="mt-2" style="text-align: center">ไม่พบข้อมูล</h4>
                              </div>
                              <hr>
                              ';
          } else {
               $output_h .= ' <hr>
                              <div class="row px-4" id="re_prin">
                              <div class="row>
                                   <h4 style="float:right; align = "center">
                                        <b style="font-size:20px;">รายงานเอกสารเข้า</b>
                                   </h4>
                                   
                                   
                                   <a class="btn btn-secondary mb-0 corners shadow print_button" type="button" style="float:right; font-size: 20px;margin-right:10px;"id="print_button"onclick="printWindow();"><i class="bi bi-printer-fill"></i></a>
                              </div>
                                  
                              <div class="mt-2">
                                   <p style="font-size:16px;"><b><?php echo nbs(5); ?>วันที่ : </b>' . $this->input->post('day_s') . ' - ' . $this->input->post('day_e') . '</p>';
               foreach ($report_h as $row) {
                    $output_h .= '<p style="font-size:16px;"><b>จำนวนเอกสารเข้า :  </b>' . $row->h_total . '<b> ฉบับ</b></p>';
               }
               $output_h .= '   <div class="mt-2"  id="report_c">
                                    <p style="font-size:16px;"> <b><?php echo nbs(5); ?>หมวดหมู่</b></p>
                               <div class="row">
                               <table style="width:100%">
                                   
                               ';
               foreach ($report_c as $row) {
                    $output_h .= '<tr>
                                   <td ><p style="font-size:16px;">' . nbs(1) . ' </p></td>
                                   <td class="d-none d-md-table-cell" style="width:20%"><p style="font-size:16px;">- ' . $row->Category_name . ':</p></td>
                                   <td class="d-table-cell d-md-none " style="width:50%"><p style="font-size:16px;">- ' . $row->Category_name . ':</p></td>
                                   <td style="width:5%"><p style="font-size:16px;">' . $row->c_total . '</p> </td>
                                   <td><p style="font-size:16px;">   ฉบับ </p></td>
                                   </tr>
                             ';
               }
               $output_h .= ' 
               </table>
               </div>
               </div> 
                            <div class="mt-2"  id="report_d">
                                   <p style="font-size:16px;"> <b><?php echo nbs(5); ?>รายชื่อเอกสาร</b></p>
                                   <div class="row">
                                   <table style="width:100%">

                               
                                   ';
               foreach ($report_d as $row) {
                    $output_h .= ' <tr> 
                                   <td class="d-table-cell d-md-none"><p style="font-size:16px;">' . nbs(1) . ' </p></td>
                                   <td class="d-none d-md-table-cell"><p style="font-size:16px;">' . nbs(10) . ' </p></td>
                                   <td><p style="font-size:16px;">' . $row->year . '</p></td>
                                  
                                   <td><p style="font-size:16px;"> ' . $row->document_name . '</p></td>
                                   <td class="d-none d-md-table-cell"><p style="font-size:16px;"> ' . $row->Category_name . '</p></td>
                                   </tr>';
               }

               $output_h .= '   </table>  </div>
                         </div>';
          }
          echo $output_h;
     }

     function report_u()
     {
          $report_d = $this->report_models->report_d($this->input->post('day_s'), $this->input->post('day_e'));
          $user_id_r = $this->users_models->show_user_id($this->input->post('user_id_re'));
          $user_id_re = $user_id_r->user_id;
          $position_id_re = $user_id_r->position_id;
          $category = $this->category_models->show_category();
          $output_h = '';
          if (empty($report_d)) {
               $output_h .= '  <div>
                                   <hr>
                                        <h4 class="mt-2" style="text-align: center">ไม่พบข้อมูล</h4>
                                   </div>
                              <hr>
                              ';
          } else {

               $num = array();
               foreach ($report_d as $r) {
                    if ($r->delete_doc_data == 0) {
                         if ($r->access == 0) {
                              $num[] = $r->Category_id;
                         } else if ($r->access == 1) {
                              $id = '';
                              $array_p_id = explode(',', $r->position_id);
                              $array_u_id = explode(',', $r->user_id);
                              $array_up_id = explode(',', $position_id_re);

                              if ($array_p_id[0] != 0 || $array_u_id[0] != 0) {
                                   foreach ($array_up_id as $up) {
                                        foreach ($array_p_id as $value) {
                                             if ($value == $up) {
                                                  if ($id != $r->document_id) {
                                                       $num[] = $r->Category_id;
                                                       $id = $r->document_id;
                                                  }
                                             }
                                        }
                                   }
                                   foreach ($array_u_id as $value_u) {
                                        if ($id != $r->document_id) {
                                             if ($value_u == $user_id_re) {
                                                  $num[] = $r->Category_id;
                                                  $id = $r->document_id;
                                             }
                                        }
                                   }
                              }
                         }
                    }
               }
               $count_category = array_count_values($num);
               $count_doc = count($num);
               $output_h .= ' <hr>
               <div class="row px-4" id="re_prin">
                    <div class="row>
                         <h4 style="float:right; align = "center">
                              <b style="font-size:20px;">รายงานเอกสารเข้า</b>
                         </h4>
                         <a class="btn btn-secondary mb-0 corners shadow print_button" type="button" style="float:right; font-size: 20px;margin-right:10px;"id="print_button"onclick="printWindow();"><i class="bi bi-printer-fill"></i></a>
                    </div>
                   
               <div class="mt-2">
                    <p style="font-size:16px;"><b><?php echo nbs(5); ?>เอกสารของ : </b>' . $user_id_r->fname  . ' ' . $user_id_r->lname .  '</p>
                    <p style="font-size:16px;"><b><?php echo nbs(5); ?>วันที่ : </b>' . $this->input->post('day_s') . ' - ' . $this->input->post('day_e') . '</p>';
               $output_h .= '<p style="font-size:16px;"><b>จำนวนเอกสารเข้า :  </b>' . $count_doc . '<b> ฉบับ</b></p>';
               $output_h .= '  
                          <div class="mt-2"  id="report_c">

              
          ';

               $output_h .= ' 
                           
                             </div>
                             </div> 
                                          <div class="mt-2"  id="report_d">
                                                 <p style="font-size:16px;"> <b><?php echo nbs(5); ?>รายชื่อเอกสาร</b></p>
                                                 <div class="row">
                                                 <table style="width:100%;border:1px">
                                                  <tr style="border:1px" align="center">
                                                       <th style="border:1px solid black;width:12%">วัน/เดือน/ปี</th>
                                                       <th style="border:1px solid black;width:15%">เลขที่เอกสาร</th>
                                                       <th style="border:1px solid black">ชื่อ</th>
                                                       <th class="d-none d-md-table-cell" style="border:1px solid black;width:15%">หมวดหมู่</th>
                                                  </tr>
                                             
                                                 ';

               foreach ($report_d as $r) {
                    if ($r->delete_doc_data == 0) {
                         if ($r->access == 0) {
                              $output_h .= ' 
                                   <tr > 
                                        <td style="border:1px solid black;" align="center"><p>' . $r->year . '</p></td>
                                        <td style="border:1px solid black"><p>&nbsp&nbsp' . $r->number_doc . '</th>
                                        <td style="border:1px solid black"><p > &nbsp&nbsp' . $r->document_name . '</p></td>
                                        <td class="d-none d-md-table-cell" style="border:1px solid black"><p style="font-size:16px;"> &nbsp&nbsp' . $r->Category_name . '</p></td>
                                   </tr>';
                         } else if ($r->access == 1) {
                              $id = '';
                              $array_p_id = explode(',', $r->position_id);
                              $array_u_id = explode(',', $r->user_id);
                              $array_up_id = explode(',', $position_id_re);

                              if ($array_p_id[0] != 0 || $array_u_id[0] != 0) {
                                   foreach ($array_up_id as $up) {
                                        foreach ($array_p_id as $value) {
                                             if ($value == $up) {
                                                  if ($id != $r->document_id) {
                                                       $output_h .= ' 
                                                       <tr> 
                                                            
                                                            <td style="border:1px solid black" align="center"><p style="font-size:16px;">' . $r->year . '</p></td>
                                                            <td style="border:1px solid black"><p style="font-size:16px;">&nbsp&nbsp' . $r->number_doc . '</th>
                                                            <td style="border:1px solid black"><p style="font-size:16px;"> &nbsp&nbsp' . $r->document_name . '</p></td>
                                                            <td class="d-none d-md-table-cell" style="border:1px solid black"><p style="font-size:16px;"> &nbsp&nbsp' . $r->Category_name . '</p></td>
                                                       </tr>';
                                                       $id = $r->document_id;
                                                  }
                                             }
                                        }
                                   }
                                   foreach ($array_u_id as $value_u) {
                                        if ($id != $r->document_id) {
                                             if ($value_u == $user_id_re) {
                                                  $output_h .= ' 
                                                  <tr > 
                                                      
                                                       <td style="border:1px solid black" align="center"><p style="font-size:16px;" >' . $r->year . '</p></td>
                                                       <td style="border:1px solid black"><p style="font-size:16px;">&nbsp&nbsp' . $r->number_doc . '</th>
                                                       <td style="border:1px solid black"><p style="font-size:16px;"> &nbsp&nbsp' . $r->document_name . '</p></td>
                                                       <td class="d-none d-md-table-cell" style="border:1px solid black"><p style="font-size:16px;"> &nbsp&nbsp' . $r->Category_name . '</p></td>
                                                  </tr>';
                                                  $id = $r->document_id;
                                             }
                                        }
                                   }
                              }
                         }
                    }
               }
               $output_h .= '   </table>  </div>
               </div>';
          }
          echo $output_h;
     }
     function category_report()
     {
          $report_d = $this->report_models->report_d_c($this->input->post('day_s'), $this->input->post('day_e'),$this->input->post('category_id'));
          $category = $this->category_models->show_category_id($this->input->post('category_id'));
          $output_h = '';
          if (empty($report_d)) {
               $output_h .= '  <div>
                                   <hr>
                                        <h4 class="mt-2" style="text-align: center">ไม่พบข้อมูล</h4>
                                   </div>
                              <hr>
                              ';
          } else {

               $num = array();
               foreach ($report_d as $r) {
                    $num[] = $r->Category_id;
               }
               $count_category = array_count_values($num);
               $count_doc = count($num);
               $output_h .= ' <hr>
               <div class="row px-4" id="re_prin">
                    <div class="row>
                         <h4 style="float:right; align = "center">
                              <b style="font-size:20px;">รายงานเอกสารเข้า</b>
                         </h4>
                         <a class="btn btn-secondary mb-0 corners shadow print_button" type="button" style="float:right; font-size: 20px;margin-right:10px;"id="print_button"onclick="printWindow();"><i class="bi bi-printer-fill"></i></a>
                    </div>
                   
               <div class="mt-2">';
               foreach($category as $cs){
                    $output_h .='   <p style="font-size:16px;"><b><?php echo nbs(5); ?>เอกสารหมวดหมู่ : </b>' .$cs->Category_name.'</p>';
               }    
               $output_h .='   <p style="font-size:16px;"><b><?php echo nbs(5); ?>วันที่ : </b>' . $this->input->post('day_s') . ' - ' . $this->input->post('day_e') . '</p>';
               $output_h .= '<p style="font-size:16px;"><b>จำนวนเอกสารเข้า :  </b>' . $count_doc . '<b> ฉบับ</b></p>';
               $output_h .= '  
                          <div class="mt-2"  id="report_c">

              
          ';

               $output_h .= ' 
                           
                             </div>
                             </div> 
                                          <div class="mt-2"  id="report_d">
                                                 <p style="font-size:16px;"> <b><?php echo nbs(5); ?>รายชื่อเอกสาร</b></p>
                                                 <div class="row">
                                                 <table style="width:100%;border:1px">
                                                  <tr style="border:1px" align="center">
                                                       <th style="border:1px solid black;width:12%">วัน/เดือน/ปี</th>
                                                       <th style="border:1px solid black;width:15%">เลขที่เอกสาร</th>
                                                       <th style="border:1px solid black">ชื่อ</th>
                                                       <th class="d-none d-md-table-cell" style="border:1px solid black;width:15%">หมวดหมู่</th>
                                                  </tr>
                                             
                                                 ';

               foreach ($report_d as $r) {
                   
                              $output_h .= ' 
                                   <tr > 
                                        <td style="border:1px solid black;" align="center"><p>' . $r->year . '</p></td>
                                        <td style="border:1px solid black"><p>&nbsp&nbsp' . $r->number_doc . '</th>
                                        <td style="border:1px solid black"><p > &nbsp&nbsp' . $r->document_name . '</p></td>
                                        <td class="d-none d-md-table-cell" style="border:1px solid black"><p style="font-size:16px;"> &nbsp&nbsp' . $r->Category_name . '</p></td>
                                   </tr>';
                         
                    }
                    $output_h .= '   </table>  </div>
               </div>';
               }
               echo $output_h;
          }

      
     }

