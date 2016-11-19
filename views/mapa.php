  
   google.maps.event.addListener(marker, 'dragend', function() {
    updatePolyline ();
     //geocodePosition(marker.getPosition());
 
  });
   
   // Permito los eventos drag/drop sobre ambos  marcador P2
  google.maps.event.addListener(marker2, 'dragstart', function() {
    updatePolyline ();
  });
  
 google.maps.event.addListener(marker2, 'drag', function() {
    updatePolyline ();
  });
    
    google.maps.event.addListener(marker2, 'dragend', function() {
    updatePolyline ();
  });
  
   // Permito los eventos drag/drop sobre ambos  marcador P2
  google.maps.event.addListener(marker3, 'dragstart', function() {
    updatePolyline ();
  });
  
 google.maps.event.addListener(marker3, 'drag', function() {
    updatePolyline ();
  });
    
    google.maps.event.addListener(marker3, 'dragend', function() {
    updatePolyline ();
  });
  

 // CENTRO EL MAPA UTILIZANDO fitBound, 
 // para ello creo el array bounds, a¤ado todos mis marcadores
 
var bounds = new google.maps.LatLngBounds();
bounds.extend(latLng);
bounds.extend(latLng2);
bounds.extend(latLng3);
map.fitBounds(bounds);

// Esto es necesario para que se pueda reajustar el zoom  
google.maps.event.addListener(map, 'zoom_changed', function() {
    zoomChangeBoundsListener = 
        google.maps.event.addListener(map, 'bounds_changed', function(event) {
            if (this.getZoom() > 18 && this.initialZoom == true) {
                // Change max/min zoom here
                this.setZoom(18);
                this.initialZoom = false;
            }
        // this.setZoom(17);    
        google.maps.event.removeListener(zoomChangeBoundsListener);
    });
});
// Ahora realizo el ajuste de forma que quede el zoom ajustado
// y los marcadores centrados
map.initialZoom = true;
map.fitBounds(bounds);
  
//INICIALIZACION POLILINEA
  
    flightPlanCoordinates = [
    latLng,  latLng3,latLng2 ];
    
    
    flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    strokeWeight: <?echo $linea_ancho;?>,
    strokeOpacity: <?echo $linea_transparencia;?>, 
    strokeColor: '<?echo $linea_color;?>'
      });
 
  flightPath.setMap(map);
 
  
  // ETIQUETAS PARA LAS DISTANCIAS
 
  
          label1 = new Label({  map: map   });
          label1.set('zIndex', 1234);
          label1.bindTo('position', marker, 'position');
          label1.set('text', '');
          
          label2 = new Label({  map: map   });
          label2.set('zIndex', 1234);
          label2.bindTo('position', marker2, 'position');
          label2.set('text', '');
          
          label3 = new Label({  map: map   });
          label3.set('zIndex', 1234);
          label3.bindTo('position', marker3, 'position');
          label3.set('text', '');
          
          
          updatePolyline();
   
} // FIN INICIALIZACION
 
 
// REDIBUJA LA POLILINEA EN EL MAPA
function updatePolyline() {	
  // Borro la linea anterior	
  flightPath.setMap(null);
  
  // CALCULO LAS NUEVAS POSICIONES DE LOS MARCADORES
  var l1=marker.getPosition();
  var l2=marker2.getPosition();
  var l3=marker3.getPosition();	
  // DIBUJO LA POLILINEA
  flightPath.setPath([l1, l3, l2]);
  flightPath.setMap(map);
  
  // CALCULO LAS DISTANCIAS NUEVAS Y LAS IMPRIMO
  var dist_a= Math.round(google.maps.geometry.spherical.computeDistanceBetween (l2, l3));
  var dist_b= Math.round(google.maps.geometry.spherical.computeDistanceBetween (l1, l3));
  var dist_t= dist_a+dist_b;
  
  label1.set('text', dist_t+' mts');
  label2.set('text', dist_a+' mts');
  label3.set('text', dist_b+' mts');
  
}



// ACTUALIZO LA POSICION DEL MARCADOR 3 AL HACER CLICK
function updateMarker(location) {
        marker3.setPosition(location);
        updatePolyline();
        
      }
      
      
// CALCULO LA DISTANCIA TOTAL

	
</script>
 <style>
  #mapCanvas {
    width: 1000px;
    height: 500px;
    float: center;
  }
 
  </style>
</head>
<body onload="initialize()">

 
  </style>
 
<div id="mapCanvas"></div>
<center>
<p><font face="Arial" size="3" color="#006600"><b><a href="http://www.telegolf.org" target="_blank" style="color: #006600">Cortesia
de www.telegolf.org</a></b></font></p>
</center>
</body>
</html>