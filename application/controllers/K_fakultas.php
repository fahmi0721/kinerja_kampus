<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class K_fakultas extends CI_Controller {

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
			$this->load->model('m_k_fakultas',"m");
			$this->load->model('m_auth');
			$this->m_auth->cek_login();
	}
		
	public function index(){
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/k_fakultas/view');
		$this->load->view('_template/footer');
	}

	public function show_data(){
		$this->load->library('mylib');
		$list = $this->m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
			$pisah = explode("-",$field->Periode);
			$bulan = $this->mylib->getBulan($pisah[1]);
            $row[] = $no;
            $row[] = $bulan." ".$pisah[0];
            $row[] = $field->tot;
            $row[] = "<center><span class='btn-group'><a data-toggle='tooltip' href='".base_url()."k_fakultas/detail?Periode=".$field->Periode."' title='Lihat Data' class='btn btn-success btn-xs'><i class='fa fa-eye'></i></a><a data-toggle='tooltip' href='".base_url()."k_fakultas/edit?Periode=".$field->Periode."' title='Edit Data' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i></a><a data-toggle='tooltip' href='javascript:void(0)' onclick=\"HapusData('".$field->Periode."')\" title='Hapus Data' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a></span></center>";
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
		$this->m->reset_data_temp($this->session->userdata('Id'));
		$data['Ip'] = $this->m->load_kompetensi();
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/k_fakultas/tambah', $data);
		$this->load->view('_template/footer');
	}

	public function detail(){
		$Periode = $this->input->get("Periode");
		$data['data'] = $this->m->load_data_periode($Periode);
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/k_fakultas/detail', $data);
		$this->load->view('_template/footer');
	}

	public function edit(){
		$Periode = $this->input->get("Periode");
		$this->m->reset_data_temp($this->session->userdata('Id'));
		$this->m->relolad_data_temp($Periode);
		$data['Ip'] = $this->m->load_kompetensi();
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/k_fakultas/edit',$data);
		$this->load->view('_template/footer');
	}

	public function load_data_temp(){
		$IdUser = $this->session->userdata("Id");
		$data = $this->m->load_data_temp($IdUser);
		echo json_encode($data);
	}

	public function hapus_data_temp(){
		try {
			$Id = $this->input->post("Id");
			$save = $this->m->hapus_data_temp($Id);
			$r['status'] = true;
			$r['pesan'] = "Data K-Fakultas berhasil di hapus kedalam sistem";
			echo json_encode($r);
		
		} catch (PDOException $e) {
			$r['status'] = false;
			$r['pesan'] = "System Error : ".$e->getMessage();
			echo json_encode($r);
		}
	}

	public function save_temp(){
		$r = array();
		try {
			$data['Periode'] = $this->input->post('Periode');
			$data['IdKompetensi'] = $this->input->post('IdKompetensi');
			$data['IdUser'] = $this->session->userdata('Id');
			$data['IdFakultas'] = $this->session->userdata('IdFakultas');
			$save = $this->m->save_data_temp($data);
			$r['status'] = true;
			$r['pesan'] = "Data K-Fakultas berhasil di masukkan kedalam sistem";
			echo json_encode($r);
		
		} catch (PDOException $e) {
			$r['status'] = false;
			$r['pesan'] = "System Error : ".$e->getMessage();
			echo json_encode($r);
		}
	}

	public function save(){
		$r = array();
		try {
			$sementara = $this->m->load_sementara($this->session->userdata('Id'));
			foreach($sementara as $item){
				$data['Periode'] = $item['Periode'];
				$data['IdKompetensi'] = $item['IdKompetensi'];
				$data['Kompetensi'] = $item['Kompetensi'];
				$data['IdFakultas'] = $item['IdFakultas'];
				$data['Fakultas'] = $item['Fakultas'];
				$save = $this->m->save_data($data);
			}
			$this->m->reset_data_temp($this->session->userdata('Id'));
			$r['status'] = true;
			$r['pesan'] = "Data K-fakultas berhasil di masukkan kedalam sistem";
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
			$Periode = $this->input->get("Periode");
			$this->m->reset_update($Periode);
			$sementara = $this->m->load_sementara($this->session->userdata('Id'));
			foreach($sementara as $item){
				$data['Periode'] = $item['Periode'];
				$data['IdKompetensi'] = $item['IdKompetensi'];
				$data['Kompetensi'] = $item['Kompetensi'];
				$data['IdFakultas'] = $item['IdFakultas'];
				$data['Fakultas'] = $item['Fakultas'];
				$save = $this->m->save_data($data);
			}
			$this->m->reset_data_temp($this->session->userdata('Id'));
			$r['status'] = true;
			$r['pesan'] = "Data K-fakultas berhasil di masukkan kedalam sistem";
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
			$Periode = $this->input->post('Periode');
			$update = $this->m->hapus_data($Periode);
			$result['status'] = "sukses";
			$result['pesan'] = "Data K-Fakultas berhasil dihapus";
			echo json_encode($result);
		} catch (PDOException $e) {
			$result['status'] = "gagal";
			$result['pesan'] = $e->getMessage();
			echo json_encode($result);
		}
	}

}
