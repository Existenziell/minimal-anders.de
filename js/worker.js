/* minimal-anders.de JavaScript Library
 * 
 * @authors Christof Bauer
 *
 */

// Triggered by postMessage from client
onmessage = function (evt) {
	
	var url = "../include/proxy.php?q=" + evt.data;

	ajax = new XMLHttpRequest();
	ajax.open ('GET', url, true);
	ajax.send(null);
	
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {
			// when ready, push data back to client
			postMessage(ajax.responseText);
			//postMessage(ajax.responseXML);
		}
		
	}
};
