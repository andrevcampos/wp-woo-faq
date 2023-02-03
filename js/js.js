// JavaScript Document

// Status button from admin menu
function myFunction() {
var x = document.getElementById("status").checked;
if (x == true){
    document.getElementById("plugininformation").style.display = "block";
}else{
    document.getElementById("plugininformation").style.display = "none";
}
console.log(x);
}

// Save button from admin menu
function buttonsave(url) {
    var status = document.getElementById("status").checked;
    var descriptiontab = document.getElementById("descriptiontab").checked;
    var questioncolor = document.getElementById("questioncolor").value.substring(1);
    var ansercolor = document.getElementById("ansercolor").value.substring(1);
    var background = document.getElementById("backgroundpdfcolor").value.substring(1);
    var titlecolor = document.getElementById("titlecolor").value.substring(1);
    var title = document.getElementById("title").value;

    var margintop = document.getElementById("margintop").value;
    var marginbottom = document.getElementById("marginbottom").value;
    var paddingtop = document.getElementById("paddingtop").value;
    var paddingbottom = document.getElementById("paddingbottom").value;
    var fontsizeanser = document.getElementById("fontsizeanser").value;
    var fontsizequestion = document.getElementById("fontsizequestion").value;
    var fontsizetitle = document.getElementById("fontsizetitle").value;


    var newurl = url + "?status=" + status + "&fontsizetitle=" + fontsizetitle + "&fontsizequestion=" + fontsizequestion + "&fontsizeanser=" + fontsizeanser + "&paddingbottom=" + paddingbottom + "&paddingtop=" + paddingtop + "&marginbottom=" + marginbottom + "&margintop=" + margintop + "&descriptiontab=" + descriptiontab + "&titlecolor=" + titlecolor + "&questioncolor=" + questioncolor + "&ansercolor=" + ansercolor + "&background=" + background + "&title=" + title;
    // console.log(newurl);
    // return;
    var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	//document.getElementById('texterror').innerHTML = "aqui";
	window.location.href='?page=my-menu-faq';
	}
	};
	xhttp.open("GET", newurl, true);
	xhttp.send();
}

// Save button from product page
function pbuttonsave(url, productid) {

    document.getElementById("error").style.color = "red";
    document.getElementById("error").innerHTML = "";

    var urldelete = url.replace("bm-add.php", "bm-delete.php");
    var question = document.getElementById("faqquestion").value;
    var anser = document.getElementById("faqanser").value;

    if(!question){
        document.getElementById("error").innerHTML = "The Question is empty!";
        return;
    }
    if(!anser){
        document.getElementById("error").innerHTML = "The Anser is empty!";
        return;
    }

    var newurl = url + "?question=" + question + "&anser=" + anser + "&id=" + productid;

    var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {

	if (this.readyState == 4 && this.status == 200) {
        var response = this.responseText;
        var ppproductid = "a" + response;

        var element = document.createElement("div");
        element.style.cssText = 'width:100%;display:inline-block;min-width:100% !important;border-bottom: 1px solid #8c8f94;';
        var pproductid = "p" + response;
        element.setAttribute("id", pproductid)
        var p = document.getElementById("productgeral_faq");
        p.appendChild(element);

        var element2 = document.createElement("div");
        element2.style.cssText = 'cursor:pointer;float:right;width:80px;height:25px;size:16px;background-color:#aa3210;color:white;text-align:center;padding-top:5px;';
        element2.appendChild(document.createTextNode('Delete'));
        var texttoadd = "pbuttondelete('" + urldelete + "', '" + response + "')";
        element2.setAttribute("onclick",texttoadd);
        var p2 = document.getElementById(pproductid);
        p2.appendChild(element2);

        var element3 = document.createElement("div");
        element3.style.cssText = 'float:left;padding-top:5px;font-size:16px;font-weight:bold;margin-left:10px;width:calc(100% - 150px);';
        element3.appendChild(document.createTextNode(question));
        var texttoaddd = "qbox('" + ppproductid + "')";
        element3.setAttribute("onclick",texttoaddd);
        document.getElementById(pproductid).appendChild(element3);

        var element4 = document.createElement("div");
        element4.setAttribute("id", ppproductid)
        element4.setAttribute("class", "expandable")
        var p = document.getElementById("productgeral_faq");
        p.appendChild(element4);

        var element5 = document.createElement("div");
        element5.appendChild(document.createTextNode(anser));
        element5.style.cssText = 'padding-top:5px;font-size:16px;margin-left:10px';
        var p5 = document.getElementById(ppproductid);
        p5.appendChild(element5);

        document.getElementById("faqquestion").value = "";
        document.getElementById("faqanser").value = "";

        document.getElementById("error").style.color = "#5eba7d";
        document.getElementById("error").innerHTML = "Question added successfully.";

	}
	};
	xhttp.open("GET", newurl, true);
	xhttp.send();
}

function pbuttondelete(url, productid) {

    document.getElementById("error").style.color = "red";
    document.getElementById("error").innerHTML = "";

    var divremove = "p" + productid;
    var divremove2 = "a" + productid;
    var newurl = url + "?id=" + productid;

    var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
        document.getElementById(divremove).remove();
        document.getElementById(divremove2).remove();
	}
	};
	xhttp.open("GET", newurl, true);
	xhttp.send();
}
function qbox(divid) {

    var box = document.getElementById(divid);
    if(box.style.display == "none"){
        box.style.display="inline-block";
    }else{
        box.style.display="none";
    }
}