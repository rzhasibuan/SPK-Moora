<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('AlternatifModel');
	}

	public function index()
	{
		$data['url'] = 'Alternatif';
		$data['data'] = $this->AlternatifModel->get_all_alternatif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('alternatif/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('kode_alternatif', 'Kode Alternatif', 'trim|required');
		$this->form_validation->set_rules('nama_alternatif', 'Nama Alternatif', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['url'] = 'Alternatif';

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('templates/sidebar', $data);	
			$this->load->view('alternatif/insert');
			$this->load->view('templates/footer');
		} else {
			$this->AlternatifModel->insert_data();
			redirect('alternatif');
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('kode_alternatif', 'Kode Alternatif', 'trim|required');
		$this->form_validation->set_rules('nama_alternatif', 'Nama Alternatif', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['url'] = 'alternatif';

			$data['data'] = $this->AlternatifModel->get_all_alternatif();
			$data['data'] = $this->AlternatifModel->get_id($id);

			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('alternatif/update', $data);
			$this->load->view('templates/footer');
		} else {
			$this->AlternatifModel->update_data($id);
			redirect('alternatif');
		}
	}

	public function delete($id)
	{
		$this->AlternatifModel->delete_data($id);
		redirect('alternatif');
	}
}
