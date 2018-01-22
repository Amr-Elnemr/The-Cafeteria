var details = document.getElementsByClassName('det');
var table2 = document.getElementById('table2');

window.addEventListener("click", function() {
  for (var i = 0; i < details.length; i++) {
    if (details[i].open == true) {
      table2.style.display = 'block';
    }
    else {
      table2.style.display = 'none';
    }
  }
})
