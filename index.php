<h1>NORTON'S DISCORD FLOODER!</h1>
<hr>
<p id="response"></p>
<p id="sending">SENDING REQUEST TO API.PHP...</p>
<hr>
<button onclick="load()">Load Tokens</button><br>
<br>
<input id="invite" placeholder="invite code"><br>
<button onclick="join();">Join Server</button><br>
<br>
<input id="id" placeholder="channel id"><br>
<input id="message" placeholder="message"><br>
<button onclick="spam();">Spam Message</button><br>

<script>
document.getElementById("sending").style.visibility = "hidden";
document.getElementById("response").style.visibility = "hidden";


function load() {
  document.getElementById("sending").style.visibility = "visible";
  
  //request
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("sending").style.visibility = "hidden";
	  document.getElementById("response").innerHTML = this.responseText;
	  document.getElementById("response").style.visibility = "visible";
	}
  };
  xhttp.open("POST", "api.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("load=1337");
}

function join() {
  document.getElementById("sending").style.visibility = "visible";
  
  var invite = document.getElementById('invite').value;
  
  //request
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("sending").style.visibility = "hidden";
	  document.getElementById("response").innerHTML = this.responseText;
	  document.getElementById("response").style.visibility = "visible";
	}
  };
  xhttp.open("POST", "api.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("join=" + invite);
}

function spam() {
  document.getElementById("sending").style.visibility = "visible";
  
  var id = document.getElementById('id').value;
  var message = document.getElementById('message').value;
  
  //request
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("sending").style.visibility = "hidden";
	  document.getElementById("response").innerHTML = this.responseText;
	  document.getElementById("response").style.visibility = "visible";
	}
  };
  xhttp.open("POST", "api.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("channelid=" + id + "&message=" + message);
}

</script>