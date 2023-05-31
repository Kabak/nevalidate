var Name_email = false;
var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject()
{
	var xmlHttp;
	if (window.ActiveXObject) {
		try {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {
			xmlHttp = false;
		}
	} else {
		try {
			xmlHttp = new XMLHttpRequest();
		} catch (e) {
			xmlHttp = false;
		}
	}
	if (!xmlHttp) {
		alert("Ошибка создания объекта XMLHttpRequest.");
	} else {
		return xmlHttp;
	}
}

function process_name()
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0) {
		SName = encodeURIComponent(document.getElementsByName("rusername")[0].value);

		if (SName.length > 0) {
			xmlHttp.open("GET", "index.php?r=nevalidate&name=" + SName, true);
			xmlHttp.onreadystatechange = handleServerResponse;
			xmlHttp.send(null);
		} else {
			Drop_Name();
		}
	} else {
		setTimeout('process_name()', 1000);
	}
	Name_email = false;
}

function process_email()
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0) {
		email_1 = encodeURIComponent(document.getElementsByName("ruseremail")[0].value);
		if (email_1.length > 0) {
			xmlHttp.open("GET", "index.php?r=nevalidate&email=" + email_1, true);
			xmlHttp.onreadystatechange = handleServerResponse;
			xmlHttp.send(null);
		} else {
			Drop_Email();
		}
	} else {
		setTimeout('process_email()', 1000);
	}
	Name_email = true;
}

function handleServerResponse()
{
	if (xmlHttp.readyState == 4) {
		if (xmlHttp.status == 200) {
			xmlResponse = xmlHttp.responseXML;
			xmlDocumentElement = xmlResponse.documentElement;

			var str2 = new RegExp("true");

			if (!Name_email) {
				var NameFound = xmlDocumentElement.getElementsByTagName("NameFound")[0].innerHTML;
				var Yep = str2.test(NameFound);
				if (Yep) {
					var Str_name_unswer = xmlDocumentElement.getElementsByTagName("Unswer")[0].innerHTML;
					document.getElementById("divMy_Name").innerHTML = '<strong>' + Str_name_unswer + '</strong>';
					document.getElementsByName("rusername")[0].style.borderColor = "#ed1010";
					document.getElementsByName("rusername")[0].style.outline = "0px none";
					document.getElementsByName("rusername")[0].style.boxShadow = "0px 1px 1px rgba(0, 0, 0, 0.075) inset";
					document.getElementsByName("rusername")[0].style.boxShadow = "0px 0px 8px rgba(237,16,16, 0.6)";
				} else {
					Drop_Name();
				}
			} else {
				var EmailFound = xmlDocumentElement.getElementsByTagName("EmailFound")[0].innerHTML;
				var Yep = str2.test(EmailFound);
				if (Yep) {
					var Str_email_unswer = xmlDocumentElement.getElementsByTagName("Unswer")[0].innerHTML;
					document.getElementById("divEmail").innerHTML = '<strong>' + Str_email_unswer + '</strong>';
					document.getElementsByName("ruseremail")[0].style.borderColor = "#ed1010";
					document.getElementsByName("ruseremail")[0].style.outline = "0px none";
					document.getElementsByName("ruseremail")[0].style.boxShadow = "0px 1px 1px rgba(0, 0, 0, 0.075) inset";
					document.getElementsByName("ruseremail")[0].style.boxShadow = "0px 0px 8px rgba(237,16,16, 0.6)";
				} else {
					Drop_Email();
				}
			}
			delete str2;
		} else {
			alert("При обращении к серверу возникли проблемы: " + xmlHttp.statusText);
		}
	}
}

function Drop_Email()
{
	document.getElementById("divEmail").innerHTML = '';
	document.getElementsByName("ruseremail")[0].style.borderColor = "#ccc";
	document.getElementsByName("ruseremail")[0].style.outline = "0px none";
	document.getElementsByName("ruseremail")[0].style.boxShadow = "0px 1px 1px rgba(0, 0, 0, 0.075) inset";
}

function Drop_Name()
{
	document.getElementById("divMy_Name").innerHTML = '';
	document.getElementsByName("rusername")[0].style.borderColor = "#ccc";
	document.getElementsByName("rusername")[0].style.outline = "0px none";
	document.getElementsByName("rusername")[0].style.boxShadow = "0px 1px 1px rgba(0, 0, 0, 0.075) inset";
}