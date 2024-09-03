var isMobile = false; //initiate as false
		// device detection
		if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
			|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
		
		
		// var m = L.map('map',{zoomControl: false, zoomSnap: 0.35 , renderer: L.svg()});
		var m = L.map('map',{zoomControl: false, zoomSnap: 0.35});
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

		

		var OpenCartoMap = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}'+ (L.Browser.retina ? '@2x.png' : '.png'),{
				attribution:'Basemap data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> | Basemap style &copy; <a href="https://carto.com/attributions">CARTO</a>',
				subdomains: 'abcd',
				maxZoom: 19,
				minZoom: 0,
				fadeAnimation: false,
				zoomAnimation: false,
				markerZoomAnimation: false,
				updateWhenZooming: false,
				updateInterval: true
		});
			 
		
			
		OpenCartoMap.addTo(m);

		//map title
		var ctitle = L.control({position: 'topleft'});
		ctitle.onAdd = function () {
			var div = L.DomUtil.create('div', 'ctitle'),
			//this is for adding a logo as needed
			//holder ='<table><tr>' 
			//logo = '<td rowspan=2><img class="logo" src="logo_laos.png"></img></td>';
			//labels = "<td><h4>Poverty in Lao PDR</h4></td></tr><tr><td><p>Percentage of people in poverty by province/district: 2015</p></td></tr></table>";
			labelsn = "<h4>Dangue in Lao PDR</h4><p>";//<div class='input-field col s12'><input type='text' id='autocomplete-inputx' class='autocomplete'><label for='autocomplete-inpuxt'>Search for a district or province</label></div>";//<p>Percentage of people in poverty by province/district: 2015</p>";
			// var elemsx = document.querySelectorAll('#autocomplete-input');
			div.innerHTML = labelsn;//holder + logo + labels;

			// elemsx.forEach(function(element) {
			// 	div.appendChild(element);
			// });

			return div;
		};
		ctitle.addTo(m);

		var colors = ["#FF0000", "#FF7F00", "#FFFF00", "#00FF00", "#0000FF", "#4B0082", "#9400D3", 
              "#8B0000", "#FF4500", "#FFD700", "#ADFF2F", "#7CFC00", "#00CED1", "#1E90FF", 
              "#BA55D3", "#9370DB", "#3CB371", "#808080"];

			//   var testja= L.geoJson(features_p, {style: styleP}).addTo(m);
			//   var testjax=	L.geoJson(features_d.geojson, {style: styleD}).addTo(m);
        /////////////
		// var district_boundary = new L.geoJson();
		// // district_boundary.addTo(m);
		// var district_boundary2 = new L.geoJson(null, {
		// 	onEachFeature: popUpX,
		// 	style: styleP
		// });


			  async function initializeMap() {
				try {
					const province_layp = loadGeoData("data/features_pp.geojson.gz", popUpX, styleP,true,true);
					  const district_layp = loadGeoData("data/features_dp.geojson.gz", popUpX, styleD,false,true);

				  //const province_layp = loadGeoData("data/features_pp.zip", popUpX, styleP,true,true);
				//   const province_pointp = loadGeoData("data/province_point.zip", popUp, styleV,false,true);
				  //const district_layp = loadGeoData("data/features_dp.zip", popUpX, styleD,false,true);
				//   const district_pointp = loadGeoData("data/district_point.zip", popUp, styleV,false,true);
				//   const district_layp2 = loadGeoData("data/features_d.geojson", popUpX, styleD,false);
				//   const provinceLay3Promise = loadGeoJSON("data/features_r.geojson", popUpX, styleD,false );
			  
				  // Await all layers to be loaded
				//   const [province_lay, district_lay,province_lay2,district_lay2] = await Promise.all([
					// [province_lay, district_lay, province_point,district_point] = await Promise.all([
				  [province_lay, district_lay] = await Promise.all([
					province_layp,
					district_layp
					// ,
					// province_pointp,
					// district_pointp
				  ]);

				  
					/////////////////////////	/////////////////////////	/////////////////////////
				
					
					// combinedLayerP.addLayer(province_lay);
					
					// combinedLayerP.addLayer(province_point);
				
					// combinedLayerD.addTo(map);
				//testxxx.addTo(m);
				// m.addLayer(province_lay);
				//  province_point.addTo(m);
				  console.log('All GeoJSON layers have been loaded and added to the map.');
				  // You can now safely use `province_lay`, `province_lay2`, and `province_lay3` here
				//   combinedLayerP = L.layerGroup([province_point, province_lay]);
				//   combinedLayerP.addTo(m);

				//   // combinedLayerD.addLayer(district_lay);
				//   // combinedLayerD.addLayer(district_point);
				//   combinedLayerD = L.layerGroup([district_lay]);
				// //   combinedLayerD.addTo(m);

				} catch (error) {
				  console.error('Error loading one or more GeoJSON layers:', error);
				}
			  }
			  ///////////////
			//   async function initializeMap() {
			// 	try {
			// 	  // Create promises for each layer
			// 	  const province_layp = loadGeoZip("data/features_p.geojson", popUpX, styleP,true);
			// 	  const district_layp = loadGeoZip("data/features_d.geojson", popUpX, styleD,false);
			// 	//   const provinceLay3Promise = loadGeoJSON("data/features_r.geojson", popUpZ, styleR);
			  
			// 	  // Await all layers to be loaded
			// 	//   const [province_lay, district_lay] = await Promise.all([
			// 	  [province_lay, district_lay] = await Promise.all([
			// 		province_layp,
			// 		district_layp
			// 	  ]);
			  
			// 	  console.log('All GeoJSON layers have been loaded and added to the map.');
			// 	  // You can now safely use `province_lay`, `province_lay2`, and `province_lay3` here
			// 	} catch (error) {
			// 	  console.error('Error loading one or more GeoJSON layers:', error);
			// 	}
			//   }
		// var province_lay= new L.geoJson(null, {
		// 	onEachFeature: popUpX,
		// 	style: styleP
		// });
		// var district_lay= new L.geoJson(null, {
		// 	onEachFeature: popUpX,
		// 	style: styleP
		// });
		var combinedLayerP = L.layerGroup();
		var combinedLayerD = L.layerGroup();
		var province_lay;
		var district_lay; 	 
		var province_point;
		var district_point; 	 
		initializeMap();
		//////////////////////////
		// var district_lay = new L.GeoJSON.AJAX("data/district_pov.geojson",{onEachFeature:popUpX, style:styleD});
		// var province_lay = new L.GeoJSON.AJAX("data/province_pov.geojson",{onEachFeature:popUpX, style:styleP}).addTo(m);
		// var province_lay = new L.GeoJSON.AJAX("data/features_p.geojson",{onEachFeature:popUpX, style:styleP}).addTo(m);
		
		// //////////////////////////////////////
