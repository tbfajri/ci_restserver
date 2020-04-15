<?php 

use Restserver\libraries\REST_Controller;
defined('BASEPATH') OR exit ('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
// require APPPATH . '/libraries/Format.php';

class Kontak extends Rest_Controller {

    function __construct(){
        parent:: __construct();
        $this->load->model('Kontak_model', 'kontak');
    }

    public function index_get(){
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->kontak->getKontak();
        } else {
            $kontak = $this->kontak->getKontak($id);
        }

        if ($kontak) {
            $response['status'] = 200;
            $response['data'] = $kontak;
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $response['status'] = 404;
            $response['message'] = 'id tidak valid';
            $this->response($response, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post() {
        $data  = [
            'nama'  => $this->post('nama'),
            'nomor' => $this->post('nomor'),
            'email' => $this->post('email')
        ];
        $kontak = $this->kontak->insert($data);
        if ($kontak > 0) {
            $response['status'] = 201;
            $response['error'] = false;
            $response['message'] = 'Data Berhasil ditambahkan';
            $this->response($response, REST_Controller::HTTP_CREATED);
        } else {
            $response['status'] = 400;
            $response['error'] = false;
            $response['message'] = 'Gagal Ditambahkan';
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put(){
        $id = $this->put('id');
        $data = [
            'id' => $this->put('id'),
            'nama' => $this->put('nama'),
            'nomor' => $this->put('nomor'),
            'email' => $this->put('email')
        ];
        $kontak = $this->kontak->update($id, $data);
        if ($kontak > 0) {
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Data Berhasil diupdate';
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $response['status'] = 400;
            $response['error'] = true;
            $response['message'] = 'Gagal Diupdate';
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete(){
        $id = $this->delete('id');
        $kontak = $this->kontak->delete($id);
        if ($kontak > 0) {
            $response['status'] = 200;
            $response['error'] = false;
            $response['message'] = 'Data Berhasil dihapus';
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $response['status'] = 400;
            $response['error'] = true;
            $response['message'] = 'Gagal dihapus';
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
