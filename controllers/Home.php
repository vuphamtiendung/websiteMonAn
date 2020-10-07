<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('slides_model');
		$dl = $this->slides_model->layDuLieuSlide();
		$dl = array('mangdl' => $dl);
		$this->load->view('trangchu_view', $dl);
	}


}

/* End of file trangchu.php */
/* Location: ./application/controllers/trangchu.php */