// 		var province_point = new L.GeoJSON.AJAX("data/province_point.geojson", {
//             pointToLayer: function (feature, latlng) {
//                 var total = 0;//counts[feature.properties.pcode] === 'undefined' ? 0 : counts[feature.properties.pcode]["total"];
//                 try {
//                   total = counts[feature.properties.pcode]["total"]; 
//                 } catch (error) {
//                 }
//                 // console.log("log", counts[feature.properties.pcode] === 'undefined' ? 0 : counts[feature.properties.pcode]["total"]);
//                 var marker = L.marker(latlng, {
//                     icon: L.divIcon({
//                       className: 'number-icon',
//                       html: '<div id=\'p' + feature.properties.pcode + '\' >'+ total + '</div>'
//                     })
//                   });
//               var circleMarker = L.circle(latlng, {
//                 radius: 0,
//                 fillColor: 'red',
//                 color: "red",
//                 weight: 6
//                 //opacity: 0.5,
//                 //fillOpacity: 0.5
//               });
// 		var circleMarker2 = L.circleMarker(latlng, {
// 		color: 'red',
// 		fillColor: 'red',
// 		weight: 6,
// 		radius: 0 // Radius in pixels, stays consistent
// 		});
//               var layerGroup = L.layerGroup([marker, circleMarker2]);
//             //   return(layerGroup);
// 		return(circleMarker2);
//             },
// 			    onEachFeature:popUp
// 			    ,style:styleV
//           });//.addTo(m);
// /////////////////////////////////////////

// 		// var district_lay = new L.GeoJSON.AJAX("data/features_d.geojson",{onEachFeature:popUpX, style:styleD});
		
// 		// var district_layx;
// 		// // var province_lay;

// 		// loadGeoZip("data/features_d.geojson.zip").then(geojsonData => {
// 		// 	 district_layx = new L.geoJSON(geojsonData,{onEachFeature:popUpX, style:styleD});
// 		// });
// 		// // loadGeoZip("data/features_p.zip").then(geojsonData => {
// 		// 	 province_lay = L.geoJSON(geojsonData,{onEachFeature:popUpX, style:styleP}).addTo(m);
// 		// });
// 		// var district_lay = new L.geoJSON(loadGeoZip("data/features_d.zip"),{onEachFeature:popUpX, style:styleD});

// 		// var province_lay = new L.geoJSON(loadGeoZip("data/features_p.zip"),{onEachFeature:popUpX, style:styleP}).addTo(m);

