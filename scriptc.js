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

	// 	var Rbutton = L.easyButton('material-icons',function(btn,map){
			
	// 		button.children[0].innerText='assessment';
	// 		_states[0].icon='<i class="material-icons">assessment</i> View Report';
	// 		var modalElement = document.getElementById('reportModal');
	// 		var modalInstance = M.Modal.getInstance(modalElement);
	// 		// Open the modal
	// 		modalInstance.open();

	// 	  },'View Report', {
	// 	  position: 'bottomleft'
	//   }).addTo(m);

	  L.easyButton({
		position: 'bottomleft', // Position of the button
		states: [{
			stateName: 'view-report', // State name
			icon: '<i class="material-icons">assessment</i>', // Icon and text
			title: 'View Report', // Tooltip text
			onClick: function(btn, map) {
				// Open the modal
				var modalElement = document.getElementById('reportModal');
				var modalInstance = M.Modal.getInstance(modalElement);
				modalInstance.open();
			}
		}]
	}).addTo(m);

	//   L.easyButton({
	// 	position: 'topright', // Position of the button on the map
	// 	tagName: 'div', // Use a div to wrap the content
	// 	id: 'reportLink', // Set the ID for the button
	// 	states: [{
	// 		stateName: 'view-report', // State name
	// 		icon: '<i class="material-icons">assessment</i><br>View Report', // Icon and text
	// 		title: 'View Report', // Tooltip text
	// 		onClick: function(btn, map) {
	// 			// Trigger the modal when the button is clicked
	// 			$('#reportModal').modal('open'); // Assuming you're using Materialize CSS for the modal
	// 		}
	// 	}]
	// }).addTo(m); // Add the button to the map
		

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
		// var ctitle = L.control({position: 'topleft'});
		// ctitle.onAdd = function () {
		// 	var div = L.DomUtil.create('div', 'ctitle'),
		// 	//this is for adding a logo as needed
		// 	//holder ='<table><tr>' 
		// 	//logo = '<td rowspan=2><img class="logo" src="logo_laos.png"></img></td>';
		// 	//labels = "<td><h4>Poverty in Lao PDR</h4></td></tr><tr><td><p>Percentage of people in poverty by province/district: 2015</p></td></tr></table>";
		// 	labelsn = "<h4>Dangue in Lao PDR</h4><p>";//<div class='input-field col s12'><input type='text' id='autocomplete-inputx' class='autocomplete'><label for='autocomplete-inpuxt'>Search for a district or province</label></div>";//<p>Percentage of people in poverty by province/district: 2015</p>";
		// 	// var elemsx = document.querySelectorAll('#autocomplete-input');
		// 	div.innerHTML = labelsn;//holder + logo + labels;

		// 	// elemsx.forEach(function(element) {
		// 	// 	div.appendChild(element);
		// 	// });

		// 	return div;
		// };
		// ctitle.addTo(m);

		var colors = ["#FF0000", "#FF7F00", "#FFFF00", "#00FF00", "#0000FF", "#4B0082", "#9400D3", 
              "#8B0000", "#FF4500", "#FFD700", "#ADFF2F", "#7CFC00", "#00CED1", "#1E90FF", 
              "#BA55D3", "#9370DB", "#3CB371", "#808080"];

	


			  async function initializeMap() {
				try {

				//   const province_layp = loadGeoData("data/features_pp.zip", popUpX, styleP,true,true);
				// //   const province_pointp = loadGeoData("data/province_point.zip", popUp, styleV,false,true);
				//   const district_layp = loadGeoData("data/features_dp.zip", popUpX, styleD,false,true);
				//   const district_pointp = loadGeoData("data/district_point.zip", popUp, styleV,false,true);
				//   const district_layp2 = loadGeoData("data/features_d.geojson", popUpX, styleD,false);
				//   const provinceLay3Promise = loadGeoJSON("data/features_r.geojson", popUpX, styleD,false );
			  // https://raw.githubusercontent.com/djkhz/TerriaMap/main/data/features_dp.lzma
				const province_layp = loadGeoData("https://raw.githubusercontent.com/djkhz/TerriaMap/main/data/features_pp.lzma", popUpX, styleP,true,false);
				const district_layp = loadGeoData("https://raw.githubusercontent.com/djkhz/TerriaMap/main/data/features_dp.lzma", popUpX, styleD,false,false);
				// const province_layp = loadGeoData("data/features_pp.geojson.jgz", popUpX, styleP,true,false);
				// const district_layp = loadGeoData("data/features_dp.geojson.jgz", popUpX, styleD,false,false);
				
					// const district_layp = loadGeoData("data/features_dp.geojson.jgz", popUpX, styleD,false,false);
				  // Await all layers to be loaded
				//   const [province_lay, district_lay,province_lay2,district_lay2] = await Promise.all([
					// [province_lay, district_lay, province_point,district_point] = await Promise.all([
				  [province_lay, district_lay] = await Promise.all([
					province_layp,
					district_layp
					//  ,
					// province_pointp,
					// district_pointp
				  ]);

				  
					/////////////////////////	/////////////////////////	/////////////////////////
					
				  console.log('All GeoJSON layers have been loaded and added to the map.');
				 mapready= true;
				  // You can now safely use `province_lay`, `province_lay2`, and `province_lay3` here
				
				} catch (error) {
				  console.error('Error loading one or more GeoJSON layers:', error);
				}
			  }
			  ///////////////
			
		var mapready= false;
		// var combinedLayerP = L.layerGroup();
		// var combinedLayerD = L.layerGroup();
		var province_lay;
		var district_lay; 	 
		// var province_point;
		// var district_point; 	 
		initializeMap();
		//////////////////////////
		
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
	  var Gzip = {
		loadAsync: function(input) {
		  return new Promise(function(resolve, reject) {
			if (input instanceof Blob) {
			  var reader = new FileReader();
			  reader.onload = function() {
				try {
					// var uint8Array = new Uint8Array(reader.result);
					const compressed = pako.gzip(new Uint8Array(reader.result));
					// Decompress the data
					var decompressed = pako.inflate(compressed, { to: 'string' });
				//   var decompressed = pako.inflate(reader.result, { to: 'string' });
				  resolve(decompressed);
				} catch (error) {
				  reject(error);
				}
			  };
			  reader.onerror = function() {
				reject(reader.error);
			  };
			  reader.readAsArrayBuffer(input);
			} else if (input instanceof ArrayBuffer) {
			  try {

				// const arrayBuffer = await response.arrayBuffer();
                // const gunzip = new Zlib.Gunzip(new Uint8Array(input));
                // const decompressed = gunzip.decompress();
				// const compressedData = new Uint8Array(input);
				const compressed = pako.gzip(new Uint8Array(input));
                // const decompressedData = pako.inflate(compressedData);
                // const decompressedText = new TextDecoder().decode(decompressed);
				var decompressed = pako.inflate(compressed, { to: 'string' });
				resolve(decompressed);
			  } catch (error) {
				reject(error);
			  }
			} else {
			  reject(new Error("Unsupported input type. Expected Blob or ArrayBuffer."));
			}
		  });
		}
	  };

	  var LZ = {
            loadAsync: function(input) {
                return new Promise(function(resolve, reject) {
                    if (input instanceof Blob) {
                        var reader = new FileReader();
                        reader.onload = function() {
                            try {
                                // var uint8Array = new Uint8Array(reader.result);
                                // const byteArray = Array.from(uint8Array);
                                var decompressed=LZMA.decompress(new Uint8Array(reader.result));
                                resolve(decompressed);
                            } catch (error) {
                                reject(error);
                            }
                        };
                        reader.onerror = function() {
                            reject(reader.error);
                        };
                        reader.readAsArrayBuffer(input);
                    } else if (input instanceof ArrayBuffer) {
                        try {
                            var decompressed=LZMA.decompress(input);
                            resolve(decompressed);
                        } catch (error) {
                            reject(error);
                        }
                    } else {
                        reject(new Error("Unsupported input type. Expected Blob or ArrayBuffer."));
                    }
                });
            }
        };

	  if (fileExtension === 'lzma') {
            const layerOptions = {
                onEachFeature: onEachFeature,
                style: style
            };
            var layer = new L.geoJson(null, layerOptions);
	    var myLayerGroup = L.layerGroup();
            fetch(url)
            .then(response => response.blob()) // or response.arrayBuffer()
            .then(async blob => await LZ.loadAsync(blob))
            .then(geoJSONString => {
                var geoJSONData = JSON.parse(geoJSONString);
                

            layer.addData(geoJSONData.features);
			// 	const redDotIcon = L.divIcon({
			// 		html: '<div style="background-color: red; width: 100%; height: 100%; border-radius: 50%; border: 1px solid darkred;"></div>',
			// 		className: 'red-dot-icon',
			// 		iconSize: [10, 10],
			// 		iconAnchor: [5, 5]
			// 	});
			// var customDivIcon = L.divIcon({
			//     className: 'custom-icon',
			//     html: '1',
			//     iconSize: [30, 30],
			//     iconAnchor: [15, 30],
			//     popupAnchor: [0, -30]
			// });

                layer.eachLayer(function(layerItem) {
			     layerItem.eachLayer(function(subItem) {
				     // if (subItem instanceof L.Marker) {
				    if (subItem.options.alt==="Marker") {
                            var source;
							var hcode;
                            if (layerItem.feature.properties.DCode) {
					hcode='D' + layerItem.feature.properties.DCode;
                                for (let key1 of Object.keys(counts)) {
									if (counts[key1].hasOwnProperty(layerItem.feature.properties.DCode)){
										source = counts[key1][layerItem.feature.properties.DCode];
										hcode='D' + layerItem.feature.properties.DCode;
                                        break;
									}
                                }
                            } else {
								hcode='P' + layerItem.feature.properties.PCode;
                                source = counts[layerItem.feature.properties.PCode];
                            }
                            var total = 0;
                            try {
                                total = source["total"];
                            } catch (error) {
                            }
					const IconX = L.divIcon({
					className: 'number-icon',
					html: '<div style="background-color: red; width: 100%; height: 100%; border-radius: 50%; border: 1px solid darkred;"><div style="text-align: center;margin-top: 2pt;width: 100%; height: 100%;" id=\'' + hcode + '\' >' + total + '</div></div>',
					iconSize: [25, 25],
					iconAnchor: [5, 5]
					});
					// html: '<div style="background-color: red; width: 100%; height: 100%; border-radius: 50%; border: 1px solid darkred;"><div style="text-align: center;margin-top: 2pt;width: 100%; height: 100%;" id=\'p' + layerItem.feature.properties.PCode + '\' >' + total + '</div></div>',
					// subItem.iconId=hcode;
					subItem.setIcon(IconX);
					markerElements.push(subItem);
					markerById[hcode]=subItem;
					// subItem.setPopupContent("xx" || "Updated Point");
				     }
			});
        
                    });
                resolve(layer); // Resolve with the Leaflet layer
                if (addToMap) {
                    layer.addTo(m); // Add the layer to the map if addToMap is true
                }

            })
            .catch(error => console.error('Fetch error:', error));

        }
	 else if (fileExtension === 'gz' || fileExtension === 'jgz') {
		const layerOptions = {
			onEachFeature: onEachFeature,
			style: style
		  };
		  var layer = new L.geoJson(null,layerOptions);
	
		  fetch(url)
		  .then(response => response.blob())  // or response.arrayBuffer()
		  .then(async blob => await Gzip.loadAsync(blob))
		  .then(geoJSONString => {
			var geoJSONData = JSON.parse(geoJSONString); // Parse the decompressed string as JSON
	
				layer.addData(geoJSONData.features);

				layer.eachLayer(function(layerItem) {
						if (layerItem.feature.geometry.geometries[1].type === "Point") {
						var latlng = feature.geometry.geometries[1].coordinates;
						var lon = latlng[0];
						var lat = latlng[1];
						layerItem.setPopupContent("xx" || "Updated Point");
						}
							if (layerItem instanceof L.Marker) {
								const coords = layerItem.getLatLng();
								
										layerItem.setPopupContent("xx" || "Updated Point");
									
							}
						});

	
	
				resolve(layer); // Resolve with the Leaflet layer
				if (addToMap) {
					layer.addTo(m); // Add the layer to the map if addToMap is true
				  }

		  })
		  .catch(error => console.error('Fetch error:', error));
		// }
	 }
	  else if (fileExtension === 'zip') {
		const layerOptions = {
			onEachFeature: onEachFeature,
			style: style
		  };
		
			
		  var layer = new L.geoJson(null,layerOptions);
		
		// Handle ZIP file
		fetch(url)
		  .then(response => response.blob())
		  .then(blob => JSZip.loadAsync(blob))
		  .then(zip => zip.file(Object.keys(zip.files)[0]).async('string'))
		  .then(geoJSONString => {
			const geoJSONData = JSON.parse(geoJSONString);


			layer.addData(geoJSONData.features);

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
				var prov = layer.feature.properties.Province;
				 autocompleteData[name + ' District &lt;br&gt;' + prov] = layer;
            	//districtData[name] = layer;

				
                // out.push("Name: " + feature.properties.name); // Adjust based on your property name
                // layer.bindPopup(out.join("<br />"));
            }else{
		var name = layer.feature.properties.Province;
				 autocompleteData[name] = layer;		
	    }

		};

		// var breport = L.control({position: 'topright'});
		// breport.onAdd = function () {
		// 	var div = L.DomUtil.create('div', 'info');
		// 	div.style.width = '100px';
		// 	div.style.textAlign = 'center';
		// 	div.style.padding = '10px';
		// 	//this is for adding a logo as needed
		// 	//holder ='<table><tr>' 
		// 	//logo = '<td rowspan=2><img class="logo" src="logo_laos.png"></img></td>';
		// 	//labels = "<td><h4>Poverty in Lao PDR</h4></td></tr><tr><td><p>Percentage of people in poverty by province/district: 2015</p></td></tr></table>";
		// 	labelsn = "<h4>Dangue in Lao PDR</h4><p>";//<div class='input-field col s12'><input type='text' id='autocomplete-inputx' class='autocomplete'><label for='autocomplete-inpuxt'>Search for a district or province</label></div>";//<p>Percentage of people in poverty by province/district: 2015</p>";
		// 	// var elemsx = document.querySelectorAll('#autocomplete-input');
		// 	btnr = '<a href="#" class="modal-trigger" data-target="reportModal" id="reportLink"><i class="material-icons">assessment</i><br>View Report</a>';
		// 	div.innerHTML = btnr;//holder + logo + labels;

		// 	// elemsx.forEach(function(element) {
		// 	// 	div.appendChild(element);
		// 	// });

		// 	return div;
		// };
		// breport.addTo(m);

		// Creates an info box on the map
		var info = L.control({position: 'bottomright'});
		info.onAdd = function (map) {
			// this._div = L.DomUtil.create('div', 'info nomobile');
			this._div = L.DomUtil.create('div', 'info');
			this.update();
			return this._div;
		};

		info.update = function (props) {
			
			content =  '<table class="props"><tbody>';
			// content +=	'<div class="areaName">Dengue in Lao PDR</div><div class="areaName faded"><small><i>Hover over areas to view data</i><br></small></div>';
			content +=  (props ? '<div class="areaName">Dengue in Lao PDR</div>' : '<div class="areaName">Dengue in Lao PDR</div><div class="areaName faded"><small><i>Hover over areas to view data</i><br></small></div>');
			// content +=  (props ? '<div class="areaName">' + props.Province + checkNull2(props.District)+ '</div>' : '<div class="areaName">Dengue in Lao PDR</div><div class="areaName faded"><small><i>Hover over areas to view data</i><br></small></div>');//'<th>'+ checkNull2(props.District)+'</th></tr>';
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
			content +=  (props ? '<tr><td class="ditem">'+ props.Province +'</td>         <td class="dval">' + (checkNull2(counts[props["PCode"]]) ? counts[props["PCode"]].total : '--' ) + '</div>'+ '</td></tr>' : '<tr><td class="ditem">Total Casess</td>         <td class="dval">'  + counts.total + '</div>'+ '</td></tr>');
			content +=  (props ? '<tr><td class="ditem">'+ checkNull2(props.District) +'</td>         <td class="dval">' + ((props.PCode in counts) ? checkNull2(counts[props.PCode][props.DCode]) ? counts[props.PCode][props.DCode].total : '--' : '--') + '</div>'+ '</td></tr>' : ' ');
			// content +=  (props ? '<tr><td class="ditem">Province Cases</td>         <td class="dval">' + (checkNull2(counts[props["PCode"]]) ? counts[props["PCode"]].total : '--' ) + '</div>'+ '</td></tr>' : '<tr><td class="ditem">Total Casess</td>         <td class="dval">'  + counts.total + '</div>'+ '</td></tr>');
			// content +=  (props ? '<tr><td class="ditem">District Cases</td>         <td class="dval">' + ((props.PCode in counts) ? checkNull2(counts[props.PCode][props.DCode]) ? counts[props.PCode][props.DCode].total : '--' : '--') + '</div>'+ '</td></tr>' : ' ');
			
			content += '</tbody></table>';
			
			this._div.innerHTML = content;
			};
			
		info.addTo(m);

//create control box//////////
// Define a custom control
// Create a custom control container
////////////////////////////
////////////////////////////
// const customControlDiv = L.DomUtil.create('div', 'custom-control');

// // Add a Materialize date picker input to the custom control
// customControlDiv.innerHTML = `
//  <div class="row">
//                     <div class="col s12">
//                         <div class="input-field col s12 ctitle" style="z-index: 500;margin-bottom: -1px;">
//                         <label style="position: relative;" for="autocomplete-input">Search for a district or province</label>
//                             <input type="text" id="autocomplete-input" class="autocomplete">
//                         </div>
// 			  <div class="input-field col s12 ctitle" style="z-index: 500;margin-bottom: -100px;">
// 			<label style="position: relative;" for="date-range">Start and End Date</label>
//                         <input type="text" id="date-range" placeholder="Choose Date Range">
//                         </div>
//                     </div>
//                 </div>
// `;

// // Initialize the Materialize date picker
// document.addEventListener('DOMContentLoaded', function () {
// // Initialize main autocomplete
// 		    var elemsstatus = document.querySelectorAll('#statusDropdown');
//     			var instances = M.FormSelect.init(elemsstatus);
		    
//                     var elems = document.querySelectorAll('#autocomplete-input');
//                     var instances = M.Autocomplete.init(elems, {
//                         data: autocompleteData,
//                         limit: 10,
//                         minLength: 1,
//                         onAutocomplete: function(text) {
//                             console.log("Selected location:", text);
// 				//var newStr = text.replace(/\s(?=[^ ]*$)/, "&lt;br&gt;");
// 				var newStr = text.replace("District ", "District &lt;br&gt;");
                
// 				//console.log(newStr);
// 				var layer = autocompleteData[newStr];
// 				if (layer) {
// 					m.fitBounds(layer.getBounds());
// 					// highlightFeature({ target: layer });
//                     province_lay.setStyle(styleP);
// 			        district_lay.setStyle(styleD);

// 					layer.setStyle({
// 				    weight: 3,
// 				    color: '#636363',
// 				    fillOpacity: 0.4
// 			        });
// 			        info.update(layer.feature.properties);
// 				}
//                         }
//                     });
	
// ////////////date time////////////
// 			const dateRangeInput = document.getElementById('date-range');
//       let startDate = null;

//       // Event listener to handle date range selection
//       dateRangeInput.addEventListener('focus', function () {

// 	       // Show indicator for Start Date selection
//         // indicator.textContent = 'Selecting Start Date...';

//         // Initialize Start Date Picker
// 	let startDateSelected = false; // Flag to track if the start date was selected
// 	let endDateSelected = false; // Flag to track if the start date was selected
//         const startPicker = M.Datepicker.init(dateRangeInput, {
//           format: 'yyyy-mm-dd',
//           autoClose: true,
// 	  maxDate: new Date(),
// 	  onOpen: function () {
// 	          // Find the modal and insert a custom title
// 	          const modal = document.querySelector('.datepicker-modal');
// 	          if (modal && !modal.querySelector('.datepicker-title')) {
// 	            const title = document.createElement('div');
// 	            title.className = 'datepicker-title';
// 	            title.textContent = 'Selecting Start Date...'; // Set your custom title here
// 	            modal.prepend(title);
// 	          }
//           },
// 	  onSelect: function (selectedDate) {
// 	          startDateSelected = true; // Mark start date as selected
// 	          // endPicker.options.minDate = selectedDate; // Set minDate for the end date picker
// 	        	},
//           onClose: function () {
// 		  if (startDateSelected) {
//             // If a start date is selected, open the end date picker
//             //endPicker.open();
          
//             startDate = new Date(dateRangeInput.value); // Save the selected start date
//             const startYear = startDate.getFullYear();
// 	   const endOfYearDate = new Date(startDate.getFullYear(), 11, 31);
		  
// 	 // Update indicator for End Date selection
//             // indicator.textContent = 'Selecting End Date...';

//             // Initialize End Date Picker after Start Date is selected
//             M.Datepicker.init(dateRangeInput, {
//               format: 'yyyy-mm-dd',
//               autoClose: true,
//               minDate: startDate,
// 	      maxDate: endOfYearDate,
//               // yearRange: [startYear, startYear],
// 	      onOpen: function () {
// 	          // Find the modal and insert a custom title
// 	          const modal = document.querySelector('.datepicker-modal');
// 	          if (modal && !modal.querySelector('.datepicker-title')) {
// 	            const title = document.createElement('div');
// 	            title.className = 'datepicker-title';
// 	            title.textContent = 'Selecting End Date...'; // Set your custom title here
// 	            modal.prepend(title);
// 	          }
//           	},
// 	      onSelect: function (selectedDate) {
// 		 endDateSelected =true;
// 	      },
//               onClose: function () {
// 		if (endDateSelected) {
//                 const endDate = new Date(dateRangeInput.value); // Save the selected end date

//                 // Combine the dates into a range
//                 if (startDate && endDate) {
//                   dateRangeInput.value = `${startDate.toISOString().split('T')[0]} to ${endDate.toISOString().split('T')[0]}`;
// 		resetRealDB(allData,startDate.toISOString().split('T')[0],endDate.toISOString().split('T')[0]);
// 		startDateSelected = false;
// 		endDateSelected =false;
// 		  // indicator.textContent = ''; // Clear the indicator after selection
             
//                 }
// 	      }else
// 		{
// 		dateRangeInput.value ="";
// 		startDateSelected = false;
// 		endDateSelected =false;
// 		}
//               }
//             }).open();
		
// 		  }
//           startDateSelected = false;
//           }
		
//         });
//         startPicker.open();
//       });
// 	 // Initialize Date Picker for Start Date
	
// });

// // Append the custom control to the Leaflet control container
// const controlContainer = document.querySelector('.leaflet-control-container');
// controlContainer.appendChild(customControlDiv);
// ////////////////////////////
// ////////////////////////////
// ////////////////////////////
// const controlinfo = L.control({ position: 'topright' });

//     // Initialize the control's DOM
//     controlinfo.onAdd = function (map) {
//       // Create a container div for the control
//       this._div = L.DomUtil.create('div', 'info');

//       // Add a Materialize date picker to the control
//       this._div.innerHTML = `
//         <h4>Date Picker</h4>
//         <div class="datepicker-wrapper">
//           <input type="text" id="start-date" class="datepicker" placeholder="Start Date">
//           <input type="text" id="end-date" class="datepicker" placeholder="End Date">
//         </div>
//       `;

//       // Return the div to be added to the map
//       return this._div;
//     };

//     // Add the info control to the map
//     controlinfo.addTo(m);

//     // Initialize the Materialize date pickers
//     document.addEventListener('DOMContentLoaded', function () {
//       const datePickers = document.querySelectorAll('.datepicker');
//       M.Datepicker.init(datePickers, {
//         format: 'yyyy-mm-dd',
//         onClose: function () {
//           console.log('Date Picker Closed!');
//         }
//       });
//     });
///////////////

// Get the map's control container
// const controlContainer = document.querySelector('.leaflet-control-container');

// // Get individual control sections
// const topLeft = controlContainer.querySelector('.leaflet-top.leaflet-left');
// const topRight = controlContainer.querySelector('.leaflet-top.leaflet-right');
// const bottomLeft = controlContainer.querySelector('.leaflet-bottom.leaflet-left');
// const bottomRight = controlContainer.querySelector('.leaflet-bottom.leaflet-right');

// // Create an array of sections in the desired new order
// const newOrder = [bottomLeft, bottomRight, topLeft, topRight];

// // Append the sections in the new order
// newOrder.forEach(section => {
//   controlContainer.appendChild(section);
// });
// const controlContainer = document.querySelector('.leaflet-control-container');
// const customControlx = document.querySelector('.mapcontol.row'); // Assume it's your div control
// controlContainer.appendChild(customControlx); 


		m.on('zoomend', function(){

			if (m.getZoom() >= 9) {
				
				if (mapready) {
				m.removeLayer(province_lay);
			  m.addLayer(district_lay);
			  district_lay.bringToFront();
				}
           
			  
			} else {
				if (mapready) {
				m.removeLayer(district_lay);
				m.addLayer(province_lay);
				province_lay.bringToFront();
				}
				
			
			}


  });
		
		function onclick(e){
			if(!mapready) return;
			var bounds = e.target.getBounds();
			m.fitBounds(bounds);
				
			
		};

		function highlightFeature(e) {
			if(!mapready) return;
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
			if(!mapready) return;
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
			// return ", " + comma(val);
			return comma(val) + " District";
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
