<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subip extends CI_Controller {

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
			$this->load->model('m_subip',"m");
			$this->load->model('m_auth');
			$this->m_auth->cek_login();
	}
		
	public function index(){
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/subip/view');
		$this->load->view('_template/footer');
	}

	public function show_data(){
		$list = $this->m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
			$name_file = base64_encode($field->Format);
			$Ip = json_decode($field->Ip,true);
			$KeyData = $field->KeyData == 0 ? "<span class='label label-danger'>Tidak<span>" : "<span class='label label-success'>Ya</span>";
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->Nama;
            $row[] = $Ip['Nama'];
            $row[] = "<center>".$KeyData."</center>";
            $row[] = "<center><span class='btn-group'><a data-toggle='tooltip' href='".base_url()."subip/download_file?Ip=".$name_file."' title='Unduh Format' class='btn btn-success btn-xs'><i class='fa fa-file'></i></a> <a data-toggle='tooltip' href='".base_url()."subip/edit?Id=".$field->Id."' title='Ubah Data' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i></a><a data-toggle='tooltip' href='javascript:void(0)' title='Hapus Data' onclick='HapusData(".$field->Id.")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></span></center>";
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
		$data['Ip'] = $this->m->get_ip();
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/subip/tambah', $data);
		$this->load->view('_template/footer');
	}

	public function edit(){
		$Id = $this->input->get("Id");
		$data['data'] = $this->m->get_data($Id);
		$data['Ip'] = $this->m->get_ip();
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/subip/edit',$data);
		$this->load->view('_template/footer');
	}

	function do_upload(){
		$r = array();

        $config['upload_path']="./public/file/format"; //path folder file upload
        $config['allowed_types'] = 'xls|xlsx';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload
         
        $this->load->library('upload',$config); //call library upload 
        if($this->upload->do_upload("format")){ //upload file
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

	public function save(){
		$r = array();
		$upl = $this->do_upload();
		try {
			if($upl['status'] === true){
				$format = $upl['data']['file_name'];
				$data['Nama'] = strtoupper($this->input->post('Nama'));
				$data['IdIp'] = $this->input->post('IdIp');
				$data['Ip'] = $this->m->load_ip_data($data['IdIp']);
				$data['KeyData'] = $this->input->post('KeyData');
				$data['Format'] = $format; 
				$save = $this->m->save_data($data);
				$r['status'] = true;
				$r['pesan'] = "Data Sub Indikator Kinerja	 dengan nama ".$data['Nama']." berhasil di masukkan kedalam sistem";
				echo json_encode($r);
			}else{
				$r['status'] = false;
				$r['pesan'] = "System Error : ".$upl['message'];
				echo json_encode($r);
			}
		
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
			if(empty($_FILES['format']['name'])){
				$data['Nama'] = strtoupper($this->input->post('Nama'));
				$data['IdIp'] = $this->input->post('IdIp');
				$data['Ip'] = $this->m->load_ip_data($data['IdIp']);
				$data['KeyData'] = $this->input->post('KeyData');
				$update = $this->m->update_data($data,$Id);
				$r['status'] =true;
				$r['pesan'] = "Data Sub Indikator Kinerja dengan Nama ".$data['Nama']." berhasil di ubah kedalam sistem";
				echo json_encode($r);
			}else{
				$olData = $this->m->get_data($Id);
				$upl = $this->do_upload();
				if($upl['status'] === true){
					$format = $upl['data']['file_name'];
					$Id = $this->input->post('Id');
					$data['Nama'] = strtoupper($this->input->post('Nama'));
					$data['IdIp'] = $this->input->post('IdIp');
					$data['Ip'] = $this->m->load_ip_data($data['IdIp']);
					$data['KeyData'] = $this->input->post('KeyData');
					$data['Format'] = $format; 
					$update = $this->m->update_data($data,$Id);
					$this->hapus_file($olData->Format);
					$r['status'] =true;
					$r['pesan'] = "Data Sub Indikator Kinerja dengan Nama ".$data['Nama']." berhasil di ubah kedalam sistem";
					echo json_encode($r);
				}else{
					$r['status'] = false;
					$r['pesan'] = "System Error : ".$upl['message'];
					echo json_encode($r);
				}
			}
			
		} catch (PDOException $e) {
			$r['status'] = false;
			$r['pesan'] = "System Error : ".$e->getMessage();
			echo json_encode($r);
		}
	}

	public function hapus_file($file){
		$dir = "public/file/format/";
		$fiels = $dir.$file;
		if(file_exists($fiels) && $file != ""){
			unlink($fiels);
		}
		return true;
	}

	public function delete(){
		$result = array();
		try {
			$Id = $this->input->post('Id');
			$olData = $this->m->get_data($Id);
			$this->hapus_file($olData->Format);
			$update = $this->m->hapus_data($Id);
			$result['status'] = "sukses";
			$result['pesan'] = "Data Sub Indikator Kinerja berhasil dihapus";
			echo json_encode($result);
		} catch (PDOException $e) {
			$result['status'] = "gagal";
			$result['pesan'] = $e->getMessage();
			echo json_encode($result);
		}
	}


	function download_file(){
		$file = base64_decode($this->input->get("Ip"));
		$this->load->helper('download');
		force_download("./public/file/format/".$file,null);
	}

}
