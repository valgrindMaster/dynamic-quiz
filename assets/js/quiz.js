function validateForm() {
    var radios = document.getElementsByTagName('input');
    var i;
    for (i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            return true;
        }
    }

    var area = document.getElementById('formTextArea');
    if (area != null && area.value.trim() != "") {
    	return true;
    }
    
    return (document.getElementById('error-message') == null) ? sendError(true) : sendError(false);
}

function sendError(displayMessage) {
	if (!displayMessage) return false;
	
	var topErrorMsg = document.createElement('p');
	topErrorMsg.className = 'text-error';
	var n1 = document.createTextNode('There was a problem with your submission. Errors have been highlighted below.');
	topErrorMsg.appendChild(n1);
	topErrorMsg.id = 'error-message';

	var bottomErrorMsg = document.createElement('p');
	bottomErrorMsg.className = 'text-error';
	var n2 = document.createTextNode('This field is required.');
	bottomErrorMsg.appendChild(n2);

	var header = document.getElementsByClassName("quiz-header")[0];
	header.insertBefore(topErrorMsg, header.childNodes[0]);

	var submit = document.getElementById('submit');
	submit.insertBefore(bottomErrorMsg, submit.childNodes[0]);

	return false;
}