// get the span tags from the timer
const hrDisplay = document.getElementById("hr");
const minDisplay = document.getElementById("min");
const secDisplay = document.getElementById("sec");

// get timer buttons
const start = document.getElementById("start");
const pause = document.getElementById("pause");
const reset = document.getElementById("reset");
const submit = document.getElementById("submit");

/// timer class
const createTimer = () => {
  let hr = 0;
  let min = 0;
  let sec = 0;
  let stopTime = true;

  // main timer methods
  const startTimer = () => {
    stopTime = false;
    disableButton(start);
    disableButton(reset);
    disableButton(submit);
    enableButton(pause);
    // alert so data is not lost
    window.addEventListener("beforeunload", alertBeforeLeaving);
    timerCycle();
  };

  const stopTimer = () => {
    stopTime = true;
    disableButton(pause);
    enableButton(submit);
    enableButton(start);
    enableButton(reset);
  };

  const resetTimer = () => {
    hr = min = sec = 0;
    stopTime = true;
    setTimerDisplay("00", "00", "00");
    disableButton(submit);
    // remove alert
    window.removeEventListener("beforeunload", alertBeforeLeaving);
  };

  // timer cycle logic
  const timerCycle = () => {
    sec = parseInt(sec);
    min = parseInt(min);
    hr = parseInt(hr);
    if (stopTime == false) {
      // timer is still running
      // add a second
      sec += 1;
      // check if a minute has passed
      if (sec == 60) {
        sec = 0;
        // add a minute
        min += 1;
      }
      // check if an hour has passed
      if (min == 60) {
        minute = 0;
        // add an hour
        hr += 1;
      }
      // convert to double digits
      if (sec < 10) {
        sec = "0" + sec;
      }
      if (min < 10) {
        min = "0" + min;
      }
      if (hr < 10) {
        hr = "0" + hr;
      }
      setTimerDisplay(hr, min, sec);
      setTimeout(timerCycle, 1000);
    }
  };

  // helper methods
  const setTimerDisplay = (hr, min, sec) => {
    hrDisplay.innerText = hr;
    minDisplay.innerText = min;
    secDisplay.innerText = sec;
  };

  const disableButton = (button) => {
    button.disabled = true;
  };

  const enableButton = (button) => {
    button.disabled = false;
  };

  // alert user when trying to leave the page
  // copied this from Google
  const alertBeforeLeaving = (event) => {
    event.preventDefault();
    // Chrome requires returnValue to be set
    e.returnValue = "";
  };

  return { startTimer, stopTimer, resetTimer };
};

// create the timer
const timer = createTimer();

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
