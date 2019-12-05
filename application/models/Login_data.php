<?php 
 
class Login_data extends CI_Model{	

	public function get($username){
        $this->db->where('username', $username); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('user')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    public function get_pegawai($nip){
        $this->db->where('nip', $nip); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('pegawai')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }
    
    
}