// 		////////////////////
// 		var district_point = new L.GeoJSON.AJAX("data/district_point.geojson", {
//             pointToLayer: function (feature, latlng) {
//                 let key1ForKey2 = [];
//                 for (let key1 of Object.keys(counts)) {
//                         if (counts[key1][feature.properties.dcode]) {
//                         key1ForKey2 = key1;
//                             break;
//                     }
//                 }
//                 var total = 0;
//                 try {
//                   total = counts[key1ForKey2][feature.properties.dcode]["total"]; 
//                 } catch (error) {
//                 }
//                  // counts[key1ForKey2][feature.properties.dcode] === 'undefined' ? 0 : counts[key1ForKey2][feature.properties.dcode]["total"]
//                 // counts[key1ForKey2][feature.properties.dcode]["total"]
//                 var marker = L.marker(latlng, {
//                     icon: L.divIcon({
//                       className: 'number-icon',
//                       html: '<div id=\'d' + feature.properties.dcode + '\' >'+ total + '</div>'
//                     })
//                   });
//               var circleMarker = L.circle(latlng, {
//                 radius: 0,
//                 fillColor: 'red',
//                 color: "red",
//                 weight: 6
//                 //opacity: 0.5,
//                 //fillOpacity: 0.5
//               });
//               var circleMarker2 = L.circleMarker(latlng, {
// 		color: 'red',
// 		fillColor: 'red',
// 		weight: 6,
// 		radius: 0 // Radius in pixels, stays consistent
// 		});
//               var layerGroup = L.layerGroup([marker, circleMarker2]);
//               return(layerGroup);
// 		//  return(circleMarker);
//             }
// 			,onEachFeature:popUp
// 			,style:styleV
//           });
//////////////////////////////////////
      //   },
      //   onEachFeature:popUp
      //   ,style:styleV
      // });
