var selected = new Array();
var matches = new Array();
var highlight_inx = 0;
var divId = "results1"
function setDivId(newDivID){
	//window.alert(newDivID)
	divId = newDivID;	
}
function contains(arr, obj){
    var i = arr.length;
    while(i--){
        if( arr[i] == obj ){
            return true;    
        }   
    }
    return false;
}
function search(textId, e, handler) {
    search_text = document.getElementById(textId).value;
	
    var max;
    matches = new Array();
    for(cur in names){
        // change this to actually find matches
        try {
            pattern = new RegExp(search_text, "gi");
            if( pattern.test(names[cur]) && !contains(selected, names[cur])) {
                matches.push(names[cur]);       
            } 
        } catch( err) {
            if( err == "SyntaxError") {
                // Do nothing   
            }
        }
        if( matches.length > 0) {
            document.getElementById(divId).style.display = "block";
        }
    }
    if( search_text != "") {
        //document.getElementById("results").innerHTML = matches.join("<br>");
        max = matches.length;
        if( max > 10 ){
            max = 10;
        }
        if( highlight_inx > (max- 1) && (max > 0)) {
            highlight_inx = (max -1);
        }
        switch( e.keyCode ) {
            case 13:
				hideResults();
                if( matches.length > highlight_inx) {
                    handler(textId, matches[highlight_inx]);
                    highlight_inx = 0;
                    document.getElementById(divId).style.display = "none";
                }

                return;
                break;
            case 38:
                if( highlight_inx > 0) {
                    highlight_inx = highlight_inx - 1;
                }
                break;
            case 40:
                if( highlight_inx < (max - 1)) {
                    highlight_inx = highlight_inx + 1;
                }
                break;
        }
        document.getElementById(divId).innerHTML = "";
        if( (matches.length > 0) && (matches.length > (highlight_inx - 1))) {
            for(i=0; i < highlight_inx;i++){
                document.getElementById(divId).innerHTML += "<p class=\"dropdown\"\>" + matches[i] + "</p>\n";
            }
            
            document.getElementById(divId).innerHTML += "<p class=\"dropdown\" style=\"background-color:#c7d7ff;\">" + matches[highlight_inx] + "</p>\n";

            for(i=(highlight_inx+1); i < max;i++){
                document.getElementById(divId).innerHTML += "<p class=\"dropdown\">" + matches[i] + "</p>\n";
            }
        } 
    } else {
        document.getElementById(divId).innerHTML = "";
        document.getElementById(divId).style.display = "none";
        highlight_inx = 0;
    }    
}

function addSelected(textId, newSelection) {
    selected.push(newSelection);
    document.getElementById(textId).value=newSelection;
    //document.getElementById("results").innerHTML="";
    updateSelected();
}

function updateSelected(){
    document.getElementById("selectedDiv").innerHTML = "";
    for(cur in selected) {
        document.getElementById("selectedDiv").innerHTML += "<button type=\"button\" onclick=\"removeSelected(" +cur + ")\" value=\"X\">X</button>" + selected[cur]  +"<br>\n";  
    }
}
function removeSelected(index) {
    Array.remove(selected, index, index);
    updateSelected();

}

function postValue(val) {
    method = "POST";
    var file_name = document.location.href;
    var end = (file_name.indexOf("?") == -1) ? file_name.length : file_name.indexOf("?");
    var target = file_name.substring(file_name.lastIndexOf("/")+1, end);

    var form = document.createElement("form");
    form.setAttribute("id", "secretForm");
    form.setAttribute("method", method);
    form.setAttribute("action", target);

    if( typeof(val) == "string" ) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "val");
        hiddenField.setAttribute("value", val);
        form.appendChild(hiddenField);

    } else {
        for( i=0; i < val.length; i++) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", i);
            hiddenField.setAttribute("value", val[i]);
            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    document.getElementById("secretForm").submit();
}

function hideResults() {
    if( document.getElementById(divId) ) {
        document.getElementById(divId).style.display = "none";   
    }
}

// Array Remove - By John Resig (MIT Licensed)
Array.remove = function(array, from, to) {
    var rest = array.slice((to || from) + 1 || array.length);
    array.length = from < 0 ? array.length + from : from;
    return array.push.apply(array, rest);
}