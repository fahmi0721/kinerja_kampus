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
			$btn = $this->session->userdata('KodeLevel') === "2" ? "<a data-toggle='tooltip' href='".base_url()."k_fakultas/edit?Periode=".$field->Periode."' title='Edit Data' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i></a><a data-toggle='tooltip' href='javascript:void(0)' onclick=\"HapusData('".$field->Periode."')\" title='Hapus Data' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a>" : "";
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->Periode;	
            $row[] = $field->tot;
            $row[] = "<center><span class='btn-group'><a data-toggle='tooltip' href='".base_url()."k_fakultas/detail?Periode=".$field->Periode."' title='Lihat Data' class='btn btn-success btn-xs'><i class='fa fa-eye'></i></a>".$btn."</span></center>";
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
			$this->m->hapus_file_tmp($Id);
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

	function do_upload($dir){
		$r = array();
        $config['upload_path']=$dir; //path folder file upload
        $config['allowed_types'] = 'xls|xlsx';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload
         
        $this->load->library('upload',$config); //call library upload 
        if($this->upload->do_upload("Bukti")){ //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
			$r['status'] = true;
			$r['data'] = $this->upload->data();
			$r['message'] = "berhasil di upload";
			return $r;
        }else{
			$r['status'] = false;
			$r['data'] = "";
			$r['message'] = $this->upload->display_errors();
			return $r;
		}
	}

	public function save_temp(){
		$r = array();
		try {
			$dir = "./public/file/bukti_sementara/";
			$upl = $this->do_upload($dir);
			if($upl['status'] == true){
				$Bukti = $upl['data']['file_name'];
				$data['Periode'] = $this->input->post('Periode')." ".$this->input->post('Tahun');
				$data['IdSub'] = $this->input->post('IdSub');
				$data['Nilai'] = $this->input->post('Nilai');
				$data['Bukti'] = $Bukti;
				$data['IdUser'] = $this->session->userdata('Id');
				$data['IdFakultas'] = $this->session->userdata('IdFakultas');
				$save = $this->m->save_data_temp($data);
				$r['status'] = true;
				$r['pesan'] = "Data K-Fakultas berhasil di masukkan kedalam sistem";
				echo json_encode($r);
			}else{
				$r['status'] = false;
				$r['pesan'] = $upl['message'];
				echo json_encode($r);
			}
		
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
				$data['IdSub'] = $item['IdSub'];
				$data['Sub'] = $item['Sub'];
				$data['IdFakultas'] = $item['IdFakultas'];
				$data['Fakultas'] = $item['Fakultas'];
				$data['Nilai'] = $item['Nilai'];
				$data['Bukti'] = $item['Bukti'];
				$data['IdUser'] = $this->session->userdata('Id');
				copy("./public/file/bukti_sementara/".$item['Bukti'],"./public/file/bukti/".$item['Bukti']);
				unlink("./public/file/bukti_sementara/".$item['Bukti']);
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
				$data['IdSub'] = $item['IdSub'];
				$data['Sub'] = $item['Sub'];
				$data['IdFakultas'] = $item['IdFakultas'];
				$data['Fakultas'] = $item['Fakultas'];
				$data['Nilai'] = $item['Nilai'];
				$data['Bukti'] = $item['Bukti'];
				$data['IdUser'] = $this->session->userdata('Id');
				copy("./public/file/bukti_sementara/".$item['Bukti'],"./public/file/bukti/".$item['Bukti']);
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
			$this->m->hapus_file($Periode);
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

	public function load_nilai(){
		$result = array();
		try {
			$Id = $this->input->post('Id');
			$data = $this->m->load_nilai($Id);
			$result['status'] = true;
			$result['Nilai'] = $data->Nilai;
			echo json_encode($result);
		} catch (PDOException $e) {
			$result['status'] = "gagal";
			$result['pesan'] = $e->getMessage();
			echo json_encode($result);
		}
	}

	public function save_nilai(){
		$result = array();
		try {
			$Id = $this->input->post('Id');
			$data['Nilai'] = $this->input->post("Nilai");
			$this->m->update_nilai($data,$Id);
			$r['status'] = true;
			$r['pesan'] = "Data Nilai K-fakultas berhasil di masukkan kedalam sistem";
			echo json_encode($r);
		} catch (PDOException $e) {
			$result['status'] = "gagal";
			$result['pesan'] = $e->getMessage();
			echo json_encode($result);
		}
	}


	public function get_file(){
		$data = array();
		$IdSub = $this->input->post("IdSub");
		$file = $this->m->load_file_format($IdSub);
		if(!empty($file)){
			$data['status'] = true;
			$data['file'] = base64_encode($file);
			echo json_encode($data);
		}else{
			$data['status'] = false;
			$data['file'] = "";
			echo json_encode($data);
		}
	}

	function download_format(){
		$file = base64_decode($this->uri->segment(3));
		$this->load->helper('download');
		force_download("./public/file/format/".$file,null);
	}

	function download_bukti_sem(){
		$file = base64_decode($this->uri->segment(3));
		$this->load->helper('download');
		force_download("./public/file/bukti_sementara/".$file,null);
	}

	function download_bukti(){
		$file = base64_decode($this->uri->segment(3));
		$this->load->helper('download');
		force_download("./public/file/bukti/".$file,null);
	}

}
