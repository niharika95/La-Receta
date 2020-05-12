<!--
  Page to display sucessful message once recipie is added successfully to database. 
  Dependencies : new_recipie_page.php,fonts.googleapis.com
 -->
<?php      
    // we cannot change permission to upload images directly to the iste646t02 site as we are not the owner.
    // so I created a symbolic link between assets/uploads and wyl7747/site-uploads in my account
    // to store the uploaded image files 
    $IMAGE_UPLOAD_DIR = "/home/MAIN/wyl7747/site-uploads/";

    $path = "../";          
    $conn = new mysqli("localhost", "iste646t02", "couldcontinue", "iste646t02");

    $recipe_added_message = "Thank you! Your recipe has been added.";

    if(!$conn) {
        echo "There was an error connecting to the database.";
    }

    $chef_name = "";
    $recipe_name = "";
    $description = "";
    $ingredients = "";    
    $category = "";
    $prep_time = "";
    $cook_time = "";
        
    // Form validation
    $errors = array('recipe_name'=>'', 'image_url_1'=>'', 'image_file_1'=>'', 'image_url_2'=>'', 'image_file_2'=>'', 'category'=>'', 'ingredients'=>'', 'directions'=>'', 'prep_time'=>'', 'cook_time'=>'', 'servings'=>'');

    if (isset($_POST['img_upload'])){

        //check recipe name is filled
        if (empty($_POST['recipe_name'])){
            $errors['recipe_name'] = "Recipe Title is required.<br/>";
        } else {
            $recipe_name = $_POST["recipe_name"] ?? '';
        }

        // check category is selected
        if (empty($_POST['category'])){
            $errors['category'] = "Please select a category.<br/>";
        } else {
            $category = $_POST["category"] ?? '';
        }

        //check ingredients are filled and validate that ingredients are sepreated by commas
        if (empty($_POST['ingredients'])){
            $errors['ingredients'] = "Please enter the ingredients.<br/>";
        } else {
            $ingredients = $_POST["ingredients"] ?? '';
            if (!preg_match('~^[./%#&()\w\s]+(,\s*[./%#&()\w\s]*)*$~',$ingredients)){
                $errors['ingredients'] = "Please seperate the ingredients by commas";
            }
        }

        //check directions are filled and validate that directions are seperated by a number and a dot
        if (empty($_POST['directions'])){
            $errors['directions'] = "Please enter the directions.<br/>";
        } else {
            $directions = $_POST["directions"] ?? '';
            if (!preg_match('/(^\d\.[\s\S]*)(\d\.[\s\S]*)*$/',$directions)){
                $errors['directions'] = 'Please use the format (1. 2. 3. etc.) to sepreate the directions. Start with "1."';
            }
        }

        // check that prep time is not empty and validate that prep time is a number
        if(empty($_POST['prep_time'])){
            $errors['prep_time'] = "Please enter the Prep Time.<br/>";
        } else {
            $prep_time = $_POST["prep_time"] ?? '';
            /* if (!is_numeric($prep_time)){
                $errors['prep_time'] = "Prep Time needs to be a number.";
            } */
        }

        // validate that cook time is a number
        $cook_time = $_POST["cook_time"] ?? '';
        /* if (!empty($cook_time)){
            if (!is_numeric($cook_time)){
                $errors['cook_time'] = "Cook Time needs to be a number.";
            }
        } */

        //validate that servings is a number
        $servings = $_POST["servings"] ?? '';        
        if (!empty($servings)){
            if (!is_numeric($servings)){
                $errors['servings'] = "Servings needs to be a number.";
            }
        } 

        // validate url-1 is a valid url
        $image_url_1 = $_POST["image_url_1"] ?? '';
        if (!empty($image_url_1)){
            if (!filter_var($image_url_1, FILTER_VALIDATE_URL)){
                $errors['image_url_1'] = "Please enter a valid URL.";
            }
        }

        // validate url-2 is a valid url
        $image_url_2 = $_POST["image_url_2"] ?? '';
        if (!empty($image_url_2)){
            if (!filter_var($image_url_2, FILTER_VALIDATE_URL)){
                $errors['image_url_2'] = "Please enter a valid URL.";
            }
        }
        
        // validate either url or img upload
        $errorImageString = "Please only fill out the image url or image upload.";
        
        // url or image upload 1    
        if(!empty($image_url_1) && !empty($_FILES["image_file_1"]["name"])) {
            $errors["image_url_1"] = $errorImageString;
            $errors["image_file_1"] = $errorImageString;
        }
        
        // url or image upload 2
        if(!empty($image_url_2) && !empty($_FILES["image_file_2"]["name"])) {
            $errors["image_url_2"] = $errorImageString;
            $errors["image_file_2"] = $errorImageString;
        }

    }
    // Form validation ends


    $chef_name = $_POST["chef_name"] ?? '';
    $description = $_POST["description"] ?? '';
    $image_file_1 = $_FILES["image_file_1"]["name"];
    $image_file_2 = $_FILES["image_file_2"]["name"];

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    //Funtion to validate and upload recipie image
    function processImageUpload($image_name, $image_form_name, $IMAGE_UPLOAD_DIR) {
        if(!empty($image_name)) {
            $maxsize = 5242880; // 5MB
            $file_name = $image_name;
            $target_path = $IMAGE_UPLOAD_DIR . $file_name;

            // select file type
            $image_file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            //valid file extensions
            $extensions_arr = array("png","jpg","jpeg");

            // check extension
            if(in_array($image_file_type, $extensions_arr)) {

                //check file size
                $file_size = $_FILES[$image_form_name]["size"];
                if($file_size >= $maxsize || $file_size == 0) {
                    $errors['image_file_1'] = "File must be between 0 to 5MB.";
                } else {
                    //upload
                    if(move_uploaded_file($_FILES[$image_form_name]["tmp_name"], $target_path)) {
                        $image_path = "../assets/uploads/" . $file_name;
                        return $image_path;
                    }
                }
            } else {
                //$errors['image_file_1'] = "Please upload files";
            }

        }
    }

    $image_file_1 = processImageUpload($image_file_1, "image_file_1", $IMAGE_UPLOAD_DIR);
    $image_file_2 = processImageUpload($image_file_2, "image_file_2", $IMAGE_UPLOAD_DIR);
    
    $image1 = '';
    $image2 = '';
    if(!empty($image_url_1)) {
        $image1 = $image_url_1;
    } 
    elseif(!empty($image_file_1)) {
        $image1 = $image_file_1;
    }

    if(!empty($image_url_2)) {
        $image2 = $image_url_2;
    } 
    elseif(!empty($image_file_2)) {
        $image2 = $image_file_2;
    }

    if (!array_filter($errors)){
        $sql = "INSERT INTO recipes (chef_name, recipe_name, description, image_url_1, image_url_2, category, prep_time, cook_time, servings, ingredients, directions) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
    
        $stmt->bind_param("ssssssssiss", $chef_name, $recipe_name, $description, $image1, $image2, $category, $prep_time, $cook_time, $servings, $ingredients, $directions);
    
        $stmt->execute();
        $conn->close();
        header("Location:../index.php?recipe_added_message=" . $recipe_added_message);
    }
    
    include("new_recipe_page.php");
?>