<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sửa dữ liệu</title>
	<script type="text/javascript" src="<?php echo base_url(); ?>/vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="<?php echo base_url(); ?>/1.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/vendor/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/vendor/font-awesome.css">
 	<link rel="stylesheet" href="<?php echo base_url(); ?>/1.css">
</head>

<body>
	<nav class="navbar navbar-light bg-light">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-toggleable-sm" id="exCollapsingNavbar2">
		  	<a class="navbar-brand" href="#">backend slide</a>
		    <ul class="nav navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url(); ?>/Do_edit">Sửa slide <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url(); ?>/Slide">Thêm slide</a>
		      </li>
		    </ul>
		  </div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-sm-6 push-sm-3">
				<h3 class="display-4 text-xs-center">Sửa Slide</h3>
				<?php $dem = 0; ?>
				<hr>
				<form enctype="multipart/form-data" action="Slide/suaSlide" method="POST">
					<?php foreach ($mangdl as $key => $value): ?>
					<?php $dem++ ; ?>
					<h2>Slide số <?= $dem ; ?></h2>	
					<hr>
					<fieldset class="form-group">
						<label for="formGroupExambleInput">Title</label>
						<input name="title[]" type="text" class="form-control" id="title" value="<?= $value['title'] ?>">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExambleInput">Mô tả slide</label>
						<input name="description[]" type="text" class="form-control" id="description" value="<?= $value['description'] ?>">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExambleInput">Link của nút</label>
						<input name="button_link[]" type="text" class="form-control" id="button_link" value="<?= $value['button_link'] ?>">
					</fieldset>

					<fieldset class="form-group">
						<label for="formGroupExambleInput">text của nút</label>
						<input name="button_text[]" type="text" class="form-control" id="button_text" value="<?= $value['button_text'] ?>">
					</fieldset>

					<fieldset class="form-group">
						<label for="formGroupExambleInput">Upload ảnh</label>
						<img src="<?= $value['slide_image'] ?>" alt="" width="40%">
						<input name="slide_image_old[]" type="hidden" class="form-control" id="button_text" value="<?= $value['slide_image'] ?>">

						<input type="file" name="slide_image[]">
					</fieldset>
					
					<?php endforeach ?>

					<fieldset class="form-group">
						<input type="submit" class="form-control btn btn-outline-info" id="submit" value="Lưu">
					</fieldset>
				</form>
				
			</div>
		</div>
	</div>
</body>
</html>