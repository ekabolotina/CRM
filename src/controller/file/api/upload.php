<?php

$status = [];

if (!$_SESSION['user']){
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

define('MAX_FILE_SIZE', 3.5);

$tmpId = htmlspecialchars($_GET['tmpId']);
$user = $_SESSION['user']['id'];
$time = time();

if(
    isset($_FILES) &&
    $user
) {
    if (count($_FILES) <= 10) {
        $status = [];
        foreach($_FILES as $file){
            $imageSize = getimagesize($file['tmp_name']);
            if(
                $imageSize[2] == IMG_JPG &&
                $file['size'] <= constant('MAX_FILE_SIZE')*1024*1024
            ){
                $file_new_name = 'youchCRM-' . sha1(time()  * mt_rand(999, 9999)) . '.jpg';
                if (
                    move_uploaded_file($file['tmp_name'], constant('UPLOAD_DIR') . $file_new_name) &&
                    $link->query("INSERT INTO `imgs`(`client_tmp_id`, `url`, `user`) VALUES('$tmpId', '$file_new_name', $user)")
                ) {
                    $status['code'] = 200;
                    $status['file'][] = $file_new_name;
                    $status['id'][] = $link->insert_id;
                } else {
                    $status['code'] = 202;
                    $status['dberror'] = $link->error;
                }
            } else {
                $status['code'] = 204;
            }
        }
    } else {
        $status['code'] = 203;
    }
} else {
    $status['code'] = 201;
}

echo json_encode($status);
