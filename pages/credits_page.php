<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resources</title>
</head>
<body>
      <!--
      Page to display credits for the references used while developing this website. 
      Dependencies : credits_page.css, header.php, footer.php, fonts.googleapis.com
    -->
    <?php
      $path="../";
      $title="Credits";
      $css = "credits_page";
      include ($path."assets/inc/header.php");
    ?>
    <!-- Header -->
    <header><span class="headerLink" onClick="goToHomePage()"><span class="laFormatting">la</span> receta</span></header>
    <!-- /Header -->
    <!-- Content -->
    <div class="creditsPageContent">
      <div class="creditsTitle">Credits</div>
      <!-- Tagline -->
      <h2 class="tagline">
        Thank you for sharing resources with us!
      </h2>
      <div class="creditsContent"></div>
    </div>
    <!-- /Content -->
    <!-- Footer -->
    <?php
      include($path."assets/inc/footer.php");
    ?>
    <!-- /Footer -->
    <script>
      //Fetching references/credit information from a JSON file
      var creditsURL = '../credits.json'
      var creditsXHR = new XMLHttpRequest()
      var creditsHTML = ''

      creditsXHR.onload = function(){
        var creditsJSON = JSON.parse(creditsXHR.responseText)
        var credits = creditsJSON.credits

        for(let i = 0; i < credits.length; i++){
          creditsHTML += '<a class="creditName" href="' + credits[i].creditUrl + '" target="_blank">' + credits[i].creditName + '</a>'
          creditsHTML += '<p class="creditDescription">' + credits[i].creditDescription + '</p>'
        }

        document.querySelector('.creditsContent').innerHTML = creditsHTML
        document.querySelector('body').innerHTML += '<script type="text/javascript" src="../script.js" />'
      }

      creditsXHR.open('GET', creditsURL, true)
      creditsXHR.send()

      // Clicking on the title in the header will navigate the user to the home page.
      function goToHomePage() {
        window.open('../index.php', '_self')
      }
    </script>
</body>
</html>