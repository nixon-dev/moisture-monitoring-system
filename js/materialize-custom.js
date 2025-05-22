
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
    var instances = M.Dropdown.init(elems, options);
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems);
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, options);

  });

  $(document).ready(function(){
    $('.dropdown-trigger').dropdown();
  });

  function showData(td) {
    // Get the text content of the clicked cell
    var data = td.textContent;
    
    // Put the data into a text field
    document.getElementById("user_id").value = data;
  }


    var togglePassword = document.querySelector('#toggle-password');
    var password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
    // toggle the icon
        this.textContent = type === 'password' ? 'visibility' : 'visibility_off';
});