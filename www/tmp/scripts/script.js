document.getElementById("html-report-button").addEventListener("click", () => {
    showClientsWindow('html');
});

document.getElementById("csv-report-button").addEventListener("click", () => {
    showClientsWindow('csv');
});

document.addEventListener("keydown", (e) => {
    if(e.key === "Escape") {
        document.getElementsByClassName('dialog-overlay')[0].remove();
    }
});

function showClientsWindow(type) {
    if(!document.getElementsByClassName("show-clients-dialog-window")[0]) {
        document.getElementsByClassName("inner-placeholder")[0].innerHTML += `<div class="dialog-overlay">
                                                                                <div class="show-clients-dialog-window dialog-window hidden-dialog-window">
                                                                                  <div class="dialog-header">${type} report</div>
                                                                                  <div class="dialog-body">
                                                                                    <button class="btn" onclick="findParent(this, 'dialog-overlay').remove(); showOneClientWindow('${type}')">Ein Mandant</button>
                                                                                    <button class="btn" onclick="findParent(this, 'dialog-overlay').remove(); showManyClientsWindow('${type}')">Mehrere Mandanten</button>
                                                                                  </div>
                                                                                  <div class="dialog-buttons">
                                                                                    <div class="btn" onclick="findParent(this, 'dialog-overlay').remove()">Cancel</div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>`;
        document.getElementsByClassName("show-clients-dialog-window")[0].style.marginTop = "calc(50vh - " + (document.getElementsByClassName("show-clients-dialog-window")[0].clientHeight / 2) + 'px)';
        document.getElementsByClassName("show-clients-dialog-window")[0].classList.remove("hidden-dialog-window");
      }
}

function clientSelectChangeListener(value) {
  console.log(value);
  let clientOptions = '';
  let clients;

  switch(value) {
    case "one_client_with_time":
      clients = getAllClients();
      for(let i = 0; i < clients.data.length; i++) {
        clientOptions += `<option value="${clients.data[i].id}">${clients.data[i].name}</option>`;
      }
      document.getElementById("one-client-time-selector").innerHTML = ``;
      document.getElementById("one-client-selector").innerHTML = `<div>Mandanten:</div>
                                                                  <select onchange="enableGetReportButton()" name="client_id">
                                                                    ${clientOptions}
                                                                  </select>`;

      document.getElementById("one-client-time-selector").innerHTML = `<div>Start Datum:</div>
                                                                       <input type="datetime-local" name="startdate" />
                                                                       <div>End Datum:</div>
                                                                       <input type="datetime-local" name="enddate" />`;
    break;
    case "one_client":
      clients = getAllClients();
      for(let i = 0; i < clients.data.length; i++) {
        clientOptions += `<option value="${clients.data[i].id}">${clients.data[i].name}</option>`;
      }
      document.getElementById("one-client-time-selector").innerHTML = ``;
      document.getElementById("one-client-selector").innerHTML = `<div>Mandanten:</div>
                                                                  <select onchange="enableGetReportButton()" name="client_id">
                                                                    ${clientOptions}
                                                                  </select>`;
    break;
    case "all_clients":
      document.getElementById("all-clients-time-selector").innerHTML = ``;
    break;
    case "all_clients_and_users":
      document.getElementById("all-clients-time-selector").innerHTML = ``;
    break;
    case "all_clients_with_time":
      document.getElementById("all-clients-time-selector").innerHTML = `<div>Start Datum:</div>
                                                                       <input type="datetime-local" name="startdate" />
                                                                       <div>End Datum:</div>
                                                                       <input type="datetime-local" name="enddate" />`;
    break;
  }
}

function enableGetReportButton() {
  let btn = document.getElementById("get-report-button");
  btn.classList.remove("disabled");
  btn.removeAttribute("disabled");
}

function showOneClientWindow(type) {
    
    if(!document.getElementsByClassName("show-one-client-dialog-window")[0]) {
        document.getElementsByClassName("inner-placeholder")[0].innerHTML += `<div class="dialog-overlay">
                                                                                <div class="show-one-client-dialog-window dialog-window hidden-dialog-window">
                                                                                  <div class="dialog-header">${type} report > Ein Mandant</div>
                                                                                  <div class="dialog-body">
                                                                                    <div>Typ:</div>
                                                                                    <select onchange="clientSelectChangeListener(this.value)" name="client_type">
                                                                                      <option disabled selected>Select</option>  
                                                                                      <option value="one_client">Liste eines Mandanten mit der Nutzungszeit eines jeden Benutzers dieses Mandanten</option>
                                                                                      <option value="one_client_with_time">Liste eines Mandanten mit der Nutzungszeit eines jeden Benutzers dieses Mandanten, gefiltert für einen gewissen Zeitraum</option>
                                                                                    </select>
                                                                                    <div id="one-client-selector"></div>
                                                                                    <br><br>
                                                                                    <div id="one-client-time-selector"></div>
                                                                                  </div>
                                                                                  <div class="dialog-buttons">
                                                                                  <div class="btn" onclick="findParent(this, 'dialog-overlay').remove()">Cancel</div>
                                                                                  <div class="btn disabled" id="get-report-button" disabled onclick="getReport('${type}', this)">Get Report</div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>`;
        document.getElementsByClassName("show-one-client-dialog-window")[0].style.marginTop = "calc(50vh - " + (document.getElementsByClassName("show-one-client-dialog-window")[0].clientHeight / 2) + 'px)';
        document.getElementsByClassName("show-one-client-dialog-window")[0].classList.remove("hidden-dialog-window");
      }
}

