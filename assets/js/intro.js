function displayOverlay() {
	var container = document.getElementById('prompt-container');
	container.style.display = "block";

	var overlay = createOverlay();
	overlay.style.WebkitAnimation = "fade 0.5s ease-out 0s 1 normal";
	overlay.style.animation = "fade 0.5s ease-out 0s 1 normal";
	overlay.style.animationFillMode = "forwards";
	container.appendChild(overlay);
	
	var form = createForm();
	form.style.WebkitAnimation = "fade_trans 1s ease-out 0s 1 normal";
	form.style.animation = "fade_trans 1s ease-out 0s 1 normal";
	form.style.animationFillMode = "forwards";
	container.appendChild(form);

	// Center form.
	form.style.position = "relative";
	form.style.width = "500px";
	form.style.margin = "25px auto";
}

function removeOverlay() {
	var overlay = document.getElementsByClassName('overlay')[0];
	overlay.style.WebkitAnimation = "fade_away 0.5s ease-out 0s 1 normal";
	overlay.style.animation = "fade_away 0.5s ease-out 0s 1 normal";
	overlay.style.animationFillMode = "forwards";

	var prompt_form = document.getElementsByClassName('prompt-form')[0];
	prompt_form.style.WebkitAnimation = "fade_trans_away 0.5s ease-out 0s 1 normal";
	prompt_form.style.animation = "fade_trans_away 0.5s ease-out 0s 1 normal";
	prompt_form.style.animationFillMode = "forwards";

	setTimeout(function() {
		var container = document.getElementById('prompt-container');
		container.style.display = "none";
	 	prompt_form.parentElement.removeChild(prompt_form);
	 	overlay.parentElement.removeChild(overlay);
	}, 500);
}

function toggleDisplay(elem) {
	var elem_display = getStyle(elem, "display");
	if (elem_display == "none") {
		elem.style.opacity = "0";
		elem.style.display = "initial";
	}
    getStyle(elem, "display") === "none" ? elem.style.display = "initial" : elem.style.display = "none";
	setTimeout(function(){elem.parentNode.removeChild(removeTarget);}, 1000);
}

function getStyle(elem, name) {
    return elem.currentStyle ? elem.currentStyle[name] : window.getComputedStyle ? window.getComputedStyle(elem, null).getPropertyValue(name) : null;
}

function createForm() {
	var form = document.createElement('form');
	form.action = "quiz.php";
	form.className = "prompt-form";
	form.method = "POST";

	var button = createFormButton();
	form.appendChild(button);

	var h1 = createFormHeader();
	form.appendChild(h1);

	var fname_label = createFormLabel('First Name *', 'fname');
	form.appendChild(fname_label);

	var fname_input = createFormInput('text', 'firstname', 'fname');
	form.appendChild(fname_input);

	var email_label = createFormLabel('Email *', 'email');
	form.appendChild(email_label);

	var email_input = createFormInput('email', 'email', 'email');
	form.appendChild(email_input);

	var div_submit = createFormSubmit();
	form.appendChild(div_submit);

	var p = createFormParagraph();
	form.appendChild(p);

	form.onsubmit = function() { return sendform(); };
	document.onkeypress = function(e) {
		if (e.which == 13) { return sendform(); }
	};

	return form;
}

function sendform() {
	var prompt_form = document.getElementsByClassName('prompt-form')[0];

	if (!validateForm()) {
		var bullet = createFormBullet();
		if (!document.getElementById('form-error')) {
			var p = createFormError(bullet, 'Both fields must be non-empty.');
			prompt_form.insertBefore(p, prompt_form.firstChild);
		}
		return false;
	} else {
		removeOverlay();
		return true;
	}
}

function createFormBullet() {
	var bullet = document.createElement('img');
	bullet.src = 'assets/media/bullet.png';
	bullet.style.width = '10px';
	bullet.style.height = '10px';
	bullet.style.lineHeight = '10px';
	bullet.style.marginRight = '25px';
	return bullet;
}

function createFormError(bullet, text) {
	var p = document.createElement('p');
	var node = document.createTextNode(text);
	p.appendChild(bullet);
	p.appendChild(node);
	p.id = 'form-error';
	return p;
}

function createFormButton() {
	var button = document.createElement('button');
	button.onclick = function() {
		removeOverlay();
	};
	button.className = "close";
	return button;
}

function createFormHeader() {
	var h1 = document.createElement('h1');
	var node = document.createTextNode('Where should we send the result?');
	h1.appendChild(node);
	h1.id = 'form-header';
	return h1;
}

function createFormLabel(text, forVal) {
	var label = document.createElement('label');
	var node = document.createTextNode(text);
	label.appendChild(node);
	label.for = forVal;
	return label;
}

function createFormInput(type, name, id) {
	var input = document.createElement('input');
	input.type = type;
	input.name = name;
	input.id = id;
	return input;
}

function createFormSubmit() {
	var div = document.createElement('div');
	div.style = "width: 100%; text-align: center;";

	var input = createFormInput('submit', 'promptSubmit', 'submit');
	input.style.padding = "8px 65px";
	input.className = 'btn-send';
	input.value = 'SEND';

	div.appendChild(input);
	return div;
}

function createFormParagraph() {
	var p = document.createElement('p');
	p.style.fontSize = "14px";

	var node = document.createTextNode('Logomania has a reputation for being logotastic and fantastic all at once. Here\'s another example sentence of our awesomeness. Here you go - another. Here\'s another sentence to fill up some more space so this looks similar to the other site.');
	p.appendChild(node);

	return p;
}

function createOverlay() {
	var div = document.createElement('div');
	div.onclick = function() {
		removeOverlay();
	};
	div.className = 'overlay';
	return div;
}

function validateForm() {
	var fname = document.getElementById('fname');
	var email = document.getElementById('email');

	return (!fname.value || !email.value) ? false : true;
}