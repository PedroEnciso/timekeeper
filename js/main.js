import Timer from "./Timer.js";

// get timer buttons
const start = document.getElementById("start");
const pause = document.getElementById("pause");
const reset = document.getElementById("reset");

// create the timer
const timer = Timer();

// assign button functions
start.addEventListener("click", () => {
  timer.startTimer();
});

pause.addEventListener("click", () => {
  timer.stopTimer();
});

reset.addEventListener("click", () => {
  timer.resetTimer();
});
