<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class PenEtalase extends Auth
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('PenEtalase_model');
  }

  public function index(){
    $cab = $this->session->userdata('id_toko');
    $data['barangcabang'] = $this->second->barangCabang($cab);
    $data['setcabang'] = $this->first->getCabang();
    $data['content'] = $this->load->view('kasir/etalase_toko', '', true);
    $data['modal'] = '';
    $data['css'] = '
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/datatables.css') . '">
    <link rel="stylesheet" type="text/css" href="' . base_url('assets/css/vendors/select2.css') . '">
    <link rel="stylesheet" type="text/css" href="'.base_url('assets/css/vendors/sweetalert2.css').'">
    <style>
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 2px !important;
        }
        .select2-dropdown--below {
          margin-top:-2% !important;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .select2-container{
          margin-bottom :-6%;
        }
        table.dataTable input,
        table.dataTable select {
          border: 1px solid #efefef;
          height: 24px !important;
        }
    </style>
    ';
    $data['js'] = '
    <script>var base_url = "' . base_url() . '";</script>
    <script src="' . base_url('assets/js/sweet-alert/sweetalert.min.js').'"></script>
    <script src="' . base_url('assets/js/select2/select2.full.min.js') . '"></script>
    <script src="' . base_url('assets/js/additional-js/petalase.js?v='.time().'') . '"></script>
    <script src="' . base_url('assets/js/additional-js/id.js') . '"></script>
    <script src="' . base_url('assets/js/modalpage/validation-modal.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatables/jquery.dataTables.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/jszip.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.colVis.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/vfs_fonts.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.select.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/buttons.html5.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') . '"></script>
    <script src="' . base_url('assets/js/datatable/datatable-extension/custom.js') . '"></script>
    ';
    $this->load->view('layout/base', $data);
  }

  public function loadproduk(){
    $this->load->library('datatables');
    $supp = $this->input->post('supp'); 
    $cabr = $this->input->post('cabr'); 
    $tipe = $this->input->post('tipe'); 
    $this->datatables->select('id_keluar,id_masuk,sn_brg,nama_brg,jenis,id_supplier,nama_supplier,id_toko,nama_toko,
    hrg_hpp,hrg_jual,margin,hrg_cashback,status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->where('status','2');
    if (!empty($supp) && $supp !== '0') {
      $this->datatables->where('id_supplier', $supp);
    }
    if (!empty($cabr) && $cabr !== '0') {
        $this->datatables->where('id_toko', $cabr);
    }
    if (!empty($tipe) && $tipe !== '0') {
        $this->datatables->where('jenis', $tipe);
    }
    return print_r($this->datatables->generate());
  }
  public function filtersupp($cab=null,$cabr=null, $tipe=null){
    $this->load->library('datatables');
    $this->datatables->select('id_keluar,sn_brg,nama_brg,jenis,id_supplier,nama_supplier,nama_toko,
    hrg_hpp,hrg_jual,margin,hrg_cashback,status');
    $this->datatables->from('vbarangkeluar');
    $this->datatables->where('status','2');
    $this->datatables->where('nama_supplier',$cab);
    $this->datatables->where('nama_toko',$cabr);
    $this->datatables->where('jenis',$tipe);
    return print_r($this->datatables->generate());    
  }
  public function infoBrg($id){
    $data['get_id']= $this->PenEtalase_model->getWhere($id);
    echo json_encode($data);
  }  
  public function updatepost() {
    if ($this->input->is_ajax_request()) {
        $json_data = $this->input->raw_input_stream;
        $checkedData = json_decode($json_data, true);
        if (!empty($checkedData)) {
            foreach ($checkedData as $data) {
                $idk = $data['idk'];
                $idm = $data['idm'];
                $hrg_hpp = $data['ehpp'];
                $hrg_jual = $data['ehj'];
                $margin = $data['emg'];
                $hrg_cb = $data['ecb'];

                $this->PenEtalase_model->update($idk, [
                    'hrg_hpp' => $hrg_hpp,
                    'hrg_jual' => $hrg_jual,
                    'margin' => $margin,
                    'hrg_cashback' => $hrg_cb
                ]);
                $this->PenEtalase_model->updatebm($idm, [
                    'hrg_hpp' => $hrg_hpp,
                    'hrg_jual' => $hrg_jual,
                    'hrg_cashback' => $hrg_cb
                ]);
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
        }
    } else {
        redirect('etalase-toko');
    }
  }

}


/* End of file PenEtalase.php */
/* Location: ./application/controllers/PenEtalase.php */