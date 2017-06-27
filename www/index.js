function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        (document.getElementById('business_address')), {
            types: ['geocode']
        });
}

function geocodeAddress(geocoder, resultsMap) {
    address = document.getElementById('address').value;
    geocoder.geocode({
        'address': address
    }, function(results, status) {
        if (status === 'OK') {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            latlng = new google.maps.LatLng(latitude, longitude);
            resultsMap.setCenter(latlng);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });

}


function initMap() {
    geocoder = new google.maps.Geocoder();
    var address = document.getElementById('business_address').value;

    geocoder.geocode({
        'address': address
    }, function(results, status) {

        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            var latlng = new google.maps.LatLng(latitude, longitude);
            var mapOptions = {
                zoom: 12,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var latlng = new google.maps.LatLng(latitude, longitude);
            map.setCenter(latlng);
            var map_change = function() {
                var bounds = new google.maps.LatLngBounds();
                bounds = map.getBounds();
                var swPoint = bounds.getSouthWest();
                var nePoint = bounds.getNorthEast();
                swLat = swPoint.lat();
                swLng = swPoint.lng();
                neLat = nePoint.lat();
                neLng = nePoint.lng();
                cLat = map.getCenter().lat();
                cLng = map.getCenter().lng();
                addMarkers(map);
            }
            google.maps.event.addListener(map, 'dragend', map_change);
            google.maps.event.addListener(map, 'zoom_changed', map_change);
            google.maps.event.addListenerOnce(map, 'idle', map_change);
        }

    });



}

    var swLat;
    var swLng;
    var neLat;
    var neLng;
    var cLat;
    var cLng;
    var map;
    var geocoder;
    var gmarkers = [];
    var bar;
    var cafe;
    var restaurant;
    var start_date;
    var end_date;


function initialise() {
    initMap();

    document.getElementById('submit').addEventListener('click', function() {
        initMap();
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



function addMarkers(themap) {
    removeMarkers(gmarkers);
    var icons = {
        Bar: {
            icon: 'images/bar.png'
        },
        Restaurant: {
            icon: 'images/Restaurant.png'
        },
        Cafe: {
            icon: 'images/cafe.png'
        }
    };


    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var markers = JSON.parse(this.responseText);
            var infoWindow = new google.maps.InfoWindow;
            
            for (var i = 0; i < markers.length; i++) {
                var data = markers[i]
                var myLatlng = new google.maps.LatLng(data.lat, data.lng);
                
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: themap,
                    icon: icons[data.type].icon
                });
                gmarkers.push(marker);
                
                (function(marker, data) {
                    google.maps.event.addListener(marker, "click", function(e) {  
                        
                        var xmlhttpdeals = new XMLHttpRequest(); 
                        var printdeals = "";
                        var user_id = data.id;
                        
                        xmlhttpdeals.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                var deals = JSON.parse(this.responseText);
                                if (deals != null) {
                                for (var i = 0; i < deals.length; i++) {
                                    var data2 = deals[i]
                                    var dealtext = data2.description
                                    printdeals += "<li>" + dealtext + "</li>"
                                }
                                printdeals = '<h3><span style="color: #000000;">Current deals:</span></h3><ol>' + printdeals + '</ol>'
                                }
                                else {
                            printdeals = "<div style = 'width:200px;min-height:40px'>Sorry there are no deals for this location</div>"
                                }
                            }
                            
                            
                            
                            var content = 
                            '<h1 style="text-align: center;"><strong><span style="color: #008000;">' + data.name + '</span></strong></h1><h3 style="text-align: center;"><span style="color: #000000;"><strong>' + data.address + '</strong></span></h3>' + printdeals + 
'<p style="text-align: center;"><strong>CONTACT</strong></p><p style="text-align: center;">' + data.phone + '</p><p style="text-align: center;">' + data.email + '</p>'
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        infoWindow.setContent(content);
                        };
                            infoWindow.open(map, marker);
                        xmlhttpdeals.open("GET", "deals_pull.php?id=" + user_id, true);
                        xmlhttpdeals.send();
                        

                    });

                })(marker, data);


            }
        }


    };


    xmlhttp.open("GET", "map_db_pull.php?swLat=" + swLat + "&swLng=" + swLng + "&neLat=" + neLat + "&neLng=" + neLng + "&cLat=" + cLat + "&cLng=" + cLng + "&bar=" + bar + "&cafe=" + cafe + "&restaurant=" + restaurant + "&start_date=" + start_date + "&end_date=" + end_date, true);
    xmlhttp.send();

}

function removeMarkers(gmarkers){
    for(i=0; i<gmarkers.length; i++){
        gmarkers[i].setMap(null);
    }
}