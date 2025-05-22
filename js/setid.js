function getIdValues(button) {
    var row = button.parentNode.parentNode;
    var ids = row.cells[0].innerHTML;
    var e_name = row.cells[2].innerHTML;
    document.getElementById("user_id").value = ids;
    document.getElementById("edit_name").value = e_name;
    const heading = document.getElementById('edit_name');
    heading.textContent = e_name;



    
  }

  // function getIdValues(button) {
  //   var row = button.parentNode.parentNode;
  //   var ids = row.cells[0].innerHTML;
  //   document.getElementById("user_id").value = ids;

  //   // Create an XMLHttpRequest object
  //   var xhr = new XMLHttpRequest();
  
  //   // Prepare the request
  //   xhr.open("POST", "http://192.168.1.16/includes/setid.php", true);
    
  //   // Set the content type header (if required)
  //   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
  //   // Define the data to be sent to the server
  //   var data = "edit_ids=" + encodeURIComponent(ids);
    
  //   // Send the request
  //   xhr.send(data);
  // }
  