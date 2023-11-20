<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv_import extends CI_Controller
 { 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('csv_import_model');
  $this->load->library('csvimport');
 }

 function index()
 {
  $this->load->view('csv_import');
 }

 function display_data()
 {
  $result = $this->csv_import_model->select();
  $output = '
   <h3 align="center">User Details Imported from CSV</h3>
        <div class="table table-bordered">
         <table class="table table-bordered table-striped">
          <tr>
           <th>Sr.No</th>
           <th>Name</th>
           <th>Email</th>
		   <th>Mobile</th>
          </tr>
  ';
  $count = 0;
  if($result->num_rows() > 0)
  {
   foreach($result->result() as $row)
   {
    $count = $count + 1;
    $output .= '
    <tr>
     <td>'.$count.'</td>
     <td>'.$row->name.'</td>
     <td>'.$row->email.'</td>
	 <td>'.$row->phone.'</td>
    </tr>';
   }
  }
  else
  {
   $output .= '
   <tr>
       <td colspan="5" align="center">Data not Available</td>
      </tr>
   ';
  }
  $output .= '</table></div>';
  echo $output;
 }

 function import_csv()
 {
  $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
  foreach($file_data as $row)
  {
   $data[] = array(
    'name' => $row["Name"],
     'phone'   => $row["Phone"],
     'email'   => $row["Email"]
   );
  }
  $this->csv_import_model->insert($data);
 }
}
