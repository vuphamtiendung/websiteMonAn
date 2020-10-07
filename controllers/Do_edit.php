<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Do_edit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// lấy dữ liệu từ csdl
		$this->load->model('slides_model');
		$dl = $this->slides_model->layDuLieuSlide();
		
		// biến json thành mảng
		$dl = json_decode($dl, true);
		/* trước khi truyền dl vào view, chuyển sang mạng mảng */
		$dl = array('mangdl' => $dl);

		// truyền mảng này sang view
		$this->load->view('editSlide_view', $dl, FALSE);
	}

}

/* End of file Do_edit.php */
/* Location: ./application/controllers/Do_edit.php */