var isMobile = false; //initiate as false
		// device detection
		if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
			|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
		
		
		var m = L.map('map',{preferCanvas: true,zoomControl: false, zoomSnap: 0.35});
		m.setView([18.76, 105.90], 6); //map view for Laos
		m.keyboard.disable();
		//add zoom and home control 
		L.control.zoom({
			position:'bottomleft'
		}).addTo(m);
		
		var home = {
			lat: 18.76,
			lng: 105.90,
			zoom: 6
		}; 

		L.easyButton('fa-home',function(btn,map){
			  map.setView([home.lat, home.lng], home.zoom);
			},'Zoom To Home', {
			position: 'bottomleft'
		}).addTo(m);

		// var OpenCartoMap = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		// 	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
		// 		//attribution:'Basemap data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> | Basemap style &copy; <a href="https://carto.com/attributions">CARTO</a>',
		// 		subdomains: 'abcd',
		// 		maxZoom: 20,
		// 		minZoom: 0,
		// 		fadeAnimation: false,
		// 		zoomAnimation: false,
		// 		markerZoomAnimation: false
		// });
		
		var OpenCartoMap = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}'+ (L.Browser.retina ? '@2x.png' : '.png'),{
				attribution:'Basemap data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> | Basemap style &copy; <a href="https://carto.com/attributions">CARTO</a>',
				subdomains: 'abcd',
				maxZoom: 20,
				minZoom: 0,
				fadeAnimation: false,
				zoomAnimation: false,
				markerZoomAnimation: false,
				updateWhenZooming: false,
				updateInterval: true
		});

		OpenCartoMap.addTo(m);
		// window.dispatchEvent(new Event('resize'));  
		const mapDiv = document.getElementById("map");
		const resizeObserver = new ResizeObserver(() => {
			m.invalidateSize();
		  });
		  
		  resizeObserver.observe(mapDiv);

		//map title
		var ctitle = L.control({position: 'topleft'});
		ctitle.onAdd = function () {
			var div = L.DomUtil.create('div', 'ctitle'),
			//this is for adding a logo as needed
			//holder ='<table><tr>' 
			//logo = '<td rowspan=2><img class="logo" src="logo_laos.png"></img></td>';
			//labels = "<td><h4>Poverty in Lao PDR</h4></td></tr><tr><td><p>Percentage of people in poverty by province/district: 2015</p></td></tr></table>";
			labelsn = "<h4>Dengue in Lao PDR</h4><p>Percentage of people in Dengue by province/district</p>";
		 
			div.innerHTML = labelsn;//holder + logo + labels;
			return div;
		};
		ctitle.addTo(m);
		//data/village.geojson
