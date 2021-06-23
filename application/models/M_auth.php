<?php
class M_auth extends CI_Model {

    public function __construct(){
        parent::__construct();
	}
    function cek_login(){
        if(empty($this->session->userdata('is_login'))){
			echo $this->session->userdata('KodeLevel');
		}
    }


    function login_user($username,$password){
        $query = $this->db->get_where('tbl_users',array('Username'=>$username));
        if($query->num_rows() > 0)
        {
            $Level = array("Admin","Pemeriksa","Admin Fakultas");
            $data_user = $query->row();
            if ($password === $data_user->Password) {
                $this->session->set_userdata('Id',$data_user->Id);
                $this->session->set_userdata('IdFakultas',$data_user->IdFakultas);
                $this->session->set_userdata('Username',$username);
				$this->session->set_userdata('Nama',$data_user->Nama);
                $this->session->set_userdata('Level',$Level[$data_user->Level]);
				$this->session->set_userdata('KodeLevel',$data_user->Level);
				$this->session->set_userdata('is_login',TRUE);
                return TRUE;
            } else {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
	}
    
    

       

}
?>