<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
			$this->load->model('m_users',"m");
			$this->load->model('m_auth');
			$this->m_auth->cek_login();
	}
		
	public function index(){
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/users/view');
		$this->load->view('_template/footer');
	}

	public function show_data(){
		$list = $this->m->get_datatables();
        $data = array();
        $no = $_POST['start'];
		$level = array("ADMIN","PEMERIKSA","ADMIN FAKULTAS");
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->Nama;
            $row[] = $field->Username;
            $row[] = $level[$field->Level];
            $row[] = "<center><span class='btn-group'><a data-toggle='tooltip' href='".base_url()."users/edit?Id=".$field->Id."' title='Ubah Data' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i></a><a data-toggle='tooltip' href='javascript:void(0)' title='Hapus Data' onclick='HapusData(".$field->Id.")' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></span></center>";
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
		$this->load->view('modul/users/tambah');
		$this->load->view('_template/footer');
	}

	public function edit(){
		$Id = $this->input->get("Id");
		$data['Item'] = $this->m->get_data($Id);
		$this->load->view('_template/header');
		$this->load->view('_template/sidebar');
		$this->load->view('modul/users/edit',$data);
		$this->load->view('_template/footer');
	}

	public function save(){
		$r = array();
		try {
			$data['Nama'] = strtoupper($this->input->post('Nama'));
			$data['Username'] = $this->input->post('Username');
			$data['Password'] = md5("pp".$this->input->post('Password'));
			$data['Level'] = $this->input->post('Level');
			$DuplicateData = $this->m->cek_duplicate($data['Username']);
			if($DuplicateData <= 0){
				$save = $this->m->save_data($data);
				$r['status'] = true;
				$r['pesan'] = "Data User dengan username ".$data['Username']." berhasil di masukkan kedalam sistem";
				echo json_encode($r);
			}else{
				$r['status'] = false;
				$r['pesan'] = "Data User dengan username  : ".$data['Username']." telah tersedia dalam sistem. silahkan masukkan Username yang lain";
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
			$data['Nama'] = strtoupper($this->input->post('Nama'));
			$data['Username'] = $this->input->post('Username');
			if(!empty($this->input->post('Password'))){
				$data['Password'] = md5("pp".$this->input->post('Password'));
			}
			$data['Level'] = $this->input->post('Level');
			$update = $this->m->update_data($data,$Id);
			$r['status'] =true;
			$r['pesan'] = "Data User dengan username ".$data['Username']." berhasil di ubah kedalam sistem";
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
			$result['pesan'] = "Data User berhasil dihapus";
			echo json_encode($result);
		} catch (PDOException $e) {
			$result['status'] = "gagal";
			$result['pesan'] = $e->getMessage();
			echo json_encode($result);
		}
	}

}