//https://data.opendevelopmentmekong.net/geoserver/ODMekong/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ODMekong%3Adata&outputFormat=application%2Fjson
		//var village_lay = new L.GeoJSON.AJAX("data/village.geojson",{onEachFeature:popUp, style:styleV});
		//var village_lay = new L.GeoJSON.AJAX("https://data.opendevelopmentmekong.net/geoserver/ODMekong/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ODMekong%3Adata&outputFormat=application%2Fjson", {
		var village_lay = new L.GeoJSON.AJAX("data/village.geojson", {
			pointToLayer: function (feature, latlng) {
			  var circleMarker = L.circle(latlng, {
				radius: 0,
				fillColor: 'red',
				color: "red",
				weight: 2
				//opacity: 0.5,
				//fillOpacity: 0.5
			  });
			  return(circleMarker);
			},
			onEachFeature:popUp//function (feature, layer) {
			//  var out = [];
			 // layer.bindPopup('Hi There');
			//   if (feature.properties) {
			// 	for (var key in feature.properties) {
			// 	  out.push(key + ": " + feature.properties[key]);
			// 	}
			// 	layer.bindPopup(out.join("<br />"), customOptions);
			//   }
			//}
			,style:styleV
		  });
		  function getRandomColor() {
			var letters = '0123456789ABCDEF';
			var color = '#';
			for (var i = 0; i < 6; i++) {
				color += letters[Math.floor(Math.random() * 16)];
			}
			return color;
		}
		var colors = ["#FF0000", "#FF7F00", "#FFFF00", "#00FF00", "#0000FF", "#4B0082", "#9400D3", 
              "#8B0000", "#FF4500", "#FFD700", "#ADFF2F", "#7CFC00", "#00CED1", "#1E90FF", 
              "#BA55D3", "#9370DB", "#3CB371", "#808080"];
		// var village_lay = new L.GeoJSON.AJAX("data/village.geojson",{onEachFeature:popUp, style:styleV});
		// var district_lay = new L.GeoJSON.AJAX("data/district_pov.geojson",{onEachFeature:popUp, style:function(feature,layer) {
		// 	//var colorIndex = feature.properties.pcode;
		// 	return {
		// 		weight: 1.2,
		// 		opacity: 0.9,
		// 		color: 'black',
		// 		fillOpacity: 0.3,
		// 		color: colors[feature.properties.PCode]
		// 	};
		// }});
		
		// var province_lay = new L.GeoJSON.AJAX("data/province_pov.geojson",{onEachFeature:popUp,style: function(feature) {
		// 	// Use the feature's properties to determine the color
		// 	//var colorIndex = feature.properties.pcode;
		// 	return {
		// 		weight: 3.5,
		// 		opacity: 0.9,
		// 		color: 'black',
		// 		fillOpacity: 0.45,
		// 		color: colors[feature.properties.PCode]
		// 	};
		// }}).addTo(m);
		var district_lay = new L.GeoJSON.AJAX("data/district_pov.geojson",{onEachFeature:popUpX, style:styleD});
		
		// $('input.autocomplete').autocomplete({
		// 	data: autocompleteData,
		// 	onAutocomplete: function(selectedDistrict) {
		// 		var layer = autocompleteData[selectedDistrict];
		// 		if (layer) {
		// 			map.fitBounds(layer.getBounds());
		// 			highlightFeature({ target: layer });
		// 			layer.openPopup();
		// 		}
		// 	}
		// });
		var province_lay = new L.GeoJSON.AJAX("data/province_pov.geojson",{onEachFeature:popUpX,style:styleP}).addTo(m);
		//var district_lay = new L.GeoJSON.AJAX("https://data.opendevelopmentmekong.net/lo/dataset/0073f53b-4852-4463-ba8d-32bdef6f5476/resource/d6156852-a57e-4908-8db4-768d9efcad21/download/district_pov.geojson",{onEachFeature:popUp, style:styleD});
		var district_point = new L.GeoJSON.AJAX("data/district_point.geojson", {
	pointToLayer: function (feature, latlng) {
		let key1ForKey2 = [];
		for (let key1 of Object.keys(counts)) {
   			 if (counts[key1][feature.properties.dcode]) {
        		key1ForKey2 = key1;
       		 	break;
    		}
		}
		var total = 0;
		try {
 		 total = counts[key1ForKey2][feature.properties.dcode]["total"]; 
		} catch (error) {
		}
		 // counts[key1ForKey2][feature.properties.dcode] === 'undefined' ? 0 : counts[key1ForKey2][feature.properties.dcode]["total"]
		// counts[key1ForKey2][feature.properties.dcode]["total"]
		var marker = L.marker(latlng, {
			icon: L.divIcon({
			  className: 'number-icon',
			  html: '<div id=\'d' + feature.properties.dcode + '\' >'+ total + '</div>'
			})
		  });
	  var circleMarker = L.circle(latlng, {
		radius: 0,
		fillColor: 'red',
		color: "red",
		weight: 6
		//opacity: 0.5,
		//fillOpacity: 0.5
	  });
	  var layerGroup = L.layerGroup([marker, circleMarker]);
	  return(layerGroup);
	},
	onEachFeature:popUp
	,style:styleV
  });

  var province_point = new L.GeoJSON.AJAX("data/province_point.geojson", {
	pointToLayer: function (feature, latlng) {
		var total = 0;//counts[feature.properties.pcode] === 'undefined' ? 0 : counts[feature.properties.pcode]["total"];
		try {
 		 total = counts[feature.properties.pcode]["total"]; 
		} catch (error) {
		}
		// console.log("log", counts[feature.properties.pcode] === 'undefined' ? 0 : counts[feature.properties.pcode]["total"]);
		var marker = L.marker(latlng, {
			icon: L.divIcon({
			  className: 'number-icon',
			  html: '<div id=\'p' + feature.properties.pcode + '\' >'+ total + '</div>'
			})
		  });
	  var circleMarker = L.circle(latlng, {
		radius: 0,
		fillColor: 'red',
		color: "red",
		weight: 6
		//opacity: 0.5,
		//fillOpacity: 0.5
	  });
	  var layerGroup = L.layerGroup([marker, circleMarker]);
	  return(layerGroup);
	},
	onEachFeature:popUp
	,style:styleV
  }).addTo(m);
		/////data.opendevelopmentmekong.net not available
		//var district_lay = new L.GeoJSON.AJAX("https://data.opendevelopmentmekong.net/geoserver/ODMekong/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ODMekong%3Alao_admbnda_adm2_ngd_20191112&outputFormat=application%2Fjson",{onEachFeature:popUp, style:styleD});
		//var province_lay = new L.GeoJSON.AJAX("https://data.opendevelopmentmekong.net/geoserver/ODMekong/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ODMekong%3Alao_admbnda_adm1_ngd_20191112&outputFormat=application%2Fjson",{onEachFeature:popUp,style:styleP}).addTo(m);
		
		
		function popUp(f,layer){
		
			var out = [];
			layer.on({
				mouseover: highlightFeature,
				mouseout: resetHighlight,
				click: onclick
			});
		};

		// var autocompleteData = {};
		function popUpX(f,layer){
		
			var out = [];
			layer.on({
				mouseover: highlightFeature,
				mouseout: resetHighlight,
				click: onclick
			});	
			// add autocompleteData if true
			// district_p": "ວຽງຈັນ", "district_1":
			// province_p
			if (feature.properties.District) {
				var name = layer.feature.properties.District;
				 autocompleteData[name + ' District'] = layer;
            	//districtData[name] = layer;

				
                // out.push("Name: " + feature.properties.name); // Adjust based on your property name
                // layer.bindPopup(out.join("<br />"));
            }esle{
		var name = layer.feature.properties.Province;
				 autocompleteData[name] = layer;		
	    }
		};
		 // Initialize autocomplete
		//  initializeAutocomplete();
		//  function initializeAutocomplete() {
        //     var autocompleteData = {};
        //     district_lay.on('data:loaded', function() {
        //         district_lay.eachLayer(function(layer) {
        //             var name = layer.feature.properties.name; // Adjust based on your property name
        //             autocompleteData[name] = null;
        //             districtData[name] = layer;
        //         });

        //         $('input.autocomplete').autocomplete({
        //             data: autocompleteData,
        //             onAutocomplete: function(selectedDistrict) {
        //                 var layer = districtData[selectedDistrict];
        //                 if (layer) {
        //                     map.fitBounds(layer.getBounds());
        //                     highlightFeature({ target: layer });
        //                     layer.openPopup();
        //                 }
        //             }
        //         });
        //     });
        // }

		// Creates an info box on the map
		var info = L.control({position: 'bottomright'});
		// var info = L.control({position: 'topright'});
		info.onAdd = function (map) {
			// this._div = L.DomUtil.create('div', 'info nomobile');
			this._div = L.DomUtil.create('div', 'info');
			this.update();
			return this._div;
		};
		// info.count = counts.total;
		// call this.count;

		info.update = function (props) {
			
			content =  '<table class="props"><tbody>';
				
			content +=  (props ? '<div class="areaName">' + props.Province + checkNull2(props.District)+ '</div>' : '<div class="areaName">Lao PDR</div><div class="areaName faded"><small><i>Hover over areas to view data</i><br></small></div>');//'<th>'+ checkNull2(props.District)+'</th></tr>';
									//checkNull2(props.province_p) +"<br>"+  checkNull2(props.district_p) +  checkNull2(props.district_1) + 
			content += '<tr><td class="ditem">Area [sq km]</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Area"].toFixed(0))) : '236,800') + '</div>'+ '</td></tr>';
			content += '<tr><td class="ditem">Population</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Population"].toFixed(0))) : '6,492,228') + '</div>'+ '</td></tr>';
			content += '<tr><td class="ditem">Density [per sq km]</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Density"].toFixed(1))) : '27') + '</div>'+ '</td></tr>';
			content += '<tr><td class="ditem">Urban population (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Urban_popu"].toFixed(1))) : '32.9') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Improved sanitation (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Improved_S"].toFixed(1))) : '71.1') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Improved water source (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Improved_W"].toFixed(1))) : '83.9') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Electricity access (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Using_Elec"].toFixed(1))) : '85.6') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Own a phone (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Own_a_Phon"].toFixed(1))) : '91.3') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Poverty headcount (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Poverty_He"].toFixed(1))) : '24.8') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Poverty gap (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Poverty_Ga"].toFixed(1))) : '6.0') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Poverty severity (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Poverty_Se"].toFixed(1))) : '--') + '</div>'+ '</td></tr>';
			//content += '<tr><td class="ditem">Province Cases      <td class="dval">'  +(props ? '' + (checkNull(counts[props["PCode"]]["total"])) : '--') + '</div>'+ '</td></tr>';
			//content += '<tr><td class="ditem">District Cases      <td class="dval">'  +(props ? '' + (counts[props["PCode"]][checkNull2(props["DCode"])] ? counts[props["PCode"]][props["DCode"]].total : '--') : '--')+ '</div>'+ '</td></tr>';
			
			content +=  (props ? '<tr><td class="ditem">Province Cases</td>         <td class="dval">' + (checkNull2(counts[props["PCode"]]) ? counts[props["PCode"]].total : '--' ) + '</div>'+ '</td></tr>' : '<tr><td class="ditem">Total Casess</td>         <td class="dval">'  + counts.total + '</div>'+ '</td></tr>');
			content +=  (props ? '<tr><td class="ditem">District Cases</td>         <td class="dval">' + ((props.PCode in counts) ? checkNull2(counts[props.PCode][props.DCode]) ? counts[props.PCode][props.DCode].total : '--' : '--') + '</div>'+ '</td></tr>' : ' ');
			// (checkNull2(props.DCode) in counts[props.PCode])
			content += '</tbody></table>'; 
			// checkNull2(counts.total)
			// props["DCode"] ? counts[props["PCode"]][props["DCode"]].total : 'B--'
			// (checkNull(counts[props["PCode"]][props["DCode"]]["total"]))
			this._div.innerHTML = content;
			};
			
		info.addTo(m);
		m.on('zoomend', function(){
								//10
			if (m.getZoom() >= 9) {
			  m.addLayer(district_lay);
			  district_lay.bringToFront();
			  m.addLayer(district_point);
			  district_point.bringToFront();
			  m.removeLayer(province_point);
			 // m.removeLayer(village_lay);
			 // if (m.getZoom() >= 9) {
				// m.addLayer(village_lay);
				// village_lay.bringToFront();
			//}

			  //m.removeLayer(village_lay);
			  //set style for province as 
			  //m.addLayer(village_lay);
				//village_lay.bringToFront();
			  
			// } else if (m.getZoom() >= 10) {
			// 	m.addLayer(village_lay);
			// 	village_lay.bringToFront();
			// 	//set style for province as 
				
				
			} else {
				m.addLayer(province_point);
				m.removeLayer(district_lay);
				m.removeLayer(district_point);
				
				// m.removeLayer(village_lay);
			}

  });
