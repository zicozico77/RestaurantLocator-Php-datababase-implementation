$(window).load(function(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var data = JSON.parse(this.responseText);
            var count = 0;
            var row;
            var images = ['images/deal1.jpg','images/deal2.jpg','images/deal3.jpg','images/deal4.jpg','images/deal5.jpg','images/deal6.jpg',
            'images/deal7.jpg','images/deal8.jpg'];
            for(var i = 0; i < data.length; i++){
                var entry = data[i].description;
                if(count == 0){
                	row = document.createElement("tr");
                	$(row).append('<td> '+entry+' </td>');
                } else if(count == 3){
                	$(row).append('<td> '+entry+' </td>');
                	for(var j = 0; j <= count; j++){
                		$(row).children('td')[j].style.backgroundImage = 'url(' + 'https://infs3202-xes2q.uqcloud.net/Project/' + images[j + (i - count)] + ')';
                		css = {
                			'width': '100px',
                			'height': '50px',
                			'background-size': 'cover',
                			'font-size': '0.8em',
                			'font-weight': 'bold',
                			'color': 'black',
                			'text-shadow': '-1px 0 white, 0 1px white, 1px 0 white, 0 -1px white',
                			'text-align': 'center'
                		};
                		for(s in css){
                			$(row).children('td')[j].style[s] = css[s];
                		}
                	}
                	$('#ads').append(row);
                	count = 0;
                	continue;
                } else {
                	$(row).append('<td> '+entry+' </td>');
                } 
                count++;    
            }
        }
    }
    xmlhttp.open("GET", "https://infs3202-xes2q.uqcloud.net/Project/main.php", true);
    xmlhttp.send();



})

alertflag = 0;
function ping(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if(this.status == 0){
                if(alertflag == 0){
                    alert("Sorry, no internet connection detected. Please reconnect and try again");
                    alertflag = 1;
                }
            } else if(this.status == 200){
                alertflag = 0;
            }
        }
    }
    xmlhttp.open("POST", "https://infs3202-xes2q.uqcloud.net/Project/connectDBclaire.php", true);
    xmlhttp.send(); 
}

    

