<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe</title>
</head>
<body>
    <!--
    Recipie page to display individual recipe description. 
    Dependencies : recipe.css, header.php, footer.php, fonts.googleapis.com
    -->
    <?php 
        $path = "../";
        $title="Recipe";
        $css = "recipe_page";
        include ($path."assets/inc/header.php");
    ?>
    <!-- Header -->
    <header><span class="headerLink" onClick="goToHomePage()"><span class="laFormatting">la</span> receta</span></header>
    <!-- /Header -->
    <!-- Content -->
    <div class="recipePageContent">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs"></div>
        <!-- Breadcrumbs -->
        <!-- Recipie Description start-->
        <div class="recipeTitle"></div>
        <div class="chefName"></div>
        <div class="recipeDescription"></div>
        <div class="recipeImageContainer"></div>
        <div class="timings"></div>
        <div class="ingredients">
            <p class="ingredientsTitle">Ingredients</p>
            <p class="ingredientsText"></p>
        </div>
        <div class="directions">
            <p class="directionsTitle">Directions</p>
            <p class="directionsText"></p>
        </div>
        <!-- Recipie Description end-->
        <?php
            if(isset($_GET["id"])) {
                $id = $_GET["id"];
            } else {
                $id = "not found";
            }
            
            // Connecting to the database
            $conn = new mysqli("localhost", "iste646t02", "couldcontinue", "iste646t02");

            if(!$conn) {
                echo "There was an error connecting to the database.";
            }

            // Querying data from the database
            $query = "SELECT * FROM recipes WHERE id = " .$id;
            $result = mysqli_query($conn, $query);
            // Storing data from db locally.
            while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                $chefName = $row["chef_name"];
                $recipeName = $row["recipe_name"];
                $description = $row["description"];
                $imageUrl1 = $row["image_url_1"];
                $imageUrl2 = $row["image_url_2"];
                $category = $row["category"];
                $prepTime = $row["prep_time"];
                $cookTime = $row["cook_time"];
                $servings = $row["servings"];
                $ingredients = $row["ingredients"];
                $directions = $row["directions"];
            }

            mysqli_close($conn);
        ?>
        <script>
            var chefName = <?php echo json_encode($chefName) ?>;
            var recipeName = <?php echo json_encode($recipeName) ?>;
            var description = <?php echo json_encode($description) ?>;
            var imageUrl1 = <?php echo json_encode($imageUrl1) ?>;
            var imageUrl2 = <?php echo json_encode($imageUrl2) ?>;
            var category = <?php echo json_encode($category) ?>;
            var prepTime = <?php echo json_encode($prepTime) ?>;
            var cookTime = <?php echo json_encode($cookTime) ?>;
            var servings = <?php echo json_encode($servings) ?>;
            var ingredients = <?php echo json_encode($ingredients) ?>;
            var directions = <?php echo json_encode($directions) ?>;
            // Formatting data fetched from database
            var breadcrumbsHTML = '<a href="../index.php">Home</a>  >  <a href="./category_page.php?category=' + category + '">' + category +'</a>  >  ' + recipeName
            var recipeImageHTML = '<img src="' + imageUrl1 +'" alt="' + recipeName + '" class="recipeImage" /><img src="' + imageUrl2 +'" alt="' + recipeName + '" class="recipeImage" />'
            var timingsHTML = '<div><p class="timingText">Prep Time</p><p class="timingValue">' + prepTime + '</p></div>'
            timingsHTML += '<div><p class="timingText">Cook Time</p><p class="timingValue">' + cookTime + '</p></div>'
            timingsHTML += '<div><p class="timingText">Servings</p><p class="timingValue">' + servings + '</p></div>'
            var ingredientsHTML = ''
            var ingredientsArrayHTML = ingredients.split(', ')
            for(let i = 0; i < ingredientsArrayHTML.length; i++){
                ingredientsHTML += '<input type="checkbox" id="ingredient'+ i +'"><label for="ingredient' + i + '">&nbsp' + ingredientsArrayHTML[i] + '</label><br>'
            }
            var directionsHTML = ''
            var directionsArrayHTML = directions.split(/\d\./)
            for(let i = 1; i < directionsArrayHTML.length; i++){
                directionsHTML += '<p><b>STEP ' + i + '</b><br>' + directionsArrayHTML[i] + '</p><br>'
            }

            // Displaying formatted data
            document.querySelector('.breadcrumbs').innerHTML = breadcrumbsHTML
            document.querySelector('.recipeTitle').innerHTML = recipeName
            document.querySelector('.chefName').innerHTML = '- ' + chefName
            document.querySelector('.recipeDescription').innerHTML = description
            document.querySelector('.recipeImageContainer').innerHTML = recipeImageHTML
            document.querySelector('.timings').innerHTML = timingsHTML
            document.querySelector('.ingredientsText').innerHTML = ingredientsHTML
            document.querySelector('.directionsText').innerHTML = directionsHTML
        </script>
    </div>
    <!-- /Content -->

<?php
  include($path."assets/inc/footer.php");
?>
    <!-- Scripts -->
    <script src="../script.js"></script>
    <!-- /Scripts -->
</body>
</html>