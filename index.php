<!-- 
  Authors : Brandon Cooper, Niharika Dalal, Rahul Jaiswal, Wenhao Luebs, Zhao Qiwen.
  Mentor  : Takats, John-Paul.
  Dependencies : index.css, fonts.googleapis.com
 -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="./assets/css/index.css" />
    <!-- Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,400,500,600,700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap"
      rel="stylesheet"
    />
    <title>La Receta</title>
  </head>
  <body onload="toastToggle()">
    <!-- Header -->
      <header><span>la</span> receta</header>
    <!-- /Header -->
    <!-- Content -->
    <div class="homeContent">
    <!-- Toast to notify the user that their recipe is added -->
      <div class="toast"></div>
      <?php
        if(isset($_GET['recipe_added_message'])){
          $recipeAddedMessage = $_GET['recipe_added_message'];
        }
      ?>
      <script>
        // This function toggles the showing and hiding of the toast.
        function toastToggle(){
          var recipeAddedMessage = '<?php echo $recipeAddedMessage ?>'
          if(recipeAddedMessage){
            var toast = document.querySelector('.toast')
            toast.innerHTML = recipeAddedMessage
            setTimeout(() => {
              toast.classList.toggle('toastShow')
              setTimeout(() => {
                toast.classList.toggle('toastShow')
              }, 3500);
            }, 500);
          }
        }
      </script>

      <!-- Tagline -->
      <h2 class="tagline">
        Explore delicacies that find their way to your heart!
      </h2>
      <!-- Recipe Categories -->
      <div class="categories"></div>
      <!-- Button to add a recipe -->
      <div class="addARecipeButtonContainer">
        <div class="addARecipeButton">
          <img src="./assets/images/addARecipeIcon" alt="Add a recipe!" class="addARecipeIcon" />
          <h5 class="addARecipeText">Add your recipe!</h5>
        </div>
      </div>
    </div>
    <!-- Displaying categories of recipes -->
    <script>
      // Recipe categories
      var categoriesOptions = [
        {'title': 'Soup', "imgURL": './assets/images/categorySoup'},
        {'title': 'Bakery', "imgURL": './assets/images/categoryBakery'},
        {'title': 'Snacks', "imgURL": './assets/images/categorySnacks'},
        {'title': 'Appetizer', "imgURL": './assets/images/categoryAppetizers'},
        {'title': 'Entree', "imgURL": './assets/images/categoryEntree'},
        {'title': 'Dessert', "imgURL": './assets/images/categoryDesserts'}
      ]
      var categoriesHTML = ''

      // Loading recipe categories
      for(let i = 0; i< categoriesOptions.length; i++){
        categoriesHTML += '<div class="categoryCard" style="background: url(' + categoriesOptions[i].imgURL + '); background-size: cover; background-position: center">'
        categoriesHTML += '<div class="overlay">'
        categoriesHTML += '<h4 class="categoryName">' + categoriesOptions[i].title + '</h4></div></div>'
      }

      document.querySelector('.categories').innerHTML = categoriesHTML

      // Clicking on a recipe category navigates the user to a list of recipes of that category
      function openCategoryPage(category){
        // Opens the recipe titles in the specific category
        window.open("./pages/category_page.php?category=" + category, "_self");
      }

      var categoryCardsArray = document.querySelectorAll('.categoryCard')
      for(let i = 0; i < categoryCardsArray.length; i++){
        categoryCardsArray[i].addEventListener('click', function(){
          openCategoryPage(categoryCardsArray[i].innerText)
        })
      }
    </script>
    <!-- /Content -->
    <!-- Footer -->
    <footer>
      <div class="creditsPageLink"><a href="./pages/credits_page.php">Credits Page</a></div>
      <div class="footerContent">
        <div class="footerLeftSection">
          <p>@Group: La Receta</p>
          <p>Rochester Institute of Technology</p>
        </div>
        <div class="footerRightSection">
          <p>Department of Information Sciences and Technology</p>
          <p>Foundations of Web Technologies II</p>
          <p>Spring 2020</p>
        </div>
      </div>
    </footer>
    <!-- /Footer -->
    <!-- Scripts -->
    <script>
      document.querySelector('.addARecipeButton').addEventListener('click', function(){
          window.open('./pages/new_recipe_page.php', '_self')
      })
    </script>
    <script src="script.js"></script>
    <!-- /Scripts -->
  </body>
</html>
