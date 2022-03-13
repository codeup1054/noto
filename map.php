<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAmP1vh9PymwuiWKHXxuatlIGu_dhDSWeg&extension=.js'></script> 
 
<script> 
    google.maps.event.addDomListener(window, 'load', init);
    var map;
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(36.488747, -4.962723),
            zoom: 15,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT,
            },
            disableDoubleClickZoom: true,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            },
            scaleControl: true,
            scrollwheel: false,
            panControl: true,
            streetViewControl: true,
            draggable : true,
            overviewMapControl: true,
            overviewMapControlOptions: {
            opened: false,
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        }
        var mapElement = document.getElementById('map-map');
        var map = new google.maps.Map(mapElement, mapOptions);

        var markerImage = new google.maps.MarkerImage('images_desktop/map-logo-75.png',
            new google.maps.Size(75, 60), //size
            new google.maps.Point(0, 0), //origin point
            new google.maps.Point(60, 60)); // offset point
        
          var geo =  {lat: 36.489, lng: -4.962723} ; 

          var locations = [['Title', 'desc', 'phone', 'email', 'site', 36.5000347, -4.97162359999993, 'https://mapbuildr.com/assets/img/markers/default.png']];
        
        for (i = 0; i < locations.length; i++) {
			if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
			if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
			if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
           if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
           if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
            
            var centerLatLng = new google.maps.LatLng(36.488747, -4.962723 + 0.03);
            
            marker = new google.maps.Marker({
                icon: markerImage,
                center: centerLatLng,
                position: geo,
                map: map,
                title: locations[i][0],
                desc: description,
                tel: telephone,
                email: email,
                web: web
            });
link = '';     }

}
</script>
<style>
    #map-map {
        height:300px;
        width:100%;
    }
    .gm-style-iw * {
        display: block;
        width: 100%;
    }
    .gm-style-iw h4, .gm-style-iw p {
        margin: 0;
        padding: 0;
    }
    .gm-style-iw a {
        color: #4272db;
    }
</style>

<div id='map-map'></div>