<?php
class M_k_fakultas extends CI_Model {

    var $table = 'tbl_kfakultas'; //nama tabel dari database
    var $column_order = array('Periode','Fakultas','Kompetensi'); //field yang ada di table peserta
    var $column_search = array('Periode','Fakultas','Kompetensi'); //field yang diizin untuk pencarian 
    var $order = array('Id' => 'asc'); // default order 
 

    private function _get_datatables_query()
    {
        $this->db->select("Id,Periode, COUNT(Periode) as tot");
        if($this->session->KodeLevel === "2"){
            $this->db->where("IdFakultas",$this->session->userdata('IdFakultas'));
        }
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
        $this->db->group_by("Periode");
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function load_kompetensi(){
        $query = $this->db->get("tbl_ip");
        return $query->result_array();
    }

    function relolad_data_temp($Periode){
        $this->db->select("Periode, IdKompetensi,IdFakultas");
        $this->db->where("Periode",$Periode);
        $data = $this->db->get("tbl_kfakultas")->result_array();
        foreach($data as $item){    
            $item['IdUser'] = $this->session->userdata("Id");
            $this->save_data_temp($item);
        }
    }
   
    function save_data($data){
        $this->db->insert("tbl_kfakultas", $data);
        return $this->db->affected_rows();
    }

    function load_data_temp($IdUser){
        $this->db->select("tbl_kfakultas_sementara.Id,tbl_kfakultas_sementara.Periode, tbl_ip.Nama,tbl_ip.Bobot");
        $this->db->where("tbl_kfakultas_sementara.IdUser",$IdUser);
        $query = $this->db->from("tbl_kfakultas_sementara");
        $query = $this->db->join("tbl_ip", "tbl_ip.Id = tbl_kfakultas_sementara.IdKompetensi");
        $query = $this->db->get();
        return $query->result_array();
    }

    function save_data_temp($data){
        $this->db->insert("tbl_kfakultas_sementara", $data);
        return $this->db->affected_rows();
    }

    function hapus_data_temp($Id){
        $this->db->where("Id", $Id);
        $this->db->delete("tbl_kfakultas_sementara");
        return $this->db->affected_rows();
    }

    function reset_data_temp($IdUser){
        $this->db->where("IdUser", $IdUser);
        $this->db->delete("tbl_kfakultas_sementara");
        return $this->db->affected_rows();
    }

    function reset_update($Periode){
        $this->db->where("Periode", $Periode);
        $this->db->delete("tbl_kfakultas");
        return $this->db->affected_rows();
    }

    function hapus_data($Periode){
        $this->db->where("Periode", $Periode);
        $this->db->delete("tbl_kfakultas");
        return $this->db->affected_rows();
    }

    function get_kompetensi($Id){
        $this->db->where("Id",$Id);
        return json_encode($this->db->get("tbl_ip")->row());
    }

    function get_fakultas($Id){
        $this->db->where("Id",$Id);
        return json_encode($this->db->get("tbl_fakultas")->row());
    }

    function load_sementara($Id){
        $this->db->select("IdKompetensi, Periode, IdFakultas");
        $this->db->where("IdUser",$Id);
        $data =  $this->db->get("tbl_kfakultas_sementara")->result_array();
        $rData = array();
        foreach($data as $item){
            $item['Kompetensi'] = $this->get_kompetensi($item['IdKompetensi']);
            $item['Fakultas'] = $this->get_fakultas($item['IdFakultas']);
            $rData[] = $item;
        }
        return $rData;
    }       
    
    function load_data_periode($Periode){
        $this->db->where("Periode",$Periode);
        return$this->db->get("tbl_kfakultas")->result_array();
    }

    function load_nilai($Id){
        $this->db->select("Nilai");
        $this->db->where("Id",$Id);
        return $this->db->get("tbl_kfakultas")->row();
    }

    function update_nilai($data,$Id){
        $this->db->where("Id", $Id);
        $this->db->update("tbl_kfakultas", $data);
        return $this->db->affected_rows();
    }


}
?>