function getAllClients() {
  let clients;
  sjaxRequest('http://localhost:8001/index.php?cl=ajax', function(result) {
    clients = result;
  }, `fnc=getAllClients`);
  return clients;
}

function showManyClientsWindow(type) {
    if(!document.getElementsByClassName("show-one-client-dialog-window")[0]) {
        document.getElementsByClassName("inner-placeholder")[0].innerHTML += `<div class="dialog-overlay">
                                                                                <div class="show-one-client-dialog-window dialog-window hidden-dialog-window">
                                                                                  <div class="dialog-header">${type} report > Mehrere Mandanten</div>
                                                                                  <div class="dialog-body">
                                                                                    <div>Mandanten Typ:</div>
                                                                                    <select onchange="clientSelectChangeListener(this.value); enableGetReportButton()" name="client_type">
                                                                                        <option disabled selected>Select</option>  
                                                                                        <option value="all_clients">Liste aller Mandanten jeweils mit der Gesamtzeit am System</option>
                                                                                        <option value="all_clients_with_time">Liste aller Mandanten jeweils mit der Gesamtzeit am System, gefiltert für einen gewissen Zeitraum</option>
                                                                                        <option value="all_clients_and_users">Liste aller Mandanten mit den dazugehörigen Benutzern</option>                                                                                        </option>
                                                                                    </select>
                                                                                    <br><br>
                                                                                    <div id="all-clients-time-selector"></div>
                                                                                  </div>
                                                                                  <div class="dialog-buttons">
                                                                                    <div class="btn" onclick="findParent(this, 'dialog-overlay').remove()">Cancel</div>
                                                                                    <div class="btn disabled" id="get-report-button" disabled onclick="getReport('${type}', this)">Get Report</div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>`;
        document.getElementsByClassName("show-one-client-dialog-window")[0].style.marginTop = "calc(50vh - " + (document.getElementsByClassName("show-one-client-dialog-window")[0].clientHeight / 2) + 'px)';
        document.getElementsByClassName("show-one-client-dialog-window")[0].classList.remove("hidden-dialog-window");
      }
}

function getReport(type, element) {
  let report_type = '';
  let client_type = '';
  let start_date = '';
  let end_date = '';
  let client_id = '';

  if(!element.classList.contains("disabled")) {
    report_type = type;
    if(document.getElementsByName("client_type")[0]) {
      client_type = document.getElementsByName("client_type")[0].options[document.getElementsByName("client_type")[0].selectedIndex].value;
    }
    if(document.getElementsByName("startdate")[0]) {
      start_date  = document.getElementsByName("startdate")[0].value;
    }
    if(document.getElementsByName("enddate")[0]) {
      end_date    = document.getElementsByName("enddate")[0].value;
    }
    if(document.getElementsByName("client_id")[0]) {
      client_id   = document.getElementsByName("client_id")[0].options[document.getElementsByName("client_id")[0].selectedIndex].value;
    }
    
    
    ajaxRequest('http://localhost:8001/index.php?cl=ajax', function(result) {
      if(result.data.url != false) {
        showNotificationMessage(`Fertig: <a target="_blank" href="http://localhost:8001${result.data.url}">` + result.data.url + `</a>`);
      } else {
        showNotificationMessage(`Error: No data to report`);
      }
    }, `fnc=getReport&data=` + JSON.stringify({report_type:report_type, client_type:client_type, client_id:client_id, start_date:start_date, end_date:end_date}));
  }
}


var notificationMessageTimeout;
function showNotificationMessage(text) {
  if(!document.getElementsByClassName("notification-message")[0]) {
    document.getElementsByClassName("inner-placeholder")[0].innerHTML += '<div onclick="this.remove()" class="notification-message hidden-notification-message">' + text + '</div>';
    document.getElementsByClassName("notification-message")[0].classList.remove("hidden-notification-message");
  } else {
    document.getElementsByClassName("notification-message")[0].innerHTML = text;
  }
  clearTimeout(notificationMessageTimeout);
  notificationMessageTimeout = setTimeout(function() {
    document.getElementsByClassName("notification-message")[0].classList.add("hidden-notification-message");
    setTimeout(function() {
      document.getElementsByClassName("notification-message")[0].remove();
    }, 1000);
  }, 3000);
}