////////////////////
// var village_lay = new L.GeoJSON.AJAX("data/village.geojson", {
// 	pointToLayer: function (feature, latlng) {
// 	  var circleMarker = L.circle(latlng, {
// 		radius: 0,
// 		fillColor: 'red',
// 		color: "red",
// 		weight: 2
// 		//opacity: 0.5,
// 		//fillOpacity: 0.5
// 	  });
// 	  return(circleMarker);
// 	},
// 	onEachFeature:popUp//function (feature, layer) {
// 	//  var out = [];
// 	 // layer.bindPopup('Hi There');
// 	//   if (feature.properties) {
// 	// 	for (var key in feature.properties) {
// 	// 	  out.push(key + ": " + feature.properties[key]);
// 	// 	}
// 	// 	layer.bindPopup(out.join("<br />"), customOptions);
// 	//   }
// 	//}
// 	,style:styleV
//   });
 ////// 
 function containsPointType(geojson) {
    return geojson.features.some(feature => feature.geometry && feature.geometry.type === "Point");
}
function decompressGzip(gzipData) {
	try {
		// Convert binary data to Uint8Array
		const uint8Array = new Uint8Array(gzipData);
		// Decompress using pako
		const decompressedData = pako.ungzip(uint8Array, { to: 'string' });
		return decompressedData;
	} catch (error) {
		console.error('Error decompressing gzip data:', error);
		return null;
	}
}
  function loadGeoData(url, onEachFeature, style, addToMap = true,alayer = false) {
	return new Promise((resolve, reject) => {
	  const fileExtension = url.split('.').pop().toLowerCase();
	  const gzip = {
		loadAsync: function(input) {
		  return new Promise((resolve, reject) => {
			let data;
			if (input instanceof ArrayBuffer) {
			  data = new Uint8Array(input);
			} else if (input instanceof Blob) {
			  return input.arrayBuffer().then(arrayBuffer => {
				return this.loadAsync(arrayBuffer);
			  });
			} else {
			  reject(new Error('Input must be ArrayBuffer or Blob'));
			  return;
			}
	  
			try {
			  const inflated = pako.inflate(data, { to: 'string' });
			  resolve(inflated);
			} catch (error) {
			  reject(new Error('Failed to decompress gzip: ' + error.message));
			}
		  });
		}
	  };
	  if (fileExtension === 'gz') {
		const layerOptions = {
			onEachFeature: onEachFeature,
			style: style
		  };
		  var layer = new L.geoJson(null,layerOptions);

		  fetch(url)
		  .then(response => response.blob())  // or response.arrayBuffer()
		  .then(blob => gzip.loadAsync(blob))
		  .then(geoJSONString => {
		//   .then(async gzipData => {
			// try {
			// 	const decompressed = await new Promise((resolve, reject) => {
			// 	  pako.inflateRaw(new Uint8Array(gzipData), { to: 'string' }, (err, result) => {
			// 		if (err) reject(err);
			// 		else resolve(result);
			// 	  });
			// 	});
				
			// 	const jsonData = JSON.parse(decompressed);
			// 	console.log('Parsed JSON data:', jsonData);
			// 	// Now you can use jsonData as a variable containing the parsed JSON
			//   } catch (error) {
			// 	console.error('Decompression or parsing error:', error);
			//   }

			  
			//   const decompressed = decompressGzip(gzipData);
			//   console.log('Decompressed data:', decompressed);
			//   const geoJSONData = JSON.parse(decompressed)
			//   const jsonString = new TextDecoder().decode(decompressed);
   			const geoJSONData = JSON.parse(geoJSONString);
			// console.log('Parsed JSON data:', jsonData);

			if(alayer){
				layer.clearLayers();
				layer = L.geoJSON(geoJSONData, {
					pointToLayer: function (feature, latlng) {
						let key1ForKey2 = [];
						var source;
						if (feature.properties.DCode) {
						  for (let key1 of Object.keys(counts)) {
						  if (counts[key1][feature.properties.DCode]) {
						  key1ForKey2 = key1;
							break;
						}
						}
						source=key1ForKey2[feature.properties.DCode];
							}else{
						source=feature.properties.PCode;
						}
						var total = 0;
						try {
						  total = counts[source]["total"]; 
						} catch (error) {
						}
						  // console.log("log", counts[feature.properties.pcode] === 'undefined' ? 0 : counts[feature.properties.pcode]["total"]);
						  var marker = L.marker(latlng, {
							icon: L.divIcon({
							className: 'number-icon',
							html: '<div id=\'p' + feature.properties.PCode + '\' >'+ total + '</div>'
							})
						  });
					  var circleMarker2 = L.circleMarker(latlng, {
					  color: 'red',
					  fillColor: 'red',
					  weight: 6,
					  radius: 0 // Radius in pixels, stays consistent
					  });
						var layerGroup = L.layerGroup([marker, circleMarker2]);
					 return(layerGroup);
					}
					,
					onEachFeature: onEachFeature,
					style: style
				});
			}else{
	
				layer.addData(geoJSONData.features);
			}
	
	
	
				resolve(layer); // Resolve with the Leaflet layer
				if (addToMap) {
					layer.addTo(m); // Add the layer to the map if addToMap is true
				  }

		  })
		  .catch(error => console.error('Fetch error:', error));
		}
	  if (fileExtension === 'zip') {
		const layerOptions = {
			onEachFeature: onEachFeature,
			style: style
		  };
		//   if (alayer) {
		// 	layerOptions.pointToLayer= function (feature, latlng) {
		// 	var circleMarker2 = L.circleMarker(latlng, {
		// 	color: 'red',
		// 	fillColor: 'red',
		// 	weight: 6,
		// 	radius: 0 // Radius in pixels, stays consistent
		// 	});
		// 	//   var layerGroup = L.layerGroup([marker, circleMarker2]);
		// 	  //   return(layerGroup);
		// 	return(circleMarker2);
		// 	  };
		//   }
			
		  var layer = new L.geoJson(null,layerOptions);
		//   var layer = new L.geoJson(null, layerOptions);

		// var layer = new L.geoJson(null, {
		// 	onEachFeature: onEachFeature,
		// 	style: style
		// });
		// Handle ZIP file
		fetch(url)
		  .then(response => response.blob())
		  .then(blob => JSZip.loadAsync(blob))
		  .then(zip => zip.file(Object.keys(zip.files)[0]).async('string'))
		  .then(geoJSONString => {
			const geoJSONData = JSON.parse(geoJSONString);

			

			// district_boundary2.clearLayers();
			// district_boundary2.addData(geoJSONData.features);
			// district_boundary2.addTo(m);
			// if(alayer){
			// geoJSONData.features.forEach(feature => {
			// 	if (feature.geometry.type === "Point") {
			// 		const latlng = L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]);
			// 		let key1ForKey2 = [];
			// 		var source;
			// 		if (feature.properties.dcode) {
			// 		  for (let key1 of Object.keys(counts)) {
			// 		  if (counts[key1][feature.properties.dcode]) {
			// 		  key1ForKey2 = key1;
			// 			break;
			// 		}
			// 		}
			// 		source=key1ForKey2[feature.properties.dcode];
			// 			}else{
			// 		source=feature.properties.pcode;
			// 		}
			// 		var total = 0;
			// 		try {
			// 		  total = counts[source]["total"]; 
			// 		} catch (error) {
			// 		}
			// 		  // console.log("log", counts[feature.properties.pcode] === 'undefined' ? 0 : counts[feature.properties.pcode]["total"]);
			// 		  var marker = L.marker(latlng, {
			// 			icon: L.divIcon({
			// 			className: 'number-icon',
			// 			html: '<div id=\'p' + feature.properties.pcode + '\' >'+ total + '</div>'
			// 			})
			// 		  });
			// 	  var circleMarker2 = L.circleMarker(latlng, {
			// 	  color: 'red',
			// 	  fillColor: 'red',
			// 	  weight: 6,
			// 	  radius: 0 // Radius in pixels, stays consistent
			// 	  });
			// 		var layerGroup = L.layerGroup([marker, circleMarker2]);
			// 	 return(layerGroup);
			// 	// layerGroup.addTo(layer)
				  
			// 	// const marker = L.marker(latlng).bindPopup(feature.properties.code);
			// 	// marker.addTo(layer); // Add the marker to the existing layer
			// 	}
			//   });
			// }
			if(alayer){
			layer.clearLayers();
			layer = L.geoJSON(geoJSONData, {
				pointToLayer: function (feature, latlng) {
					let key1ForKey2 = [];
					var source;
					if (feature.properties.DCode) {
					  for (let key1 of Object.keys(counts)) {
					  if (counts[key1][feature.properties.DCode]) {
					  key1ForKey2 = key1;
						break;
					}
					}
					source=key1ForKey2[feature.properties.DCode];
						}else{
					source=feature.properties.PCode;
					}
					var total = 0;
					try {
					  total = counts[source]["total"]; 
					} catch (error) {
					}
					  // console.log("log", counts[feature.properties.pcode] === 'undefined' ? 0 : counts[feature.properties.pcode]["total"]);
					  var marker = L.marker(latlng, {
						icon: L.divIcon({
						className: 'number-icon',
						html: '<div id=\'p' + feature.properties.PCode + '\' >'+ total + '</div>'
						})
					  });
				  var circleMarker2 = L.circleMarker(latlng, {
				  color: 'red',
				  fillColor: 'red',
				  weight: 6,
				  radius: 0 // Radius in pixels, stays consistent
				  });
					var layerGroup = L.layerGroup([marker, circleMarker2]);
				 return(layerGroup);
				}
				,
				onEachFeature: onEachFeature,
				style: style
			});
		}else{

			layer.addData(geoJSONData.features);
		}



			resolve(layer); // Resolve with the Leaflet layer
			if (addToMap) {
				layer.addTo(m); // Add the layer to the map if addToMap is true
			  }
			  
		  })
		  .catch(reject);
	  } else if (fileExtension === 'geojson' || fileExtension === 'json') {
		// Handle GeoJSON file
		var layer = new L.GeoJSON.AJAX(url, {
		  onEachFeature: onEachFeature,
		  style: style
		});
  
		if (addToMap) {
		  layer.addTo(m); // Add the layer to the map if addToMap is true
		}
  
		layer.on('data:loaded', () => {
		  resolve(layer); // Resolve with the Leaflet layer
		});
  
		layer.on('error', (err) => {
		  reject(err);
		});
	  } else {
		reject(new Error('Unsupported file type'));
	  }
	});
  }
  
  
