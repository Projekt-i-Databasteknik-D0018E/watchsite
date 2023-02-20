function visaFunction() {
    document.getElementById("sprak").classList.toggle("show");
    
}

window.onclick = function(event) {
  if (!event.target.matches('.dropKnapp')) {
    var dropdowns = document.getElementsByClassName("språkLista");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}