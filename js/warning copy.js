
function checkRange1Value() {
  var rangeInput1 = document.getElementById("range1");
  var warningMessage1 = document.getElementById("warning1");
  var temperature1 = document.getElementById("temperature1");
  var buffer1 = document.getElementById("warning1buffer");
  

  if (rangeInput1.value < 40) {
    warningMessage1.style.display = "block";
    buffer1.style.display= "none";
    temperature1.style.color = "red";
    temperature1.style.fontWeight = "bold";
  }  else {
    warningMessage1.style.display = "none";
    buffer1.style.display= "block";
    temperature1.style.color = "green";
    temperature1.style.fontWeight = "bold";
  }
}
  
function checkRange2Value() {
  var rangeInput2 = document.getElementById("range2");
  var warningMessage2 = document.getElementById("warning2");
  var temperature2 = document.getElementById("temperature2");
  var buffer2 = document.getElementById("warning2buffer");
   
  if (rangeInput2.value < 40) {
    warningMessage2.style.display = "block";
    buffer2.style.display= "none";
    temperature2.style.color = "red";
    temperature2.style.fontWeight = "bold";
  }  else {
    warningMessage2.style.display = "none";
    buffer2.style.display= "block";
    temperature2.style.color = "green";
    temperature2.style.fontWeight = "bold";
  }
}

function checkRange3Value() {
  var rangeInput3 = document.getElementById("range3");
  var warningMessage3 = document.getElementById("warning3");
  var temperature3 = document.getElementById("temperature3");
  var buffer3 = document.getElementById("warning3buffer");

  if (rangeInput3.value < 40) {
    warningMessage3.style.display = "block";
    buffer3.style.display= "none";
    temperature3.style.color = "red";
    temperature3.style.fontWeight = "bold";
  }  else {
    warningMessage3.style.display = "none";
    buffer3.style.display= "block";
    temperature3.style.color = "green";
    temperature3.style.fontWeight = "bold";
  }
}