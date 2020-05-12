<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Recipe</title>
</head>
<body>
    <!--
    Page to display sucessful message once recipie is added successfully to database. 
    Dependencies : new_recipie_page.css, header.php, footer.php, fonts.googleapis.com
  -->
  <?php
    $path = "../";
    $title="Add your own recipe";
    $css = "new_recipe_page";
    include ($path."assets/inc/header.php");
  ?>
  <!-- Header -->
  <header><span class="headerLink" onClick="goToHomePage()"><span class="laFormatting">la</span> receta</span></header>
  <!-- /Header -->
  <!-- Content -->
  <div class="newRecipePageContent">
    <div class="newRecipeTitle">New Recipe</div>
    <!-- Tagline -->
    <h2 class="tagline">
      Adding your own recipe is so exciting!
    </h2>
  </div>
  
  <!-- Fields in the form -->
  <form id="addRecipe" action="recipe_added.php" method="post" enctype="multipart/form-data">
    <h3 class="fieldTitles">Chef's Name</h3>
    <input class="singleLineBox" type="text" name="chef_name" value="<?php echo $chef_name ?>">
      
    <h3 class="fieldTitles">Recipe Title*</h3><?php isset($errors['recipe_name'])?><p class="errorMsg"><?php echo $errors['recipe_name'] ?></p>
    <input class="singleLineBox" type="text" name="recipe_name" value="<?php echo $recipe_name ?>" required>
      
    <h3 class="fieldTitles">Description</h3>
    <textarea class="multiLineBox" name="description"><?php echo $description ?></textarea>
      
    <h3 class="fieldTitles">Image URL 1</h3><?php isset($errors['image_url_1'])?><p class="errorMsg"><?php echo $errors['image_url_1'] ?></p>
    <input class="singleLineBox imgUrl" type="text" name="image_url_1" value="<?php echo $image_url_1 ?>">

    <h3 class="fieldTitles">or upload an image (upto 5MB)</h3><?php isset($errors['image_file_1'])?><p class="errorMsg"><?php echo $errors['image_file_1'] ?></p>
    <input class="singleLineBox" type="file" name="image_file_1" accept=".jpg,.jpeg,.png,image/jpeg,image/png">

    <h3 class="fieldTitles">Image URL 2</h3><?php isset($errors['image_url_2'])?><p class="errorMsg"><?php echo $errors['image_url_2'] ?></p>
    <input class="singleLineBox imgUrl" type="text" name="image_url_2" value="<?php echo $image_url_2 ?>">

    <h3 class="fieldTitles">or upload an image (upto 5MB)</h3><?php isset($errors['image_file_2'])?><p class="errorMsg"><?php echo $errors['image_file_2'] ?></p>
    <input class="singleLineBox" type="file" name="image_file_2" accept=".jpg,.jpeg,.png,image/jpeg,image/png">

    <h3 class="fieldTitles">Category*</h3><?php isset($errors['category'])?><p class="errorMsg"><?php echo $errors['category'] ?></p>
    <select name="category" required>
      <option value="">Select a category</option>    
      <option value="Soup">Soup</option>
      <option value="Bakery">Bakery</option>
      <option value="Snacks">Snacks</option>
      <option value="Appetizer">Appetizer</option>
      <option value="Entree">Entree</option>
      <option value="Desserts">Desserts</option>    
    </select>
      
    <h3 class="fieldTitles">Prep Time*</h3><?php isset($errors['prep_time'])?><p class="errorMsg"><?php echo $errors['prep_time'] ?></p>
    <input type="text" name="prep_time" value="<?php echo $prep_time ?>" required>
      
    <h3 class="fieldTitles">Cook Time</h3><?php isset($errors['cook_time'])?><p class="errorMsg"><?php echo $errors['cook_time'] ?></p>
    <input type="text" name="cook_time" value="<?php echo $cook_time ?>">
      
    <h3 class="fieldTitles">Servings</h3><?php isset($errors['servings'])?><p class="errorMsg"><?php echo $errors['servings'] ?></p>
    <input type="text" name="servings" value="<?php echo $servings ?>">
      
    <h3 class="fieldTitles">Ingredients*</h3><?php isset($errors['ingredients'])?><p class="errorMsg"><?php echo $errors['ingredients'] ?></p>
    <textarea class="multiLineBox" name="ingredients" placeholder="Please separate ingredients by commas." rows="6" cols="50" required><?php echo $ingredients?></textarea>
      
    <h3 class="fieldTitles">Directions*</h3><?php isset($errors['directions'])?><p class="errorMsg"><?php echo $errors['directions'] ?></p>
    <textarea class="multiLineBox" name="directions" placeholder='Please use the following format, starting with "1.": &#10;1. &#10;2. &#10;3.&#10;etc.' rows="6" cols="50" required><?php echo $directions?></textarea>
    <div id="buttonDiv">
      <input id="submitButton" type="submit" value="Submit" name="img_upload">
    </div>      
  </form>    
  <!-- /Content --> 

<?php
  include($path."assets/inc/footer.php");
?>

  <!-- Scripts -->
  <script src="../script.js"></script>
  <!-- /Scripts -->
</body>
</html>