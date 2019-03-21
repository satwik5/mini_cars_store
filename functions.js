var modal = document.getElementById('myModal');
function addRowHandlers() {
    var table = document.getElementById("tableId");
    var rows = table.getElementsByTagName("tr");
    for (i = 0; i < rows.length; i++) {
        var currentRow = table.rows[i];
        var createClickHandler = 
            function(row) 
            {
			return function() {
				var str2 = row.getElementsByTagName("td")[1].innerHTML;
				var str3 = row.getElementsByTagName("td")[2].innerHTML;
				var details = document.getElementsByClassName("fullCarDetails");
				document.getElementsByClassName('modal-body')[0].innerHTML=''; 	//on every click making null in popup body
				var list = document.createElement("ol");
				var element = document.getElementsByClassName('modal-body')[0];
				element.appendChild(list);
				for(var j=0;j<details.length;j++){
					var str = details[j].innerHTML;
					str=str.substr(1,str.length-2	);
					var regex = new RegExp( str2, 'g' );
					var regex2 = new RegExp( str3, 'g' );
					if(str.match(regex)!=null &&str.match(regex2)!=null){
						modal.style.display = "block";
						var listItems = document.createElement("li");
						listItems.appendChild(document.createTextNode(str));
						list.appendChild(listItems);
						var createAnchor = document.createElement("a");
						var anchorText = document.createTextNode('Click Here To Delete');
						var att1 = document.createAttribute("href");
						att1.value = "#";
						createAnchor.setAttributeNode(att1);
						var att2 = document.createAttribute("onclick");
						att2.value = "deleteData('" + str + "');";
						createAnchor.setAttributeNode(att2);
						createAnchor.appendChild(anchorText);
						listItems.appendChild(createAnchor);
					}
				}
			};
		};
        currentRow.onclick = createClickHandler(currentRow);
    }
}
window.onload = addRowHandlers();

function deleteData(str) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            alert(xmlhttp.responseText); 
	location.reload();
        }
    };
    xmlhttp.open("GET", "delete_records.php?str=" +str, true);
    xmlhttp.send(); 
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}