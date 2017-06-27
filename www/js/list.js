function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        (document.getElementById('business_address')), {
            types: ['geocode']
        });
    
}

function codeAddress() {
    var geocoder = new google.maps.Geocoder();
    var address = document.getElementById("address").value;
    console.log(address);

    radius = document.getElementById("radius").value;
    if (radius == "" && start > 0){
        alert("please select a distance value");
    }
    console.log(radius);
    console.log(document.getElementById("radius").value);
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

          latitude = results[0].geometry.location.lat();
          longitude = results[0].geometry.location.lng();
          console.log(latitude);
          console.log(longitude);
          getData();
        } 
    });
}

var latitude;
var longitude;
var radius;

function initialise() {
    start = 0;
    codeAddress();

    document.getElementById('searchAddress').addEventListener('click', function() {
         start = 1;
         $('#list').empty();
         codeAddress();
    });

}

function getParams() {
    var idx = document.URL.indexOf('?');
    var params = new Array();
    if (idx != -1) {
        var pairs = document.URL.substring(idx + 1, document.URL.length).split('&');
        for (var i = 0; i < pairs.length; i++) {
            nameVal = pairs[i].split('=');
            params[nameVal[0]] = nameVal[1];
        }
    }
    return params;
}

function getData(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            for(var i = 0; i < data.length; i++){
                var entry = data[i];
                $('#list').append('<tr><td> '+entry.name+' </td> <td> '+entry.deal+' </td> <td> '+entry.address+' </td> <td>' +entry.type+' </td></tr>');       
            }
            $('#list').children().css("background-color", "#cccccc");
        }
    }
    xmlhttp.open("GET", "https://infs3202-xes2q.uqcloud.net/Project/list.php?latitude=" + latitude + "&longitude=" + longitude + "&radius=" + radius, true);
    xmlhttp.send();
}