////////////////////

      // Scaling function
	  function scaleLayer(layer, map) {
		var zoom = map.getZoom();
		var scale = 1 / Math.pow(2, 20 - zoom);
		
		if (layer instanceof L.Circle) {
			layer.setRadius(500 * scale);
		} else if (layer instanceof L.Polygon) {
			layer.setStyle({ weight: 3 * scale });
		}
	}

	// Apply scaling on zoom

		function popUp(f,layer){
			var out = [];
			layer.on({
				mouseover: highlightFeature,
				mouseout: resetHighlight,
				click: onclick
			});	
			
			
		};

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
			if (f.properties.District) {
				var name = layer.feature.properties.District;
				 autocompleteData[name + ' District'] = layer;
            	//districtData[name] = layer;

				
                // out.push("Name: " + feature.properties.name); // Adjust based on your property name
                // layer.bindPopup(out.join("<br />"));
            }else{
		var name = layer.feature.properties.Province;
				 autocompleteData[name] = layer;		
	    }

		};


		// Creates an info box on the map
		var info = L.control({position: 'topright'});
		info.onAdd = function (map) {
			this._div = L.DomUtil.create('div', 'info nomobile');
			this.update();
			return this._div;
		};

		info.update = function (props) {
			
			content =  '<table class="props"><tbody>';
				
			content +=  (props ? '<div class="areaName">' + props.Province + checkNull2(props.District)+ '</div>' : '<div class="areaName">Lao PDR</div><div class="areaName faded"><small><i>Hover over areas to view data</i><br></small></div>');//'<th>'+ checkNull2(props.District)+'</th></tr>';
									//checkNull2(props.province_p) +"<br>"+  checkNull2(props.district_p) +  checkNull2(props.district_1) + 
			// content += '<tr><td class="ditem">Area [sq km]</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Area"].toFixed(0))) : '236,800') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Population</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Population"].toFixed(0))) : '6,492,228') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Density [per sq km]</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Density"].toFixed(1))) : '27') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Urban population (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Urban_popu"].toFixed(1))) : '32.9') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Improved sanitation (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Improved_S"].toFixed(1))) : '71.1') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Improved water source (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Improved_W"].toFixed(1))) : '83.9') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Electricity access (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Using_Elec"].toFixed(1))) : '85.6') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Own a phone (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Own_a_Phon"].toFixed(1))) : '91.3') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Poverty headcount (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Poverty_He"].toFixed(1))) : '24.8') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Poverty gap (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Poverty_Ga"].toFixed(1))) : '6.0') + '</div>'+ '</td></tr>';
			// content += '<tr><td class="ditem">Poverty severity (%)</td>         <td class="dval">'  +(props ? '' + (checkNull(props["Poverty_Se"].toFixed(1))) : '--') + '</div>'+ '</td></tr>';
			content += '</tbody></table>';
			
			this._div.innerHTML = content;
			};
			
		info.addTo(m);
		m.on('zoomend', function(){

			if (m.getZoom() >= 9) {
				// if (m.hasLayer(combinedLayerP)) {
				// 	// m.removeLayer(combinedLayerP);
				// 	combinedLayerP.remove();
				// }
				
				// combinedLayerD.addTo(m);
				// combinedLayerD.bringToFront();
				// if (m.hasLayer(province_point)) {
				// 	m.removeLayer(province_point);
				// 	// province_lay.bringToFront();
				// 	// province_point.bringToFront();
                //     console.log("The layer exists in the map");
                // } else {
                                      
                // // m.addLayer(province_lay);
                // // m.addLayer(province_point);
                // // province_point.bringToFront();
                //     console.log("The layer does not exist in the map");
                // }
			//  m.removeLayer(province_point);
				// province_point.hide();
				// province_point.setInteractive(true);
				m.removeLayer(province_lay);
			  m.addLayer(district_lay);
			  district_lay.bringToFront();

            //   //m.addLayer(district_point);
			//   district_point.addTo(m);
            //  district_point.bringToFront();
			 
			//  scaleLayer(district_lay, m);
			// scaleLayer(district_point, m);
			// m.addLayer(village_lay);
			// village_lay.bringToFront();
			  //set style for province as 
			  
			  
			} else {
				m.removeLayer(district_lay);
				m.addLayer(province_lay);
				province_lay.bringToFront();
				
				// if (m.hasLayer(combinedLayerD)) {
				// 	// m.removeLayer(combinedLayerD);
				// 	combinedLayerD.remove();
				// }
				// combinedLayerP.addTo(m);
				// combinedLayerP.bringToFront
				// if (m.hasLayer(district_point)) {
				// 	m.removeLayer(district_point);
				// }
			// 	if (m.hasLayer(province_point)) {
			// 		province_lay.bringToFront();
			// 		province_point.bringToFront();
            //         console.log("The layer exists in the map");
            //     } else {
                                      
            //    // m.addLayer(province_lay);
            //     m.addLayer(province_point);
            //     province_point.bringToFront();
            //         console.log("The layer does not exist in the map");
            //     }
			// 	if (m.hasLayer(district_lay)) {
			// 	m.removeLayer(district_lay);
			// 	m.removeLayer(district_point);
			// // }
			// 	// province_point.show();
			// 	//  province_point.addTo(m);
			// 	// province_point.setInteractive(false);
			// 	scaleLayer(province_lay, m);
			// 	scaleLayer(province_point, m);
                 // m.removeLayer(village_lay);
				//  m.addLayer(province_point);
				// province_point.bringToFront();
                // m.removeLayer(district_point);
			}


  });
		
		function onclick(e){
			var bounds = e.target.getBounds();
			m.fitBounds(bounds);
				
			
		};

		function highlightFeature(e) {
			resetHighlight(e);
			var layer = e.target;
			layer.setStyle({
				weight: 3,
				color: '#636363',
				fillOpacity: 0.4
			});
			info.update(layer.feature.properties);
		};

		// This resets the highlight after hover moves away
		function resetHighlight(e) {
			province_lay.setStyle(styleP);
			district_lay.setStyle(styleD);
			// village_lay.setStyle(styleV);
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



		// var cmap_poverty = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#990000'},
		// 				{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#d7301f'},
		// 				{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#ef6548'},
		// 				{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#fc8d59'},
		// 				{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#fdbb84'},
		// 				{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#fdd49e'},
		// 				{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#fee8c8'},
		// 				{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#fff7ec'}];

		// var cmap_density = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#7a0177'},
		// 				{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#ae017e'},
		// 				{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#dd3497'},
		// 				{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#f768a1'},
		// 				{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#fa9fb5'},
		// 				{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#fcc5c0'},
		// 				{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#fde0dd'},
		// 				{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#fff7f3'}];
						
		// var cmap_sanitation = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#005a32'},
		// 				{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#238443'},
		// 				{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#41ab5d'},
		// 				{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#78c679'},
		// 				{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#addd8e'},
		// 				{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#d9f0a3'},
		// 				{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#f7fcb9'},
		// 				{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#ffffe5'}];
						
		// var cmap_water = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#0c2c84'},
		// 				{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#225ea8'},
		// 				{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#1d91c0'},
		// 				{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#41b6c4'},
		// 				{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#7fcdbb'},
		// 				{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#c7e9b4'},
		// 				{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#edf8b1'},
		// 				{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#ffffd9'}];

		// var cmap_electricity = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#8c2d04'},
		// 				{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#cc4c02'},
		// 				{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#ec7014'},
		// 				{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#fe9929'},
		// 				{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#fec44f'},
		// 				{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#fee391'},
		// 				{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#fff7bc'},
		// 				{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#ffffe5'}];
						  
		// var cmap_tphone = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#6e016b'},
		// 				{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#88419d'},
		// 				{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#8c6bb1'},
		// 				{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#8c96c6'},
		// 				{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#9ebcda'},
		// 				{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#bfd3e6'},
		// 				{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#e0ecf4'},
		// 				{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#f7fcfd'}];
						  
		// var cmap_urban = [{"label" : ">&nbsp;87.0", "lower" : 87.0, "fill" : '#005824'},
		// 				{"label" : "75.0&nbsp;-&nbsp;87.0", "lower" : 75.0, "fill" : '#238b45'},
		// 				{"label" : "62.0&nbsp;-&nbsp;75.0", "lower" : 62.0, "fill" : '#41ae76'},
		// 				{"label" : "50.0&nbsp;-&nbsp;62.0", "lower" : 50.0, "fill" : '#66c2a4'},
		// 				{"label" : "37.0&nbsp;-&nbsp;50.0", "lower" : 37.0, "fill" : '#99d8c9'},
		// 				{"label" : "25.0&nbsp;-&nbsp;37.0", "lower" : 25.0, "fill" : '#ccece6'},
		// 				{"label" : "12.0&nbsp;-&nbsp;25.0", "lower" : 12.0, "fill" : '#e5f5f9'},
		// 				{"label" : "<&nbsp;12.0", "lower" : 0.0,  "fill" : '#f7fcfd'}];
		// function get_var(legX) {

		//   if (legX == "poverty")    return "Poverty_He";
		//   if (legX == "density")  return "Density";
		//   if (legX == "sanitation")     return "Improved_S";
		//   if (legX == "water") return "Improved_W";
		//   if (legX == "electricity") return "Using_Elec";
		//   if (legX == "tphone") return "Own_a_Phon";
		//   if (legX == "urban") return "Urban_popu";};
		// assign map coloring based on var
		// function repaint_map(fill_variable) {

		// 	province_lay.eachLayer(
		// 	  function (layer) {  
			  
		// 		switch(shading) {
		// 		  case "water": 
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  case "density":
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  case "sanitation":
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  case "tphone":
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  case "electricity":
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  case "urban":
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  default:
		// 			val = parseFloat(layer.feature.properties["Poverty_He"]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		}
		// 	  }
		// 	);
		// 	district_lay.eachLayer(
		// 	  function (layer) {  
			  
		// 		switch(shading) {
				  
		// 		  case "water": 
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  case "density":
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  case "sanitation":
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  case "tphone":
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  case "electricity":
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  case "urban":
		// 			val = parseFloat(layer.feature.properties[fill_variable]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		  default:
		// 			val = parseFloat(layer.feature.properties["Poverty_He"]);
		// 			layer.setStyle({fillColor: getColor(val)});
		// 			break;
		// 		}
		// 	  }
		// 	);
		// 	};	
			
		// //these enable manual class methods
		// function fileFilter(x)   { return x.file   == this; };
		// function methodFilter(x) { return x.method == this; };
		// function seedFilter(x)   { return x.seed   == this; };		

			
		// //coloring var	
		// var cmap = {"poverty" : cmap_poverty,
		// 			"density" : cmap_density,
		// 			"sanitation" : cmap_sanitation,
		// 			"electricity" : cmap_electricity,
		// 			"urban" : cmap_urban,
		// 			"tphone" : cmap_tphone,
		// 			"water" : cmap_water};

		// //default value and var for legend			
		// var shading = "poverty";
		 var variable = "PCode";	

		// //function to get colors based on coloring on cmap	
		// function getColor(d) {
		// 	for (var vi in cmap[shading]) {
		// 		if (d >= cmap[shading][vi].lower) {
		// 		return cmap[shading][vi].fill;
		// 		}
		// 	}
		// 	return '#BBB';
		// };

		//function for layer style based on coloring on cmap
		function styleD(feature) {
			val = parseFloat(feature.properties[variable]);
			return {
				weight: 1.2,
				opacity: 0.9,
				color: 'black',
				fillOpacity: 0.3,
				// fillColor: getColor(val)
				fillColor: colors[val]
			};
		};
		function style(feature) {
			val = parseFloat(feature.properties[variable]);
			return {
				weight: 1.2,
				opacity: 0.9,
				color: 'black',
				fillOpacity: 0.65,
				// fillColor: getColor(val)
				fillColor: colors[val]
			};
		};
		function styleP(feature) {
			val = parseFloat(feature.properties[variable]);
			return {
				weight: 3.5,
				opacity: 0.9,
				color: 'black',
				fillOpacity: 0.65,
				// fillColor: getColor(val)
				fillColor: colors[val]
			};
		};
		function styleV(feature) {
			//val = parseFloat(feature.properties[variable]);
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

		//legend design
		// var legend = L.control({position: 'bottomright'});

		// legend.onAdd = function () {
		// 	leg_select = '<select class="legend" id="shading_select">' + 
		// 					'<option value="density">Density</option>' + 
		// 					'<option value="poverty" selected=true>Poverty Rate (%)</option>' + 
		// 					'<option value="sanitation">Improved Sanitation (%)</option>' + 
		// 					'<option value="water">Improved Water Source (%)</option>' + 
		// 					'<option value="electricity">Electricity Access (%)</option>' + 
		// 					'<option value="tphone">Own a Phone (%)</option>' + 
		// 					'<option value="urban">Urban Population (%)</option>' + 
		// 				  '</select>';
			
		// 	var labels = [];

		// 	cmap[shading].forEach( function(v) {
		// 			labels.push('<tr>' + 
		// 				'<td class="cblock" style="background:' + v.fill + '"></td>' +
		// 				'<td class="ltext">' + v.label + '</td></tr>');
		// 		});
				
		// 	//draw legend based on selected var
		// 	var div = L.DomUtil.create('div', 'info legend');
		// 	div.innerHTML = leg_select  + '<table class= "legend_t" id="legend_table">' + labels.join('') + '</table>';

		// 	return div;
		// };
		// legend.addTo(m);

		// var shading_sel  = document.getElementById("shading_select");
		// var legend_table = document.getElementById("legend_table");
		// shading_sel.onchange = change_legend;

		// function change_legend() {
		// 	//get shading and variable from legend selector
		// 	shading = shading_sel.value;
		// 	variable = get_var(shading);
		// 	repaint_map(variable);

		// 	//retrieve the range for legends case by case, by equal count
		// 	if (shading == "sanitation") {
		// 		mini = 3, maxi = 0;
		// 		district_lay.eachLayer(function (layer) {
		// 			c = parseFloat(layer.feature.properties[variable])
		// 			if (mini > c) mini = c;
		// 			if (maxi < c) maxi = c;
		// 		});

		// 		step_size = (maxi - mini) / 8;
		// 		for (var s = 0; s < 8; s++) {
		// 			cmap_sanitation[7-s]["lower"] = mini + s * step_size;
		// 			cmap_sanitation[7-s]["label"] = (mini + s * step_size).toFixed(1) + "&nbsp;-&nbsp;" + (mini + (s+1) * step_size).toFixed(1);
		// 		}
		// 		cmap_sanitation[7]["lower"] = mini;
		// 	}
			
		// 	if (shading == "water") {
		// 		mini = 37, maxi = 0;
		// 		district_lay.eachLayer(function (layer) {
		// 			c = parseFloat(layer.feature.properties[variable])
		// 			if (mini > c) mini = c;
		// 			if (maxi < c) maxi = c;
		// 		});

		// 		step_size = (maxi - mini) / 8;
		// 		for (var s = 0; s < 8; s++) {
		// 			cmap_water[7-s]["lower"] = mini + s * step_size;
		// 			cmap_water[7-s]["label"] = (mini + s * step_size).toFixed(1) + "&nbsp;-&nbsp;" + (mini + (s+1) * step_size).toFixed(1);
		// 		}
		// 		cmap_water[7]["lower"] = mini;
		// 	}
			
		// 	if (shading == "tphone") {
		// 		mini = 54, maxi = 0;
		// 		district_lay.eachLayer(function (layer) {
		// 			c = parseFloat(layer.feature.properties[variable])
		// 			if (mini > c) mini = c;
		// 			if (maxi < c) maxi = c;
		// 		});

		// 		step_size = (maxi - mini) / 8;
		// 		for (var s = 0; s < 8; s++) {
		// 			cmap_tphone[7-s]["lower"] = mini + s * step_size;
		// 			cmap_tphone[7-s]["label"] = (mini + s * step_size).toFixed(1) + "&nbsp;-&nbsp;" + (mini + (s+1) * step_size).toFixed(1);
		// 		}
		// 		cmap_tphone[7]["lower"] = mini;
		// 	}
			
		// 	if (shading == "urban") {
		// 		mini = 4, maxi = 0;
		// 		district_lay.eachLayer(function (layer) {
		// 			c = parseFloat(layer.feature.properties[variable])
		// 			if (mini > c) mini = c;
		// 			if (maxi < c) maxi = c;
		// 		});

		// 		step_size = (maxi - mini) / 8;
		// 		for (var s = 0; s < 8; s++) {
		// 			cmap_urban[7-s]["lower"] = mini + s * step_size;
		// 			cmap_urban[7-s]["label"] = (mini + s * step_size).toFixed(1) + "&nbsp;-&nbsp;" + (mini + (s+1) * step_size).toFixed(1);
		// 		}
		// 		cmap_urban[7]["lower"] = mini;
		// 	}
			
		// 	if (shading == "electricity") {
		// 		mini = 24, maxi = 0;
		// 		district_lay.eachLayer(function (layer) {
		// 			c = parseFloat(layer.feature.properties[variable])
		// 			if (mini > c) mini = c;
		// 			if (maxi < c) maxi = c;
		// 		});

		// 		step_size = (maxi - mini) / 8;
		// 		for (var s = 0; s < 8; s++) {
		// 			cmap_electricity[7-s]["lower"] = mini + s * step_size;
		// 			cmap_electricity[7-s]["label"] = (mini + s * step_size).toFixed(1) + "&nbsp;-&nbsp;" + (mini + (s+1) * step_size).toFixed(1);
		// 		}
		// 	  cmap_electricity[7]["lower"] = mini;
		// 	}
			
		// 	var labels = [];
		// 	if (shading in cmap) {
		// 		cmap[shading].forEach( function(v) {
		// 			labels.push('<tr>' + 
		// 				'<td class="cblock" style="background:' + v.fill + '"></td>' +
		// 				'<td class="ltext">' + v.label + '</td></tr>');
		// 		  });
		// 	}
		// 	legend_table.innerHTML = labels.join('');
		// 	repaint_map(variable);
		// };
	if (isMobile) {
		document.getElementsByClassName("nomobile")[0].style.display = "none";
	};
