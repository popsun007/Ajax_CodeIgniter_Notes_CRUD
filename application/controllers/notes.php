<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('note');
	}
	public function index()
	{
		$this->load->view('index');
	}

	public function add_notes()
	{

		$id = $this->note->add_note($this->input->post('title'));
		$notes['infos'] = $this->note->get_one($id);
		echo json_encode($notes);
	}

	public function get_all()
	{
		$notes['infos'] = $this->note->get_all();
		echo json_encode($notes);
	}
	public function delete($id)
	{
		$this->note->delete($id);
		redirect('/');
	}
	public function update($id)
	{
		$this->note->update($id, $this->input->post('descp'));
		$notes['note'] = $this->note->get_one($id);
		echo json_encode($notes);
	}
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */