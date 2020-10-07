<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slide extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('slides_model');
	}

	public function index()
	{
		$this->load->view('addData_view');
	}

	public function addSlide(){
		// Lấy dữ liệu từ trường tên là Slides_topbanner ra
		$dulieu = $this->slides_model->layDuLieuSlide();

		// giải mã json, sau đó 
		$dulieu = json_decode($dulieu, true);
		if ($dulieu == null) {
			echo "dữ liệu đang trống";
			$dulieu = array();
		}

		// lấy dữ liệu từ view.
		// upload file lấy từ W3School
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["slide_image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["slide_image"]["tmp_name"]);
		    if($check !== false) {
		       // echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        //echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		   	// echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["slide_image"]["size"] > 500000) {
		    //echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    //echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} 
		else {
		    if (move_uploaded_file($_FILES["slide_image"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["slide_image"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}

		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$button_link = $this->input->post('button_link');
		$button_text = $this->input->post('button_text');
		$slide_image = base_url(). 'uploads/'.basename($_FILES["slide_image"]["name"]);

 		// thêm nội dung vào json, hàm array_push()
		$motslideanh = array(
				'title' => $title,
			 	'description' => $description,
			 	'button_link' => $button_link,
			 	'button_text' => $button_text,
			 	'slide_image' => $slide_image
			);

		array_push($dulieu, $motslideanh);

		// mã hóa lại thành json
		$dulieu = json_encode($dulieu);

		// đưa dữ liệu mới vào, update lại dữ liệu
		if($this->slides_model->updateDuLieu($dulieu)){
			$this->load->view('thanhcong_view.php');
		}
	}

	public function suaSlide(){
		// lấy về nội dung từ view
		/* slide_image chứa */ 
		$title = $this->input->post('title'); // mảng.
		$description = $this->input->post('description'); // mảng.
		$button_link = $this->input->post('button_link'); // mảng.
		$button_text = $this->input->post('button_text'); // mảng.
		/*toàn bộ đống này */

		// lấy về tất cả các ảnh
		$cacanh = $_FILES['slide_image']['name']; // lưu trữ tên file, lấy tên file.
		$filevatly = $_FILES['slide_image']['tmp_name']; // file thật, tmp_name là mặc định của PHP.
		/* $cacanh, thực tế chỉ lấy tên ảnh chứ chưa upload lên. */

		$slide_image = array();// tạo mảng trống để lưu trữ tên file
		$slide_image_old = $this->input->post('slide_image_old');

		//duyệt để kiểm tra các tên file nhận được 
		for ($i = 0; $i < count($cacanh) ; $i++) {
			if (empty($cacanh[$i])){
				// nếu người dùng không upload ảnh
				$slide_image[$i] = $slide_image_old[$i]; 
			}
			else{
				$duongdan = 'uploads/'.$cacanh[$i];
				// lưu ảnh mới vào trong đường dẫn
				move_uploaded_file($filevatly[$i], $duongdan);
				$slide_image[$i] = base_url().'uploads/'.$cacanh[$i];
			}
		}
		/* $slide_image chứa toàn bộ tên file mình cần */
				
		// tạo 1 mảng mới
		$tatcaslide = array();

		// insert từng phần tử vào mảng "tất cả slide"
		for ($i = 0; $i < count($title) ; $i++) {
			$tmp = array();
			$tmp['title'] = $title[$i];
			$tmp['description'] = $description[$i];
			$tmp['button_link'] = $button_link[$i];
			$tmp['button_text'] = $button_text[$i];
			$tmp['slide_image'] = $slide_image[$i];
			array_push($tatcaslide, $tmp);
		}
		// echo "<pre>";
		// var_dump($tatcaslide);
		// echo "</pre>";

		// giải mã nó đưa vào json
		$tatcaslide = json_encode($tatcaslide);
		// gọi model update dữ liệu
		$this->load->model('slides_model');
		if($this->slides_model->updateDuLieu($tatcaslide))
		{
			$this->load->view('suathanhcong_view.php');
		}
		else
		{
			$this->load->view('suathatbai_view.php');
		}
	}
}

/* End of file Slide.php */
/* Location: ./application/controllers/Slide.php */