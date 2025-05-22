// This code block is for the first gauge

const arc1 = document.querySelector("#arc1");
const temperature1 = document.querySelector("#temperature1");
const range1 = document.querySelector("#range1");

function updateArc1() {
  const arc_length = arc1.getTotalLength();
  const step = arc_length / (range1.max - range1.min);
  const value = (parseFloat(temperature1.textContent) - range1.min) * step;
  arc1.style.strokeDasharray = `${value} ${arc_length - value}`;
}

// Call the updateArc1 function initially to set the arc based on the initial temperature value
updateArc1();

// This one is for the second gauge

const arc2 = document.querySelector("#arc2");
const temperature2 = document.querySelector("#temperature2");
const range2 = document.querySelector("#range2");

function updateArc2() {
  const arc_length = arc2.getTotalLength();
  const step = arc_length / (range2.max - range2.min);
  const value = (parseFloat(temperature2.textContent) - range2.min) * step;
  arc2.style.strokeDasharray = `${value} ${arc_length - value}`;
}

// Call the updateArc2 function initially to set the arc based on the initial temperature value
updateArc2();

// Third Gauge

const arc3 = document.querySelector("#arc3");
const temperature3 = document.querySelector("#temperature3");
const range3 = document.querySelector("#range3");

function updateArc3() {
  const arc_length = arc3.getTotalLength();
  const step = arc_length / (range3.max - range3.min);
  const value = (parseFloat(temperature3.textContent) - range3.min) * step;
  arc3.style.strokeDasharray = `${value} ${arc_length - value}`;
}

// Call the updateArc3 function initially to set the arc based on the initial temperature value
updateArc3();
