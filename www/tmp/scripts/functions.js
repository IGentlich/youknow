

function ajaxRequest(url, callback, params, json = 1) {
  var http = new XMLHttpRequest();
  http.open("POST", url, true);

  http.onreadystatechange = function() {
      if(http.readyState == 4 && http.status == 200) {
          if(json == 1) {
            callback(JSON.parse(http.responseText));
          } else {
            callback(http.responseText);
          }
      }
  }
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http.send(params);
}

function sjaxRequest(url, callback, params, json = 1) {
  var http = new XMLHttpRequest();
  http.open('POST', url, false);
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http.send(params);

  if (http.status === 200) {
    if(json == 1) {
      callback(JSON.parse(http.responseText));
    } else {
      callback(http.responseText);
    }
  }
}


function findParent (element, cl) {
  while ((element = element.parentElement) && !element.classList.contains(cl));
  return element;
}


function isEmpty(str) {
    return (!str || 0 === str.length);
}

function shuffleArray(array) {
  var copy = [], n = array.length, i;

  // While there remain elements to shuffle…
  while (n) {

    // Pick a remaining element…
    i = Math.floor(Math.random() * n--);

    // And move it to the new array.
    copy.push(array.splice(i, 1)[0]);
  }

  return copy;
}

function isNumeric(value) {
    return /^\d+$/.test(value);
}

function toCamelCase(str) {
    return str.toLowerCase().replace(/(\-[a-z])/g, function($1) {
        return $1.toUpperCase().replace('-', '');
    });
}


function preventDefaults (e) {
  e.preventDefault();
  e.stopPropagation();
}