//   window.addEventListener('resize', function() {
//     circleMarker.setRadius(getMarkerRadius());
// });		
		function onclick(e){
			var bounds = e.target.getBounds();
			m.fitBounds(bounds);
				
			
		};

		function highlightFeature(e) {
			var layer = e.target;
			//layer.options.previousStyle = layer.options.style;
			layer.setStyle({
				weight: 3,
				color: '#636363',
				fillOpacity: 0.4
			});
			info.update(layer.feature.properties);
		};

		// This resets the highlight after hover moves away
		function resetHighlight(e) {
			//var layer = e.target;
			// layer.setStyle(layer.options.previousStyle);
			province_lay.setStyle(styleP);
			district_lay.setStyle(styleD);
			village_lay.setStyle(styleV);
			info.update();
		};

		function checkNull(val) {
		  if (val != null || val == "NaN") {
			return comma(val);
		  } else {
			return "--";
		  }
		};

		function checkNull2(val) {
		  if (val != null || val == "NaN") {
			return ", " + comma(val);
		  } else {
			return "";
		  }
		};

		// Use in info.update if GeoJSON data needs to be displayed as a percentage
		function checkThePct(a,b) {
		  if (a != null && b != null) {
			return Math.round(a/b*1000)/10 + "%";
		  } else {
			return "--";
		  }
		};

		// Use in info.update if GeoJSON data needs to be displayed with commas (such as 123,456)
		function comma(val){
		  while (/(\d+)(\d{3})/.test(val.toString())){
			val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
		  }
		  return val;
		};



		var cmap_poverty = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#990000'},
						{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#d7301f'},
						{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#ef6548'},
						{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#fc8d59'},
						{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#fdbb84'},
						{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#fdd49e'},
						{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#fee8c8'},
						{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#fff7ec'}];

		var cmap_density = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#7a0177'},
						{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#ae017e'},
						{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#dd3497'},
						{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#f768a1'},
						{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#fa9fb5'},
						{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#fcc5c0'},
						{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#fde0dd'},
						{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#fff7f3'}];
						
		var cmap_sanitation = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#005a32'},
						{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#238443'},
						{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#41ab5d'},
						{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#78c679'},
						{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#addd8e'},
						{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#d9f0a3'},
						{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#f7fcb9'},
						{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#ffffe5'}];
						
		var cmap_water = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#0c2c84'},
						{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#225ea8'},
						{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#1d91c0'},
						{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#41b6c4'},
						{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#7fcdbb'},
						{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#c7e9b4'},
						{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#edf8b1'},
						{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#ffffd9'}];

		var cmap_electricity = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#8c2d04'},
						{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#cc4c02'},
						{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#ec7014'},
						{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#fe9929'},
						{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#fec44f'},
						{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#fee391'},
						{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#fff7bc'},
						{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#ffffe5'}];
						  
		var cmap_tphone = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#6e016b'},
						{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#88419d'},
						{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#8c6bb1'},
						{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#8c96c6'},
						{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#9ebcda'},
						{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#bfd3e6'},
						{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#e0ecf4'},
						{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#f7fcfd'}];
						  
		var cmap_urban = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#005824'},
						{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#238b45'},
						{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#41ae76'},
						{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#66c2a4'},
						{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#99d8c9'},
						{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#ccece6'},
						{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#e5f5f9'},
						{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#f7fcfd'}];
		function get_var(legX) {

		  if (legX == "poverty")    return "Poverty_He";
		  if (legX == "density")  return "Density";
		  if (legX == "sanitation")     return "Improved_S";
		  if (legX == "water") return "Improved_W";
		  if (legX == "electricity") return "Using_Elec";
		  if (legX == "tphone") return "Own_a_Phon";
		  if (legX == "urban") return "Urban_popu";};
		// assign map coloring based on var
		function repaint_map(fill_variable) {

			province_lay.eachLayer(
			  function (layer) {  
			  
				switch(shading) {
				  case "water": 
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  case "density":
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  case "sanitation":
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  case "tphone":
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  case "electricity":
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  case "urban":
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  default:
					val = parseFloat(layer.feature.properties["Poverty_He"]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				}
			  }
			);
			district_lay.eachLayer(
			  function (layer) {  
			  
				switch(shading) {
				  
				  case "water": 
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  case "density":
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  case "sanitation":
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  case "tphone":
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  case "electricity":
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  case "urban":
					val = parseFloat(layer.feature.properties[fill_variable]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				  default:
					val = parseFloat(layer.feature.properties["Poverty_He"]);
					layer.setStyle({fillColor: getColor(val)});
					break;
				}
			  }
			);
			village_lay.eachLayer(
				function (layer) {  
				
				//   switch(shading) {
					
				// 	case "urcne": 
				// 	  val = parseFloat(layer.feature.properties[fill_variable]);
				// 	  layer.setStyle({fillColor: getColor(val)});
				// 	  break;
				// 	case "uscne":
				// 	  val = parseFloat(layer.feature.properties[fill_variable]);
				// 	  layer.setStyle({fillColor: getColor(val)});
				// 	  break;
				// 	case "uucne":
				// 	  val = parseFloat(layer.feature.properties[fill_variable]);
				// 	  layer.setStyle({fillColor: getColor(val)});
				// 	  break;
				// 	default:
				// 	  val = parseFloat(layer.feature.properties["Poverty_He"]);
				// 	  layer.setStyle({fillColor: getColor(val)});
				// 	  break;
				//   }
				}
			  );
			};	
			
		//these enable manual class methods
		function fileFilter(x)   { return x.file   == this; };
		function methodFilter(x) { return x.method == this; };
		function seedFilter(x)   { return x.seed   == this; };		

			
		//coloring var	
		var cmap = {"poverty" : cmap_poverty,
					"density" : cmap_density,
					"sanitation" : cmap_sanitation,
					"electricity" : cmap_electricity,
					"urban" : cmap_urban,
					"tphone" : cmap_tphone,
					"water" : cmap_water};

		//default value and var for legend			
		var shading = "poverty";
		var variable = "Poverty_He";	

		//function to get colors based on coloring on cmap	
		function getColor(d) {
			for (var vi in cmap[shading]) {
				if (d >= cmap[shading][vi].lower) {
				return cmap[shading][vi].fill;
				}
			}
			return '#BBB';
		};

		//function for layer style based on coloring on cmap
		function styleD(feature) {
			val = parseFloat(feature.properties[variable]);
			return {
				weight: 1.2,
				opacity: 0.9,
				color: 'black',
				fillOpacity: 0.3,
				fillColor: colors[feature.properties.PCode]
				// fillColor: getRandomColor()
				//fillColor: 'blue' getColor(val)
			};
		};
		function styleV(feature) {
			val = parseFloat(feature.properties[variable]);
			return {
				radius: 1,
				weight: 1,
				opacity: 0.9,
				color: 'red',
				fillOpacity: 0.65,
				fillColor: 'red'
				//fillColor: getColor(val)
			};
		};
		function style(feature) {
			val = parseFloat(feature.properties[variable]);
			return {
				weight: 1.2,
				opacity: 0.9,
				color: 'black',
				fillOpacity: 0.35,
				fillColor: 'gray'
				//fillColor: getColor(val)
			};
		};
		function styleP(feature) {
			val = parseFloat(feature.properties[variable]);
			return {
				weight: 3.5,
				opacity: 0.9,
				color: 'black',
				fillOpacity: 0.45,
				fillColor: colors[feature.properties.PCode]
				//fillColor: getRandomColor()
				//fillColor: 'green' getColor(val)
			};
		};
	

		//legend design
		var legend = L.control({position: 'bottomright'});

		legend.onAdd = function () {
			leg_select = '<select class="legend" id="shading_select">' + 
							'<option value="density">Density</option>' + 
							'<option value="poverty" selected=true>Poverty Rate (%)</option>' + 
							'<option value="sanitation">Improved Sanitation (%)</option>' + 
							'<option value="water">Improved Water Source (%)</option>' + 
							'<option value="electricity">Electricity Access (%)</option>' + 
							'<option value="tphone">Own a Phone (%)</option>' + 
							'<option value="urban">Urban Population (%)</option>' + 
						  '</select>';
			
			var labels = [];

			cmap[shading].forEach( function(v) {
					labels.push('<tr>' + 
						'<td class="cblock" style="background:' + v.fill + '"></td>' +
						'<td class="ltext">' + v.label + '</td></tr>');
				});
				
			//draw legend based on selected var
			var div = L.DomUtil.create('div', 'info legend');
			div.innerHTML = leg_select  + '<table class= "legend_t" id="legend_table">' + labels.join('') + '</table>';

			return div;
		};
		//legend.addTo(m);
/////////////////////////
		//var shading_sel  = document.getElementById("shading_select");
		var legend_table = document.getElementById("legend_table");
		//shading_sel.onchange = change_legend;

		function change_legend() {
			//get shading and variable from legend selector
			shading = shading_sel.value;
			variable = get_var(shading);
			repaint_map(variable);

			//retrieve the range for legends case by case, by equal count
			if (shading == "sanitation") {
				mini = 3, maxi = 0;
				district_lay.eachLayer(function (layer) {
					c = parseFloat(layer.feature.properties[variable])
					if (mini > c) mini = c;
					if (maxi < c) maxi = c;
				});

				step_size = (maxi - mini) / 8;
				for (var s = 0; s < 8; s++) {
					cmap_sanitation[7-s]["lower"] = mini + s * step_size;
					cmap_sanitation[7-s]["label"] = (mini + s * step_size).toFixed(1) + "&nbsp;-&nbsp;" + (mini + (s+1) * step_size).toFixed(1);
				}
				cmap_sanitation[7]["lower"] = mini;
			}
			
			if (shading == "water") {
				mini = 37, maxi = 0;
				district_lay.eachLayer(function (layer) {
					c = parseFloat(layer.feature.properties[variable])
					if (mini > c) mini = c;
					if (maxi < c) maxi = c;
				});

				step_size = (maxi - mini) / 8;
				for (var s = 0; s < 8; s++) {
					cmap_water[7-s]["lower"] = mini + s * step_size;
					cmap_water[7-s]["label"] = (mini + s * step_size).toFixed(1) + "&nbsp;-&nbsp;" + (mini + (s+1) * step_size).toFixed(1);
				}
				cmap_water[7]["lower"] = mini;
			}
			
			if (shading == "tphone") {
				mini = 54, maxi = 0;
				district_lay.eachLayer(function (layer) {
					c = parseFloat(layer.feature.properties[variable])
					if (mini > c) mini = c;
					if (maxi < c) maxi = c;
				});

				step_size = (maxi - mini) / 8;
				for (var s = 0; s < 8; s++) {
					cmap_tphone[7-s]["lower"] = mini + s * step_size;
					cmap_tphone[7-s]["label"] = (mini + s * step_size).toFixed(1) + "&nbsp;-&nbsp;" + (mini + (s+1) * step_size).toFixed(1);
				}
				cmap_tphone[7]["lower"] = mini;
			}
			
			if (shading == "urban") {
				mini = 4, maxi = 0;
				district_lay.eachLayer(function (layer) {
					c = parseFloat(layer.feature.properties[variable])
					if (mini > c) mini = c;
					if (maxi < c) maxi = c;
				});

				step_size = (maxi - mini) / 8;
				for (var s = 0; s < 8; s++) {
					cmap_urban[7-s]["lower"] = mini + s * step_size;
					cmap_urban[7-s]["label"] = (mini + s * step_size).toFixed(1) + "&nbsp;-&nbsp;" + (mini + (s+1) * step_size).toFixed(1);
				}
				cmap_urban[7]["lower"] = mini;
			}
			
			if (shading == "electricity") {
				mini = 24, maxi = 0;
				district_lay.eachLayer(function (layer) {
					c = parseFloat(layer.feature.properties[variable])
					if (mini > c) mini = c;
					if (maxi < c) maxi = c;
				});

				step_size = (maxi - mini) / 8;
				for (var s = 0; s < 8; s++) {
					cmap_electricity[7-s]["lower"] = mini + s * step_size;
					cmap_electricity[7-s]["label"] = (mini + s * step_size).toFixed(1) + "&nbsp;-&nbsp;" + (mini + (s+1) * step_size).toFixed(1);
				}
			  cmap_electricity[7]["lower"] = mini;
			}
			
			var labels = [];
			if (shading in cmap) {
				cmap[shading].forEach( function(v) {
					labels.push('<tr>' + 
						'<td class="cblock" style="background:' + v.fill + '"></td>' +
						'<td class="ltext">' + v.label + '</td></tr>');
				  });
			}
			legend_table.innerHTML = labels.join('');
			repaint_map(variable);
		};
	if (isMobile) {
		document.getElementsByClassName("nomobile")[0].style.display = "none";
	};
