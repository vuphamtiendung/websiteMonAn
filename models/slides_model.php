<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class slides_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function layDuLieuSlide(){
		$this->db->select('*');
		$this->db->where('tenthuoctinh','slides_topbanner');
		$dl = $this->db->get('homepageattr');
		$dl = $dl->result_array();
		// duyệt dữ liệu
		foreach ($dl as $value){
			$tg = $value['giatrithuoctinh'];
		}
		return $tg;
	}

	public function updateDuLieu($dulieucanupdate){
		// lấy dữ liệu cần update
		$chuanbidulieu = array(
			'tenthuoctinh' => 'slides_topbanner',
			'giatrithuoctinh' => $dulieucanupdate
		);
		$this->db->where('tenthuoctinh', 'slides_topbanner');
		return $this->db->update('homepageattr', $chuanbidulieu);
	}

}

/* End of file slides_model.php */
/* Location: ./application/models/slides_model.php */