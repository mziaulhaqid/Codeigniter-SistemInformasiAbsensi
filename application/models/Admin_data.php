<?php 

class Admin_data extends CI_Model{	

	function input($data,$table){
		$this->db->insert($table,$data);
	}
	function select($data,$table,$sort){
		$this->db->order_by($data,$sort);
		return $this->db->get($table);
	}
	function hapus($data,$table){
		$this->db->where($data);
		$this->db->delete($table);
	}
	function update($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}	
	function edit($where,$table){		
		return $this->db->get_where($table,$where);
	}

	function kehadiran_pegawai($where,$table,$data,$sort){		
		$this->db->order_by($data,$sort);
		return $this->db->get_where($table,$where);

	}

	function code_otomatis($data,$table,$awal){
		$this->db->select('Right('.$table.'.'.$data.',3) as kode ',false);
		$this->db->order_by($data, 'desc');
		$this->db->limit(1);
		$query = $this->db->get($table);
		if($query->num_rows()<>0){
			$data = $query->row();
			$kode = intval($data->kode)+1;
		}else{
			$kode = 1;

		}
		$kodemax = str_pad($kode,3,"0",STR_PAD_LEFT);
		$kodejadi  = $awal.$kodemax;
		return $kodejadi;
	}

	function kode_kehadiran($data,$table,$awal){
		$this->db->select('Right('.$table.'.'.$data.',10) as kode ',false);
		$this->db->order_by($data, 'desc');
		$this->db->limit(1);
		$query = $this->db->get($table);
		if($query->num_rows()<>0){
			$data = $query->row();
			$kode = intval($data->kode)+1;
		}else{
			$kode = 1;

		}
		$kodemax = str_pad($kode,10,"0",STR_PAD_LEFT);
		$kodejadi  = $awal.$kodemax;
		return $kodejadi;
	}

	private function _get_datatables_query($table,$column_order,$column_search,$order){

		if(!empty($this->input->post('nama_pegawai')))
		{
			$this->db->where('nip', $this->input->post('nama_pegawai'));
		}

		if (!empty($this->input->post('bulan'))){
			$this->db->where('MONTH(tanggal_kehadiran)',$this->input->post('bulan'));

		}

		if (!empty($this->input->post('tahun'))){
			$this->db->where('YEAR(tanggal_kehadiran)',$this->input->post('tahun'));
		}


		$this->db->from($table);

		$i = 0;

        foreach ($column_search as $item) // looping awal
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

                if(count($column_search) - 1 == $i) 
                	$this->db->group_end(); 
            }
            $i++;
        }

        if(isset($_POST['order'])) 
        {
        	$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
        	$order = $order;
        	$this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($table,$column_order,$column_search,$order){
    	$this->_get_datatables_query($table,$column_order,$column_search,$order);
    	if($_POST['length'] != -1)
    		$this->db->limit($_POST['length'], $_POST['start']);
    	$query = $this->db->get();
    	return $query->result();
    }
    function count_filtered($table,$column_order,$column_search,$order){
    	$this->_get_datatables_query($table,$column_order,$column_search,$order);
    	$query = $this->db->get();
    	return $query->num_rows();
    }
    public function count_all($table){
    	$this->db->from($table);
    	return $this->db->count_all_results();
    }

    function laporan_kehadiran($bulan,$tahun,$by){
    	return $this->db->query('SELECT * FROM kehadiran  WHERE MONTH(tanggal_kehadiran) = '.$bulan.' AND YEAR(tanggal_kehadiran) = '.$tahun.' GROUP BY '.$by.'');
    }

    function laporan_kehadiran_($bulan,$tahun,$by,$nip){
    	return $this->db->query('SELECT * FROM kehadiran  WHERE MONTH(tanggal_kehadiran) = '.$bulan.' AND YEAR(tanggal_kehadiran) = '.$tahun.' AND nip = '.$nip.' GROUP BY '.$by.'');
    }

}
?>