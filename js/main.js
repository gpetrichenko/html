deg = 0;
function movePokeball() {
    deg += 5;
    var element = document.getElementById("pokeball");
    if (parseInt(element.style.left) >= window.outerWidth/4 && parseInt(element.style.left) <= window.outerWidth/4+75)
      element.style.top = parseInt(element.style.top) - 7 + 'px';
    if (parseInt(element.style.left) >= window.outerWidth/4+75 && parseInt(element.style.left) <= window.outerWidth/4+125)
        element.style.top = parseInt(element.style.top) - 3 + 'px';
    if (parseInt(element.style.left) >= window.outerWidth/4+125 && parseInt(element.style.left) <= window.outerWidth/4+175)
            element.style.top = parseInt(element.style.top) + 3 + 'px';
    if (parseInt(element.style.left) >= window.outerWidth/4+175 && parseInt(element.style.left) <= window.outerWidth/4+250)
                element.style.top = parseInt(element.style.top) + 7 + 'px';
                if (parseInt(element.style.left) >= window.outerWidth/2 && parseInt(element.style.left) <= window.outerWidth/2+50)
                  element.style.top = parseInt(element.style.top) - 7 + 'px';
                if (parseInt(element.style.left) >= window.outerWidth/2+50 && parseInt(element.style.left) <= window.outerWidth/2+75)
                    element.style.top = parseInt(element.style.top) - 1 + 'px';
                if (parseInt(element.style.left) >= window.outerWidth/2+75 && parseInt(element.style.left) <= window.outerWidth/2+100)
                        element.style.top = parseInt(element.style.top) + 1 + 'px';
                if (parseInt(element.style.left) >= window.outerWidth/2+100 && parseInt(element.style.left) <= window.outerWidth/2+150)
                            element.style.top = parseInt(element.style.top) + 7 + 'px';
    element.style.left = parseInt(element.style.left) + Math.random() + 2 + 'px';
    element.style.transform = 'rotate('+ deg + 'deg)'; 
    if (parseInt(element.style.left) > window.outerWidth - 100)
      stopPokeball();
}
function stopPokeball() {  
  var element = document.getElementById("pokeball");
  var hh = window.outerHeight-220;
  element.style.top = hh+"px";
  element.style.left = "-100px";
}

function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
      'total': t,
      'days': days,
      'hours': hours,
      'minutes': minutes,
      'seconds': seconds
    };
  }
  
  function initializeClock(id, endtime) {
    var clock = document.getElementById(id);
    var daysSpan = clock.querySelector('.days');
    var hoursSpan = clock.querySelector('.hours');
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');
  
    function updateClock() {
      var t = getTimeRemaining(endtime);
  
      daysSpan.innerHTML = t.days;
      hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
      minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
      secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
  
      if (t.total <= 0) {
        clearInterval(timeinterval);
      }
    }
  
    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
  }
  
  var deadline="September 09 2019 08:50:00 GMT+0700";
  initializeClock('countdown', deadline);

    
