<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ip extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
			parent::__construct();
			$this->load->helper('url'); 
			$this->load->model('m_ip',"m");
			$this->load->model('m_auth');
			$this->m_auth->cek_login();
	}
		
	public function index(){
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/ip/view');
		$this->load->view('_template/footer');
	}

	public function show_data(){
		$list = $this->m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->Nama;
            $row[] = $field->Bobot." ".$field->Satuan;
            $row[] = $field->Keterangan;
            $row[] = "<center><span class='btn-group'><a data-toggle='tooltip' href='".base_url()."ip/edit?Id=".$field->Id."' title='Ubah Data' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i></a><a data-toggle='tooltip' href='javascript:void(0)' title='Hapus Data' onclick='HapusData(".$field->Id.")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></span></center>";
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m->count_all(),
            "recordsFiltered" => $this->m->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
	}

	public function tambah(){
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/ip/tambah');
		$this->load->view('_template/footer');
	}

	public function edit(){
		$Id = $this->input->get("Id");
		$data['Item'] = $this->m->get_data($Id);
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/ip/edit',$data);
		$this->load->view('_template/footer');
	}

	public function save(){
		$r = array();
		try {
			$data['Nama'] = strtoupper($this->input->post('Nama'));
			$data['Keterangan'] = $this->input->post('Keterangan');
			$data['Bobot'] = $this->input->post('Bobot');
			$data['Satuan'] = $this->input->post('Satuan');
            $save = $this->m->save_data($data);
            $r['status'] = true;
            $r['pesan'] = "Data Indikator Penilaian dengan nama ".$data['Nama']." berhasil di masukkan kedalam sistem";
            echo json_encode($r);
		
		} catch (PDOException $e) {
			$r['status'] = false;
			$r['pesan'] = "System Error : ".$e->getMessage();
			echo json_encode($r);
		}
	}

	public function update(){
		$r = array();
		try {
			$Id = $this->input->post('Id');
			$data['Nama'] = strtoupper($this->input->post('Nama'));
			$data['Bobot'] = strtoupper($this->input->post('Bobot'));
			$data['Keterangan'] = $this->input->post('Keterangan');
			$data['Satuan'] = $this->input->post('Satuan');
			$update = $this->m->update_data($data,$Id);
			$r['status'] =true;
			$r['pesan'] = "Data Indikator Penilaian dengan Nama ".$data['Nama']." berhasil di ubah kedalam sistem";
			echo json_encode($r);
			
		} catch (PDOException $e) {
			$r['status'] = false;
			$r['pesan'] = "System Error : ".$e->getMessage();
			echo json_encode($r);
		}
		
		
	}

	public function delete(){
		$result = array();
		try {
			$Id = $this->input->post('Id');
			$update = $this->m->hapus_data($Id);
			$result['status'] = "sukses";
			$result['pesan'] = "Data Indikator Penilaian berhasil dihapus";
			echo json_encode($result);
		} catch (PDOException $e) {
			$result['status'] = "gagal";
			$result['pesan'] = $e->getMessage();
			echo json_encode($result);
		}
	}

}
