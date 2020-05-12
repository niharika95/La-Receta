<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Category</title>
    </head>
    <body>
        <!--
        Page to display Different recipie categories. 
        Dependencies : category_page.css, header.php, footer.php, fonts.googleapis.com
        -->
        <?php
            $path="../";
            $title = "Category";
            $css = "category_page";
            include ($path."assets/inc/header.php");
        ?>
        <?php
            if(isset($_GET["category"])) {
                    $category = $_GET["category"];
                } else {
                    //Will be set to 'not found' in final, entree is temporary for testing
                    $category = "Entree";
                }
        ?>
        <!-- Header -->
        <header><span class="headerLink" onClick="goToHomePage()"><span class="laFormatting">la</span> receta</span></header>
        <!-- /Header -->
        <!-- Content -->
        <div class="categoryPageContent">
            <!-- Button to add a recipe -->
            <div class="addARecipeButtonContainer">
                <div class="addARecipeButton">
                    <img src="../assets/images/addARecipeIcon" alt="Add a recipe!" class="addARecipeIcon" />
                    <h5 class="addARecipeText">Add your recipe!</h5>
                </div>
            </div>
            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                <a href="../index.php">Home</a>  >  <?php echo $category; ?>
            </div>

            <div class="categoryTitle"><?php echo $category; ?></div>
            <hr />

            <!-- Recipes -->
            <div class="categories">
                <?php
                
                $conn = new mysqli("localhost", "iste646t02", "couldcontinue", "iste646t02");

                if(!$conn) {
                    echo "There was an error connecting to the database.";
                }

                $query = "SELECT * FROM recipes WHERE category = '" .$category ."'";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                    echo "<div class='categoryCard' onclick='openRecipe(".$row["id"].")' style='background: url(" .$row['image_url_1'] ."); background-size: cover; background-position: center'>";
                    echo "<div class='overlay'>";
                    echo "<p class='categoryName'>" .$row["recipe_name"] ."</p>";
                    echo "</div></div>";
                }

                mysqli_close($conn);
                ?>
                <script>
                    // This function navigates the user to the specific recipe page.
                    function openRecipe(rowId){
                        window.open("recipe_page.php?id=" + rowId, "_self")
                    }
                </script>
            </div>
        </div>
        <!-- /Content -->
        <!-- Footer -->
        <?php
        include($path."assets/inc/footer.php");
        ?>
        <!-- /Footer -->
        <!-- Scripts -->
        <script>
            // This function navigates the user to the page where they can add recipes.
            document.querySelector('.addARecipeButton').addEventListener('click', function(){
                window.open('./new_recipe_page.php', '_self')
            })
        </script>
        <script src="../script.js"></script>
        <!-- /Scripts -->
    </body>
</html>