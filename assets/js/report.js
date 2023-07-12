var date = new Date();
var monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
var month = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday","Friday","Saturday"];
var day = dayNames[data.getDay()];
var time = date.getTime();
var dateNum = data.getDate();
var year = date.getFullYear();

var hours = date.getHours();
var AmOrPm = hours >= 12 ? 'pm' : 'am';
hours = (hours % 12) || 12;
var minutes = date.getMinutes();
var finalTime = "Time - " + hours + ":" + minutes + " " + AmOrPm;
finalTime;

var dDay = document.getElementById("day");
dDay.textContent = day + ", " + month + " " + dateNum + ", " + year + ", " + hours + ":" + minutes + " " + seconds;