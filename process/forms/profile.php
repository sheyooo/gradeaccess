<?php
    require_once("../../includes/functions.inc");
    
    if(Tools::valuePost("action") == "profile_picture")
    {

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["img"]["size"] > 1000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if ($d = \Cloudinary\Uploader::upload($_FILES["img"]["tmp_name"],
                array(
               "crop" => "limit", 
               "width" => "2000", 
               "height" => "2000",
               "eager" => array(
                                 array( "width" => 200, "height" => 200, 
                                        "crop" => "thumb", "gravity" => "face" )
                                 )
               ))){
                print_r($d);
                if($insert_id = App::registerImage($d['public_id'], $d['url'], $d)){
                    $user->setProfilePicture($insert_id);
                }
                Tools::redirect("../../profile.php?status=1");
            } else {
                echo "Sorry, there was an error uploading your file.";
                Tools::redirect("../../profile.php?status=2");
            }
        }

        
        //redirect_to("../../add_teacher.php?status=1");
    }elseif(Tools::valuePost("edit_profile")){
        //redirect_to("../../add_teacher.php?status=2");
    }
    Tools::redirect("../../profile.php?status=6");

?>