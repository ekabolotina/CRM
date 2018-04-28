<?php

	$maxFileSize = 3.5;

	session_start();
	require 'connect.php';

	$tmpId = htmlspecialchars($_GET['tmpId']);
	$user = $_SESSION['user']['id'];
	$time = time();

	if(isset($_FILES) && $user)  
		if(count($_FILES) <= 10){
		    $uploaddir = $_SERVER['DOCUMENT_ROOT'] .'/img/uploads/';
		    $status = array();
		    foreach($_FILES as $file){
		    	$imageSize = getimagesize($file['tmp_name']);
		    	if($imageSize[2] == IMG_JPG && $file['size'] <= $maxFileSize*1024*1024){
			    	$file_new_name = 'youchCRM-' . sha1(time()  * mt_rand(999, 9999)) . '.jpg';
			        if(move_uploaded_file($file['tmp_name'], $uploaddir . $file_new_name) && $link->query("INSERT INTO `imgs`(`client_tmp_id`, `url`, `user`) VALUES('$tmpId', '$file_new_name', $user)")){ 
			        	$status['code'] = 200;
						$status['file'][] = $file_new_name;
						$status['id'][] = $link->insert_id;
			        }else{
			        	$status['code'] = 202;
			        	$status['dberror'] = $link->error;
			        	$status['q'] = $file['tmp_name'];	        	
			        }
				}else
					$status['code'] = 204; 
			}   
		}else
			$status['code'] = 203;		
	else
	  	$status['code'] = 201;

	echo json_encode($status);
  
?>