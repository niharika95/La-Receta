// POSITIONING OF THE FOOTER: If the scrollbar is present, the footer will be positioned at the end of the document. If the scrollbar is not present, the footer will be positioned (fixed) at the end of the bottom of the browser.
var footer = document.querySelector('footer')
if (
  document.documentElement.clientHeight ===
  document.documentElement.scrollHeight
) {
  footer.style.position = 'fixed'
  footer.style.bottom = 0
} else if (
  document.documentElement.clientHeight < document.documentElement.scrollHeight
) {
  footer.style.position = 'relative'
}

// Clicking on the title in the header will navigate the user to the home page.
function goToHomePage() {
  window.open('../index.php', '_self')
}
