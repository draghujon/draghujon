    <!--===f===

     Challenge 5
     Name: Mariam Bakhet
     Date: Feb 6th, 2020
     Description: file upload Challenge

============ --> 
<?php
    //include 'ImageResize.php';
    //use \Gumlet\ImageResize;

		
   
	function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
		$current_folder = dirname(__FILE__);
		$path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
			return join(DIRECTORY_SEPARATOR, $path_segments);
		}
	$image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
	if ($image_upload_detected) {
		$image_filename = $_FILES['image']['name'];
		$temporary_image_path = $_FILES['image']['tmp_name'];
		$new_image_path = file_upload_path($image_filename);
		move_uploaded_file($temporary_image_path, $new_image_path);

		//to resize:
		//$file = $_FILES['image'];
		//$image = new ImageResize('$file');
		//$image->resizeToWidth(400);
		//$image->save('medium'.$image_filename);

	}

	function file_is_an_image($temporary_path, $new_path) {
		$allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png','pdf'];
		$actual_file_extension = pathinfo($new_path, PATHINFO_EXTENSION);
		$file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
		return $file_extension_is_valid;
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>File Upload Form</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<form method="post" enctype="multipart/form-data" id="imageupload">
			<li>
				<label for="image">Image Filename:</label>
				<input type="file" name="image" id="image">
			</li>

			<input type="submit" name="submit" value="Upload Image" id="button">
		</form>

		<?php if (isset($_FILES['image']) && $_FILES['image']['error'] > 0): ?>
			<p>Error Number: <?= $_FILES['image']['error'] ?></p>
		<?php elseif (isset($_FILES['image'])): ?>
			<p>Client-Side Filename: <?= $_FILES['image']['name'] ?></p>
			<p>Apparent Mime Type: <?= $_FILES['image']['type'] ?></p>
			<p>Size in Bytes: <?= $_FILES['image']['size'] ?></p>
			<p>Temporary Path: <?= $_FILES['image']['tmp_name'] ?></p>
			<p>New Path: <?= $new_image_path ?></p>
		<?php endif ?>
	</body>
</html>