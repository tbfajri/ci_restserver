<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');

class Kontak_model extends CI_Model {

    public function empty_response(){
        $response['status'] = 502;
        $response['error'] = true;
        $response['message'] = 'Field Tidak Boleh Kosong';
        return $response;
    }

    public function getKontak($id = null ){
        if ($id === null ) {
           $query =  $this->db->get('pelanggan')->result();
           return $query;
    
        } else {
            $query = $this->db->get_where('pelanggan', ['id' => $id])-> result();
            return $query;
        }
    }

    public function insert($data) {
        if (empty($data['nama']) || empty($data['nomor']) || empty($data['email'])){
            return 0;
        } else {
            $this->db->insert('pelanggan', $data);
            return $this->db->affected_rows();
        }
    }

    public function update($id, $data){
        if (empty($data['nama']) || empty($data['nomor']) || empty($data['email'])){
            return 0;
        } else {
            $this->db->where('id', $id);
            $this->db->update('pelanggan', $data);
            return $this->db->affected_rows();
        }
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('pelanggan');
        return $this->db->affected_rows();
    }

}