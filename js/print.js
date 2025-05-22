function printReport() {
	// Get the report text and title
	var reportText = document.getElementById('report-text').value;
	var reportTitle = document.getElementById('report-title').value;
	
	// Create a new window
	var printWindow = window.open('', '', 'height=600,width=800');
	
	// Write the report text to the new window
	printWindow.document.write('<html><head><title>'+ reportTitle + '</title></head><body><pre>' + reportText + '</pre></body></html>');
	
	// Print the new window
	printWindow.print();
	
	// Close the new window
	printWindow.close();
}

function printLog() {
  var printContents = document.getElementById("print-area").innerHTML;
  var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
  location.reload();
}

