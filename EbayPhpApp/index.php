<!DOCTYPE html> 

<html>
	<head>
		<!--link rel="stylesheet" type="text/css" href="assignment6.css"-->
		<style>
		#ProductSearchDiv {
			height: 295px;
			width: 600px;
			border: 1px solid black; 
			margin: 0 auto; 
			padding: 20px 20px 10px 20px
		}

		#productSearchTitle {
			font-family: sans-serif;
			font-style: italic;
			font-size: 30;
			margin: 0;
		}

		.tooltiptextHide {
		  visibility: hidden;
		}
			
		tooltiptext:after {
		  visibility: visible;
		  border: 1px solid black;
		  width: 200px;
		  height: 0; 
		  border-left: 5px solid transparent;
		  border-right: 5px solid transparent;
		  border-bottom: 5px solid transparent;

		  color: black;
		  text-align: center;
		  padding: 5px 0;
		  border-radius: 6px;
		  margin: 60px;
		 
		  /* Position the tooltip text - see examples below! */
		  position: relative;
		  z-index: 1px;
		}
			
		.arrow_box {
		  position: relative;
		  background: white;
		  border: 1px solid black;
		  padding: 5px;
		  margin-left: 60px;
		}

		.arrow_box:after, .arrow_box:before {
		  bottom: 100%;
		  left: 50%;
		  border: solid transparent;
		  content: " ";
		  height: 0;
		  width: 0;
		  position: absolute;
		  pointer-events: none;
		}

		.arrow_box:after {
		/* 		border-color: rgba(136, 183, 213, 0); */
		  border-bottom-color: black;	
		  border-width: 10px;
		  margin-left: -82px;
		}

		.arrow_box:before {
		  border-color: rgba(194, 225, 245, 0);
		  border-bottom-color: black;
		  border-width: 1px;
		  margin-left: -1px;
		}
			
		input:disabled {
		  border: 0px;
		}
			
		.miles {
		  width: 50px;
		}

		#searchResultTable {
			width: 90%;
		}

		#itemDetailsTable {
			width: 50%;
		}

		table, th, td{
			border-collapse: collapse;
			border: 1px solid black; 
		}

		[id*="PName_"]:hover {
			color: grey;
		}

	</style>
		
		
		<script type="text/javascript">			
			
			function getGeoLocation() {
			//console.log("in geoloation");
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				}
				xmlhttp.open("GET", "http://ip-api.com/json", false);
				xmlhttp.send();
				if (xmlhttp.status != 404) {
					jsonObj= JSON.parse(xmlhttp.responseText);
					document.getElementById("Search").disabled = false;
				}
				//console.log(jsonObj);
				var root = jsonObj;
				var latitude = root.lat;
				var longitude = root.lon;
				var zipCodeApi = root.zip;
				//console.log(latitude);
				//console.log(longitude);
				//console.log(zipCodeApi);
				document.getElementById("userLocation").value = zipCodeApi;
			}	

			function distanceForm(){
				var eleIsChecked = document.getElementById("NearbySearch").checked;
				if (eleIsChecked) {
					var nodes = document.getElementById("distanceForm").getElementsByTagName('*');
					for (var i = 0; i < nodes.length; i++){
						nodes[i].disabled = false;
						enableDisableZipcode();
					}
				} else {
					resetDistanceForm();
				}
			}
		
			function hideToolTips() {
				hideKeywordToolTip();
				hideZipcodeToolTip();
			}

			function hideKeywordToolTip() {
				document.getElementById("keywordErrorMsg").classList.add("tooltiptextHide");
			}

			function hideZipcodeToolTip() {
				document.getElementById("zipCodeErrorMsg").classList.add("tooltiptextHide");
			}
			
			function clearPsForm() {
				//console.log("In clearPs function");
				document.getElementById("ProductSearchForm").reset();
				document.getElementById("productKeyword").value = "";
				document.getElementById("categoryId").value = "AllCategories";
				if(document.getElementById("NewCheck").checked == true){
					document.getElementById("NewCheck").checked = false;
				}
				if(document.getElementById("UsedCheck").checked == true){
					document.getElementById("UsedCheck").checked = false;
				}
				if(document.getElementById("UnspecifiedCheck").checked == true){
					document.getElementById("UnspecifiedCheck").checked = false;
				}
				if(document.getElementById("LocalPickUpCheck").checked == true){
					document.getElementById("LocalPickUpCheck").checked = false;
				}
				if(document.getElementById("FreeShippingCheck").checked == true){
					document.getElementById("FreeShippingCheck").checked = false;
				}
				resetDistanceForm();
				if(document.getElementById("productResults") != null){
					document.getElementById("productResults").remove();
				}
				
				
			}

			function onProductNameClick() {
				parent.resultTables.location.href="itemDetails.html";
			}

			function changeLinkColor(id) {
				document.getElementById("PName_"+id).classList.add(greyLink);
			}

			function showItemDetails() {
				parent.resultTables.location.href = "itemDetails.html";
			}
			
			function resetDistanceForm() {
				if(document.getElementById("NearbySearch").checked == true){
					document.getElementById("NearbySearch").checked = false;
				}
				/*var nodes = document.getElementById("distanceForm").getElementsByTagName('*');
				
				for(var i = 0; i < nodes.length; i++){
					if(i == 0){
						nodes[i]
					}
					nodes[i].value = "";
					nodes[i].disabled = true;
				}*/
				if(document.getElementById("milesFrom") != ""){
					document.getElementById("milesFrom").value = "";
				}
				document.getElementById("currentLocation").checked = true;
				document.getElementById("zipCodeLocation").checked = false;					
				document.getElementById("zipCodeLocation").disabled = true;
				document.getElementById("currentLocation").disabled = true;
				if(document.getElementById("zipCode") != ""){
					document.getElementById("zipCode").value = true;
					document.getElementById("zipCode").disabled= true;
				if(document.getElementById("milesFrom").value != ""){
					document.getElementById("milesFrom").value == "";
					document.getElementById("milesFrom").disabled = true;
					}
				}
			}
		
			function enableDisableZipcode() {
				if (document.getElementById("currentLocation").checked) {
					document.getElementById("zipCode").disabled = true;
				} else {
					document.getElementById("zipCode").disabled = false;
				}
			}
			
			function searchProduct()  {
				//console.log("hereeeeeeee");
				//console.log("Entered searchProduct");
				document.getElementById("flag").value = true;
				document.getElementById("ProductSearchForm").submit();
			}
			
		
		</script>
	</head>
	<body onload = "getGeoLocation()">
		<br>
		<div id="ProductSearchDiv">
			<form id = "ProductSearchForm" action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post" >
				<center><b><p id="productSearchTitle"><font face = "Serif" size = "6">Product Search</font></p></b></center>
				<hr>
				<b>Keyword&nbsp;</b><input type = "text" name = "Keyword" id= "productKeyword"\
					value="<?php echo isset($_POST['Keyword']) ? $_POST['Keyword'] : ''?>" required><br>
				<span id="keywordErrorMsg" class="tooltiptextHide"> Please fill out this field.</span><br/>
	
				<b>Category</b>
				<select id = "categoryId" name = "category">
					<option value = "AllCategories" <?php if (isset($_POST['category']) && ($_POST['category'] == "AllCategories")){ echo 'selected';}?>>All Categories</option>
					<option value = "550" <?php if (isset($_POST['category']) && ($_POST['category'] == "550")) {echo 'selected';}?>>Art</option>
					<option value = "2984" <?php if (isset($_POST['category']) && ($_POST['category'] == "2984")) {echo 'selected';}?>>Baby</option>
					<option value = "267" <?php if (isset($_POST['category']) && ($_POST['category'] == "267")) {echo 'selected';}?>>Books</option>
					<option value = "11450" <?php if (isset($_POST['category']) && ($_POST['category'] == "11450")) {echo 'selected';}?>>Clothing, Shoes and Accessories</option>
					<option value = "58058" <?php if (isset($_POST['category']) && ($_POST['category'] == "58058")) {echo 'selected';}?>>Computers/Tablets and Networking</option>
					<option value = "26395" <?php if (isset($_POST['category']) && ($_POST['category'] == "26395")) {echo 'selected';}?>>Health and Beauty</option>
					<option value = "11233" <?php if (isset($_POST['category']) && ($_POST['category'] == "11233")) {echo 'selected';}?>>Music</option>
					<option value = "1249" <?php if (isset($_POST['category']) && ($_POST['category'] == "1249")) {echo 'selected';}?>>Video Games and Consoles</option>
				</select>
				<br><br>

				<b>Condition</b>
				<input type = "checkbox" id = "NewCheck" name = "Condition[]" value = "New" <?php if (isset($_POST['Condition']) && (in_array("New", $_POST['Condition']))) {echo 'checked';}?>>New &nbsp; &nbsp; &nbsp;
				<input type = "checkbox" id = "UsedCheck" name = "Condition[]" value = "Used" <?php if (isset($_POST['Condition']) && (in_array("Used", $_POST['Condition']))) {echo 'checked';}?>>Used &nbsp; &nbsp; &nbsp;
				<input type = "checkbox" id = "UnspecifiedCheck" name = "Condition[]" value = "Unspecified" <?php if (isset($_POST['Condition']) && (in_array("Unspecified", $_POST['Condition']))) {echo 'checked';}?>>Unspecified
				<br><br>

				<b>Shipping Options</b> &nbsp; &nbsp; &nbsp;
				<input type = "checkbox" id = "LocalPickUpCheck" name = "LocalPickupOnly" value = "LocalPickupOnly" <?php if (isset($_POST['LocalPickupOnly'])) {echo 'checked';}?>>Local Pickup &nbsp; &nbsp; &nbsp;
				<input type = "checkbox" id = "FreeShippingCheck" name = "FreeShippingOnly" value = "FreeShippingOnly" <?php if (isset($_POST['FreeShippingOnly'])) {echo 'checked';}?>>Free Shipping
				<br><br>
		
				<input type = "checkbox" id = "NearbySearch" name = "NearbySearch" value = "Enable Nearby Search"  \
					<?php if (isset($_POST['NearbySearch'])) echo 'checked';?> onchange = "distanceForm()">
				<b>Enable Nearby Search</b> &nbsp;
				<span name = "distanceForm" id = "distanceForm" disabled>
					<input type = "text" id = "milesFrom" name = "milesFrom" placeholder = "10" class="miles" \
						<?php if (isset($_POST['milesFrom']))  {echo 'value="'.$_POST['milesFrom'].'"' ;} else { echo 'disabled';}?>> <b>miles from</b>
					<input type = "radio" name = "distance" id="currentLocation" value="currentLocation" onchange="enableDisableZipcode()" \
					   <?php if (isset($_POST['distance']) && ($_POST['distance']) == "currentLocation")  {echo 'checked' ;} else { if (!isset($_POST['NearbySearch'])) {echo 'checked disabled';}}?>>Here<br>
					<input type = "radio" name = "distance" id="zipCodeLocation" value="zipCodeLocation" onchange="enableDisableZipcode()" style = "margin-left: 332px" \
						<?php if (isset($_POST['distance']) && ($_POST['distance']) == "zipCodeLocation")  {echo 'checked' ;} else { if (isset($_POST['NearbySearch'])) {} else { echo 'disabled';}}?>>
					<input type = "text" id = "zipCode" name = "zipCode" placeholder = "zip code" class="zipCode" required \
						<?php if (isset($_POST['zipCode']))  { echo 'value="'.$_POST['zipCode'].'"' ;} else { echo 'disabled';}	?>>
					<span id="zipCodeErrorMsg" class="tooltiptextHide"> Please fill out this field.</span><br/>	
				</span>
				
				<center>
					<input type = "submit" name = "Submit" id = "Search" value = "Search" onsubmit= "searchProduct()" disabled>
					<!--input type = "button" id = "Clear" value = "Clear" onclick = "clearPsForm()"-->
					<input type = "button" id = "Clear" value = "Clear" onclick = "clearPsForm()">
				</center>
				
				<input type="hidden" id="userLocation" name="userLocation" />
				<input type="hidden" id="flag" name="Flag" />
			</form>
		</div>
		
		<br/><br/><div id = "inValidZip"></div>
		<div id = "productResults">
			<script>
			function resizeMyIframe() {
console.log("resizeMyIframe function");

				setTimeout(function(){
				console.log("resizeMyIframe function");
							document.getElementById("iFrameId").style.height = "0px";
            document.getElementById("iFrameId").style.height =
                (document.getElementById("iFrameId").contentWindow.document.documentElement.scrollHeight)+"px";
                });
				/*var obj = document.getElementById("SellerIframe");
				var commonPath = obj.contentDocument || obj.contentWindow.document;
				//console.log(commonPath.body.scrollHeight);
				obj.style.height = commonPath.body.scrollHeight + 'px';
				//console.log(obj.style.height);*/
			}
			function changeFirstImage(){
				if(document.getElementById("firstImage").src == "http://csci571.com/hw/hw6/images/arrow_down.png"){
					document.getElementById("firstImage").src = "http://csci571.com/hw/hw6/images/arrow_up.png";
				}
				else if(document.getElementById("firstImage").src == "http://csci571.com/hw/hw6/images/arrow_up.png"){
					document.getElementById("firstImage").src = "http://csci571.com/hw/hw6/images/arrow_down.png";
				}
				if(document.getElementById("secondImage").src == "http://csci571.com/hw/hw6/images/arrow_up.png"){
					document.getElementById("secondImage").src = "http://csci571.com/hw/hw6/images/arrow_down.png";
				}
			}
			
			function changeSecondImage(){
				if(document.getElementById("secondImage").src == "http://csci571.com/hw/hw6/images/arrow_down.png"){
					document.getElementById("secondImage").src = "http://csci571.com/hw/hw6/images/arrow_up.png";
				}
				else if (document.getElementById("secondImage").src == "http://csci571.com/hw/hw6/images/arrow_up.png"){
					document.getElementById("secondImage").src = "http://csci571.com/hw/hw6/images/arrow_down.png";
				}
				if(document.getElementById("firstImage") != null && document.getElementById("firstImage").src == "http://csci571.com/hw/hw6/images/arrow_up.png"){
					document.getElementById("firstImage").src = "http://csci571.com/hw/hw6/images/arrow_down.png";
				}
			}
			
			function setRetainedValue() {
				
				var urlString = window.location.search.substr(1);
				if(urlString.indexOf('&') == -1){
					return null;
				}
				var newValues = urlString.split("&");
				//console.log(newValues);
				for (var i = 1; i < newValues.length; i++) {
					
					var val = newValues[i].split("=");
					//console.log("Evaluating="+ val);
					//console.log(val[0]);
					//console.log(val[1]);
					
					if (val[0] == "categoryId") {
						var select = document.getElementById("categoryId");
						for(var j = 0;j < select.options.length;j++){
            				if(select.options[j].value == val[1]){
                				select.options[j].selected = true;
            				}
        				}
					}else if(val[0] == "productKeyword"){
						document.getElementById("productKeyword").value = val[1].split("_").join(" ");
					}
					else if (val[0] == "LocalPickUpCheck"){
						if(val[1] == "true")
							document.getElementById("LocalPickUpCheck").checked = true;
					}else if(val[0] == "FreeShippingCheck") {
						if(val[1] == "true")
							document.getElementById("FreeShippingCheck").checked = true;
					}else if(val[0] == "ConditionNew"){
						if(val[1] == "true")
							document.getElementById("NewCheck").checked = true;
					}else if(val[0] == "ConditionUsed"){
						if(val[1] == "true")
							document.getElementById("UsedCheck").checked = true;
					} else if(val[0] == "ConditionUnspecified"){
						if(val[1] == "true")
							document.getElementById("UnspecifiedCheck").checked = true;
					}else if(val[0] == "NearbySearch"){
						if(val[1] == "true"){
							document.getElementById("NearbySearch").checked = true;
							document.getElementById("distanceForm").disabled = false;
							
						}
					}else if(val[0] == "milesFrom"){
						if(val[1] == null){
							document.getElementById("milesFrom").value = "";	
						}
						else{
							document.getElementById("milesFrom").value = val[1];	
						}
						
						document.getElementById("milesFrom").disabled = false;

					}else if(val[0] == "currentLocation"){
						if(val[1] == "true"){
							document.getElementById("currentLocation").checked = true;
							document.getElementById("currentLocation").disabled = false;
							document.getElementById("zipCodeLocation").disabled = false;
						}
					}else if(val[0] == "zipCodeLocation"){
						if(val[1] == "true"){
							document.getElementById("zipCodeLocation").checked = true;
							document.getElementById("zipCodeLocation").disabled = false;
							document.getElementById("currentLocation").disabled = false;
						}
					}else if(val[0] == "zipCode"){
						if(val[1] == "")
							document.getElementById("zipCode").value = "";
						else
							document.getElementById("zipCode").value = val[1];
						document.getElementById("zipCode").disabled = false;
					}
					else {
						document.getElementById(val[0]).value = val[1];
					}
				}	
			}
			
			function clickedProductDetails(individualJson, similarJson){
				//console.log("clickedProductDetails keyword" + document.getElementById("productKeyword").value);
				setRetainedValue();
				var errorDiv = "<div style = '1px solid black; text-align: center; margin-left: 400px; margin-right: 400px; border: 1px solid black; background-color: #ADD8E6'>No Records has been found</div>";
				similarDiv = generateSimilarItemsFunction(similarJson);
				var jsonObject = JSON.parse(individualJson);
				var result = "<style type='text/css'> table, tr, td { border-collapse: collapse; border: 2px solid #A9A9A9; }";
				result +=  "th, td { padding: 5px;} img {width: 200px; height: 100px;}";
				result += ".collapse {cursor: pointer;padding: 18px;width: 40px;border: none;text-align: left;outline: none;font-size: 15px; height: 30px;}";
				result += ".content {padding: 0 18px;overflow: hidden;display:none;background-color: #f1f1f1}";
				result += ".itemContainer{height: 400px;}";
				result += ".scrolling-wrapper{overflow-x: scroll; overflow-y: hidden; white-space: nowrap; width: 800px; margin: 0 auto; border: 1px solid grey;height: 400px;}";
				result += ".scrolling-wrapper .item{display: inline-block;}";
				result += ".item{width: 200px;height: 400px;word-wrap:break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;margin: 20px;}";
				//result += ".scrolling-wrapper::-webkit-scrollbar{display: none;}";
				result += "a{text-decoration: none;}";
				result += "a:link{color: #000;}";
				result += "a:hover{color: #A9A9A9;}";
				result += ".img{height: 100px; width: 100px;}";
				result += ".iframe{height:100%;}</style>";
				
				var similarItemsExist = true;
				
				//console.log("sellerDescription:" + sellerDescription);
				var sellerErrorDiv = "<div style = '1px solid black; text-align: center; margin-left: 400px; margin-right: 400px; border: 1px solid black; background-color: #ADD8E6'>No Seller Description</div>"
				if(sellerDescription == null){
					sellerDescription = sellerErrorDiv;
				}
				
				if(jsonObject.Ack == "Failure" || jsonObject.Item == null){
					result += errorDiv;
					
					if(similarDiv == "<div style = '1px solid black; text-align: center; margin-left: 400px; margin-right: 400px; border: 1px solid black; background-color: #ADD8E6'>No Similar Items found</div>"){
							document.write(result);
						similarItemsExist = false;
						return null;
						}
					else{
						var sellerMessageDiv = "<div style = 'text-align: center'><p style = 'color: #696969'>Click to Show Seller Message</p><img src = 'http://csci571.com/hw/hw6/images/arrow_down.png' class = 'collapse' style = 'align: center' onclick = 'changeFirstImage();' id = 'firstImage'></img>";
						sellerMessageDiv += "<div class = 'content' id = 'SellerDiv'>" + sellerErrorDiv + "</div>";
						result += sellerMessageDiv;
						result += "<div style = 'text-align:center'><p style = 'color: #696969'>Click to Show Similar Items</p><img src = 'http://csci571.com/hw/hw6/images/arrow_down.png' class = 'collapse' onclick = 'changeSecondImage();' id = 'secondImage'></img>";
					result += "<div class = 'content' id = 'similarDiv'>" + similarDiv + "</div></div>";
					document.write(result);
					var coll = document.getElementsByClassName("collapse");
					var i;
					var similar = document.getElementById("similarDiv");
					
					
					
					for (i = 0; i < coll.length; i++) {
						
						coll[i].addEventListener("click", function() {
							//console.log("Entering event listener");
							this.classList.toggle("active");
							var content = this.nextElementSibling;
							if (content.style.display === "block") {
								content.style.display = "none";
							} else {
								content.style.display = "block";
						}
					});
					}
					return null;
					}
					
				}

				var commonPath = jsonObject.Item;

				result += " \
					<div id = 'itemDetails'> \
						<center> \
							<h1> Item Details </h1> \
							<table id='itemDetailsTable'>";
				if(commonPath.PictureURL != null){
				result += "<tr><td><b>Photo</b></td> \
									<td><img style = 'width: 150px; height: 200px;' src = " + commonPath.PictureURL[0] + "></td> \
								</tr>";
				}
				if(commonPath.Title != null){
				result += "<tr>\
									<td><b>Title</b></td> \
									<td>" + commonPath.Title + "</td> \
								</tr>";
				}
				if(commonPath.Subtitle != null){
				result += "<tr>\
									<td><b>Subtitle</b></td> \
									<td>" + commonPath.Subtitle + "</td> \
								</tr>";
				}
				if(commonPath.CurrentPrice.Value != null){
				result += "<tr>\
									<td><b>Price</b></td> \
									<td>" + commonPath.CurrentPrice.Value + "</td> \
								</tr>";
				}
				if(commonPath.Location != null){
				result += "<tr>\
									<td><b>Location</b></td> \
									<td>" + commonPath.Location + "</td> \
								</tr>";
				}
				if(commonPath.Seller != null && commonPath.Seller.UserID != null){
				result += "<tr>\
									<td><b>Seller</b></td> \
									<td>" + commonPath.Seller.UserID + "</td> \
								</tr>";
				}
				if(commonPath.ReturnPolicy != null && commonPath.ReturnPolicy.ReturnsAccepted != null && commonPath.ReturnPolicy.ReturnsWithin){
							result += "<tr>\
									<td><b>Return Policy(US)</b></td> \
									<td>" + commonPath.ReturnPolicy.ReturnsAccepted + " within " + commonPath.ReturnPolicy.ReturnsWithin + "</td> \
								</tr>";
				}
					
					if(commonPath.ItemSpecifics != null){
						if(commonPath.ItemSpecifics.NameValueList != null){
							var itemSpecifics = commonPath.ItemSpecifics.NameValueList;
					
							for(i = 0; i < itemSpecifics.length; i++) {	
								var keyName = itemSpecifics[i].Name;
								var values = itemSpecifics[i].Value;
								if(values != null){
									var value = values[0];
								}
								else{
									var value = "N/A";
								}
								/*for(j = 1; j < values.length; j++){
									value += ", " + values[j];
								}*/
							
								result += "<tr><td><b>" + keyName + "</b></td><td>" + value + "</td></tr>";
							}
						}
						
					}
					result += "</table></center></div>";
					
					
					
					var similarItemId = commonPath.ItemID;

					

					var sellerDescription = commonPath.Description;
					var iframeDiv = "<iframe id = 'iFrameId' style = 'width: 100%;' srcdoc ='" + sellerDescription + "'></iframe>";

					var sellerError = false;
					if(sellerDescription == null || sellerDescription == ""){
						sellerError = true;
					}

					if (sellerError == false) {
						//newHtmlString = "<html><head></head><body>" + sellerDescription + "</body></html>";
						iframeDiv = "<iframe id = 'iFrameId' style = 'width: 100%;' srcdoc ='" + sellerDescription + "'></iframe>";
					} else {
						var iframeDiv = "<iframe id = 'iFrameId' style = 'width: 100%;' srcdoc =\"<html><body><div style = '1px solid black; text-align: center; margin-left: 400px; margin-right: 400px; border: 1px solid black; background-color: #ADD8E6'>No Seller Description</div></<body></html>\"</iframe>";
					}
					var sellerMessageDiv = "<div style = 'text-align: center'><p style = 'color: #696969'>Click to Show Seller Message</p><img src = 'http://csci571.com/hw/hw6/images/arrow_down.png' class = 'collapse' style = 'align: center' onclick = 'changeFirstImage();' id = 'firstImage'></img>";
					//console.log(sellerDescription);
					sellerMessageDiv += "<div class = 'content' id = 'SellerDiv'>" + iframeDiv + "</div>";
					var similarItemsDiv = "<p style = 'color: #696969'>Click to Show Similar Items</p><img src = 'http://csci571.com/hw/hw6/images/arrow_down.png' class = 'collapse' onclick = 'changeSecondImage();' id = 'secondImage'></img>";
					similarItemsDiv += "<div class = 'content' id = 'similarDiv'>" + similarDiv + "</div></div>";
					
					
					result += "<br>" + sellerMessageDiv;
					result += "<br>" + similarItemsDiv + "<br><br><br><br>";
					document.write(result);
					
					document.getElementById("iFrameId").addEventListener("load", function(){
					setTimeout(function() {
					
							var obj = document.getElementById("iFrameId");
							
							obj.height = obj.contentWindow.document.body.scrollHeight + 50 + "px";
							obj.width  = obj.contentWindow.document.body.scrollWidth;
						    
							}, 2000);
					});	
					var coll = document.getElementsByClassName("collapse");
					var i;
					var seller = document.getElementById("SellerDiv");
					var similar = document.getElementById("similarDiv");
					
					
					
					for (i = 0; i < coll.length; i++) {
						
						coll[i].addEventListener("click", function() {
							//console.log("Entering event listener");
							this.classList.toggle("active");
							var content = this.nextElementSibling;
							console.log(content);

							if (content.style.display === "block") {
								content.style.display = "none";
							} else {
								content.style.display = "block";
								if(content == seller){
									if (similar.style.display === "block") {
										similar.style.display = "none";
									}
								}
								if(content == similar){
									if (similar.style.display === "block") {
										seller.style.display = "none";
									}
									
								}
							
						}
					});
					}
					//document.write(result);
		}
			
			function generateSimilarItemsFunction(itemJson){

				var keywordForPassing = (document.getElementById("productKeyword").value).replace(/ /g,"_");
				var getStringForRetainment = "&productKeyword=" + keywordForPassing +
											"&categoryId=" + document.getElementById("categoryId").value +
											"&LocalPickUpCheck=" + document.getElementById("LocalPickUpCheck").checked +
											"&FreeShippingCheck=" + document.getElementById("FreeShippingCheck").checked +
											"&ConditionNew=" + document.getElementById("NewCheck").checked +
											"&ConditionUsed=" + document.getElementById("UsedCheck").checked +
											"&ConditionUnspecified=" + document.getElementById("UnspecifiedCheck").checked +
											"&NearbySearch=" + document.getElementById("NearbySearch").checked;
											
				var errorDiv = "<div style = '1px solid black; text-align: center; margin-left: 400px; margin-right: 400px; border: 1px solid black; background-color: #ADD8E6'>No Similar Items found</div>";
				if(document.getElementById("NearbySearch").checked == true){
					if(document.getElementById("milesFrom").value == ""){
						getStringForRetainment += "&milesFrom=" + 10;
					}
					else{
						getStringForRetainment += "&milesFrom=" + document.getElementById("milesFrom").value;
					}
					
					if(document.getElementById("currentLocation").checked == true){
						getStringForRetainment += "&currentLocation=" + document.getElementById("currentLocation").checked;
					}
					else{
						getStringForRetainment += "&zipCodeLocation=" + document.getElementById("zipCodeLocation").checked + 
												"&zipCode=" + document.getElementById("zipCode").value;
					}
				}

											
				var jsonObject = JSON.parse(itemJson);
				var results = "<style>.itemContainer{height: 400px;}";
				results += ".scrolling-wrapper{overflow-x: scroll; overflow-y: hidden; white-space: nowrap; width: 800px; margin: 0 auto; border: 1px solid grey;height: 400px}";
				results += ".scrolling-wrapper .item{display: inline-block;}";
				results += ".item{width: 200px;height: 250px;word-wrap:break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;margin: 20px;}";
				//results += ".scrolling-wrapper::-webkit-scrollbar{display: none;}";
				results += "a{text-decoration: none;}";
				results += "a:link{color: #000;}";
				results += "a:hover{color: #A9A9A9;}</style>";
			
				results = "<div class = \"itemContainer\"><div class = \"scrolling-wrapper\">";
				
				if(jsonObject.getSimilarItemsResponse.itemRecommendations == null){
					return (errorDiv);
				}
				var commonPath = jsonObject.getSimilarItemsResponse.itemRecommendations;
				//console.log(commonPath);
				if (commonPath.item.length > 8){
					var count = 8;
				}
				else{
					var count = commonPath.item.length;
				}
				
				if(count == 0){
					return ("<div style = '1px solid black; text-align: center; margin-left: 400px; margin-right: 400px; border: 1px solid black; background-color: #ADD8E6'>No Similar Items found</div>");
				}
				
				for(i = 0; i < count; i++) {
					if(commonPath.item != null && commonPath.item[i].itemId != null){
						var itemID = commonPath.item[i].itemId;	
					}else{
						var itemID = "N/A";	
					}
					if(commonPath.item != null && commonPath.item[i].imageURL != null){
						var imageURL = commonPath.item[i].imageURL;	
					}
					else{
						var imageURL = "N/A";	
					}
					if(commonPath.item != null && commonPath.item[i].title != null){
						var title = commonPath.item[i].title;
					}
					else{
						var title = "N/A";	
					}
					if(commonPath.item != null && commonPath.item[i].buyItNowPrice != "null" && commonPath.item[i].buyItNowPrice.__value__ != null){
						var buyItNowPrice = commonPath.item[i].buyItNowPrice.__value__;
					}
					else{
						var buyItNowPrice = "N/A";	
					}
					if(commonPath.item != null && commonPath.item[i].viewItemURL != null){
						var viewItemURL = commonPath.item[i].viewItemURL;
					}
					else{
						var viewItemURL = "N/A";	
					}
					
					results += "<div class = \"item\"><center><img src = " + imageURL + " style = 'width:200px; height: 200px'></center><br><center><a href = ?individualItem=" + itemID + getStringForRetainment + ">" + title + "</a></center><br><center><b>$" + buyItNowPrice + "</b></center></div>";
				}
				results += "</div></div>"
				//document.write(results);
				return results;
				
			}
			function callPsApi (json) {
				var keywordForPassing = (document.getElementById("productKeyword").value).replace(/ /g,"_");
				var getStringForRetainment = "&productKeyword=" + keywordForPassing +
											"&categoryId=" + document.getElementById("categoryId").value +
											"&LocalPickUpCheck=" + document.getElementById("LocalPickUpCheck").checked +
											"&FreeShippingCheck=" + document.getElementById("FreeShippingCheck").checked +
											"&ConditionNew=" + document.getElementById("NewCheck").checked +
											"&ConditionUsed=" + document.getElementById("UsedCheck").checked +
											"&ConditionUnspecified=" + document.getElementById("UnspecifiedCheck").checked +
											"&NearbySearch=" + document.getElementById("NearbySearch").checked;
											
				
				if(document.getElementById("NearbySearch").checked == true){
					if(document.getElementById("milesFrom").value == ""){
						getStringForRetainment += "&milesFrom=" + 10;
					}
					else{
						getStringForRetainment += "&milesFrom=" + document.getElementById("milesFrom").value;
					}
					
					if(document.getElementById("currentLocation").checked == true){
						getStringForRetainment += "&currentLocation=" + document.getElementById("currentLocation").checked;
					}
					else{
						getStringForRetainment += "&zipCodeLocation=" + document.getElementById("zipCodeLocation").checked + 
												"&zipCode=" + document.getElementById("zipCode").value;
					}
				}
				
				var jsonObject = JSON.parse(json);
				var errorDiv = "<div style = '1px solid black; text-align: center; margin-left: 400px; margin-right: 400px; border: 1px solid black; background-color: #D0D0D0'>No Records has been found</div>"; 

				if(document.getElementById("searchResult") != null){
						//console.log("Entered removal child");
						var individualItem = document.getElementById("searchResult");
						individualItem.parentNode.removeChild(individualItem);
					}
					
				if(document.getElementById("inValidZipCode") != null){
						//console.log("Entered removal child");
						var zipCodeDiv = document.getElementById("inValidZipCode");
						zipCodeDiv.parentNode.removeChild(zipCodeDiv);
					}
					
				var results = "<style>a{text-decoration: none}";
				results += "a:link{color: #000;}";
				results += "a:hover{color: #A9A9A9;}</style>";
				
				results += "<div id='searchResult'> " +
									    "<center>" +
											"<table id='searchResultTable' style='border:1px solid black'>" +
												"<tr>" 	+
												    "<th>Index</th>" +
													"<th>Photo</th>" +
													"<th width=1200px>Name</th>" +
													"<th>Price</th>" +
													"<th>Zip code</th>" +
													"<th>Condition</th>" +
													"<th>Shipping Option</th>" +
												"</tr>";
				
				var checkZipCode = jsonObject.findItemsAdvancedResponse[0];
				if(checkZipCode.ack[0] == "Failure" && checkZipCode.errorMessage[0].error[0].message[0] == "Invalid postal code for specified country."){
					invalidZipCode();
				}
				
				if(jsonObject.findItemsAdvancedResponse[0].searchResult)
				var commonPath = jsonObject.findItemsAdvancedResponse[0].searchResult[0];
				if (commonPath.item == null) {
					document.write(errorDiv);
				} else {
					var counter = commonPath.item.length;
					for( i = 0; i < counter; i++) {
						var itemId = commonPath.item[i].itemId;
						results += "<tr>" +
											"<td>" + ( i + 1) + "</td>";
						if(commonPath.item[i].galleryURL && commonPath.item[i].galleryURL[0] != null){
							results += "<td><img src = " + commonPath.item[i].galleryURL[0] + "style = 'height: 250px; width: 200px'></td>";
						}
						else{
							results += "<td>N/A</td>";
						}
						if(commonPath.item[i].title[0] != null){
							results += "<td><a href= ?individualItem=" + itemId + getStringForRetainment + ">" + commonPath.item[i].title[0] + "</a></td>";
						}
						else{
							results += "<td>N/A</td>";
						}
						if(commonPath.item[i].sellingStatus[0].currentPrice[0].__value__ != null){
							results += "<td>$" + commonPath.item[i].sellingStatus[0].currentPrice[0].__value__ + "</td>" ;
						}
						else{
							results += "<td>N/A</td>";
						}
											
						
						if (commonPath.item[i].postalCode != null) {
							results += "<td>" + commonPath.item[i].postalCode[0] + "</td>";
						} else {
							results += "<td>N/A</td>";
						}	
							
						if (commonPath.item[i].condition != null) {
							results += "<td>" + commonPath.item[i].condition[0].conditionDisplayName[0] + "</td>";
						} else {
							results += "<td>N/A</td>";
						}
			
						if(commonPath.item[i].shippingInfo[0].shippingServiceCost != null){
							var shippingCost = commonPath.item[i].shippingInfo[0].shippingServiceCost[0];
							if (shippingCost.__value__ == 0) {
								var displayShippingVal = "Free Shipping";
							}
							if (shippingCost.__value__ > 0) {
								var displayShippingVal = "$" + shippingCost.__value__;
							}
						}
						else{
							var displayShippingVal = "N/A";
						}
						
						results += "<td>" + displayShippingVal + "</td>" +
									"</tr>";
					}
					
					results += "</table></center></div>";
					
					document.write(results);
				}
			}
			
			function invalidZipCode(){
				document.write("<div id = 'inValidZipCode' style = '1px solid black; text-align: center; margin-left: 400px; margin-right: 400px; border: 1px solid black; background-color: #ADD8E6'>Zipcode is invalid</div>");
			}
			
			function invalidMiles(){
				document.write("<div style = '1px solid black; text-align: center; margin-left: 400px; margin-right: 400px; border: 1px solid black; background-color: #ADD8E6'>Miles is invalid</div>");
			}
			
			<?php
				$keyWordSave = "null";
				if (isset($_POST['Submit'])) {
					
					$valid = true;
					$apiCallString = "https://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=MadhuriJ-WebTech6-PRD-0a6d2f14d-21b6a625&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&paginationInput.entriesPerPage=20";
					
					if (isset($_POST['Keyword'])) {
						$keywordWithSpaces = $_POST['Keyword'];
						/*$keyword = preg_replace('/\s+/', '', $keywordWithSpaces);*/
						$keyword = urlencode($keywordWithSpaces);
						$apiCallString .= "&keywords=" . $keyword;
						$keyWordSave = $keyword;
					}
					$category = $_POST['category'];
					if($category != "AllCategories"){
						$apiCallString .= "&categoryId=" .$category;
					}
					$itemCounter = 0;
					
					$apiCallString .= "&itemFilter(".$itemCounter.").name=HideDuplicateItems&itemFilter(".$itemCounter.").value=true";
					$itemCounter += 1;
					
					/**if ((!isset($_POST['LocalPickupOnly']) && !isset($_POST['FreeShippingOnly']))
						|| (isset($_POST['LocalPickupOnly']) && isset($_POST['FreeShippingOnly']))) {
						$apiCallString .= "&itemFilter(".$itemCounter.").name=LocalPickupOnly&itemFilter(".$itemCounter.").value=true"; 
						$itemCounter += 1;
						$apiCallString .= "&itemFilter(". ($itemCounter) .").name=FreeShippingOnly&itemFilter(". ($itemCounter) .").value=true";
						$itemCounter += 1;
					} else {
						if (isset($_POST['LocalPickupOnly'])) {
							$apiCallString .= "&itemFilter(".$itemCounter.").name=LocalPickupOnly&itemFilter(".$itemCounter.").value=true";
							$itemCounter += 1;
						} 
					 	if (isset($_POST['FreeShippingOnly'])) {
							$apiCallString .= "&itemFilter(".$itemCounter.").name=FreeShippingOnly&itemFilter(".$itemCounter.").value=true";
							$itemCounter += 1;				
						}
					}*/
					
					
						if (isset($_POST['LocalPickupOnly'])) {
							$apiCallString .= "&itemFilter(".$itemCounter.").name=LocalPickupOnly&itemFilter(".$itemCounter.").value=true";
							$itemCounter += 1;
						} 
					 	if (isset($_POST['FreeShippingOnly'])) {
							$apiCallString .= "&itemFilter(".$itemCounter.").name=FreeShippingOnly&itemFilter(".$itemCounter.").value=true";
							$itemCounter += 1;				
						}
					
					
					if (isset($_POST['Condition'])) {
						$apiCallString .= "&itemFilter(".$itemCounter.").name=Condition";
						$valueCounter = 0;
						foreach ($_POST['Condition'] as $checkedBox) {
							$apiCallString .= "&itemFilter(".$itemCounter.").value(".$valueCounter.")=".$checkedBox;
							$valueCounter += 1;
						}
						
					} else {	
						$apiCallString .= "&itemFilter(".$itemCounter.").name=Condition"
										. "&itemFilter(".$itemCounter.").value(0)=New"
										. "&itemFilter(".$itemCounter.").value(1)=Used"
							   			. "&itemFilter(".$itemCounter.").value(2)=Unspecified";
					}
					
					$itemCounter += 1;

					if (isset($_POST['NearbySearch'])) {
						$distance = (isset($_POST['milesFrom']) && $_POST['milesFrom'] != "") ? $_POST['milesFrom'] : 10;
						if(preg_match("/[a-z]/i", $distance) == true || $distance < 0 || strpos( $distance, "." ) == true || preg_match('/\s/',$_POST['milesFrom']) == true){
							$valid = false;
							echo "invalidMiles();";
						}
						$apiCallString .= "&itemFilter(".$itemCounter.").name=MaxDistance&itemFilter(".$itemCounter.").value=" . $distance;
						
						if (isset($_POST['distance'])) {
							if ($_POST['distance'] == "currentLocation") {
								/**$zipCodeGeoLocation = "getGeoLocation();";*/
								/**$apiCallString .= "&buyerPostalCode=" . $_COOKIE["zipCodeGeoLocation"];*/
								$apiCallString .= "&buyerPostalCode=" .$_POST['userLocation'];
							} else if (isset($_POST['zipCode'])){
								//if(strlen($_POST['zipCode']) != 5 || preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$_POST['zipCode']) == false){
								if(strlen($_POST['zipCode']) != 5 || preg_match('/\s/',$_POST['zipCode'])){
									echo "invalidZipCode();";
									$valid = false;
								}
								else{
									$valid = true;
								}
								$apiCallString .= "&buyerPostalCode=" . $_POST['zipCode'];
							}
						}
					}
					
					if($valid == true){
						//echo $apiCallString;
						$productItemJson = file_get_contents($apiCallString);
						$productJson = json_encode($productItemJson, true);
						echo "callPsApi(" . $productJson . ");";
					}
				} 
				
				if(isset($_GET['itemId'])){
					$itemId = $_GET['itemId'];
					$similarItemsApi =  "http://svcs.ebay.com/MerchandisingService?OPERATION-NAME=getSimilarItems&SERVICE-VERSION=1.1.0&CONSUMER-ID=MadhuriJ-WebTech6-PRD-0a6d2f14d-21b6a625&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&itemId=";
					$similarItemsApi .= $itemId;
					$similarItemsApi .= "&maxResults=8";
					
					$similarItemsApiCallString = $similarItemsApi;
					$similarItemJson = file_get_contents($similarItemsApiCallString);
					$jsonSimilarItems = json_encode($similarItemJson, true);
					echo "generateSimilarItemsFunction(" .$jsonSimilarItems .");";
				}
				
				if(isset($_GET['individualItem'])){
					$apiCall = "http://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=MadhuriJ-WebTech6-PRD-0a6d2f14d-21b6a625&siteid=0&version=967&ItemID=";
					$apiCall .= $_GET['individualItem'];
					$apiCall .= "&IncludeSelector=Description,Details,ItemSpecifics";
					$productDetails = $apiCall;
					$productJson = file_get_contents($productDetails);
					$productDetailsJson = json_encode($productJson, true);
					
					
					 $similarItemsApi =  "http://svcs.ebay.com/MerchandisingService?OPERATION-NAME=getSimilarItems&SERVICE-VERSION=1.1.0&CONSUMER-ID=MadhuriJ-WebTech6-PRD-0a6d2f14d-21b6a625&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&itemId=";
					/**$similarItemsApi .= $_GET['itemId'];*/
					$similarItemsApi .= $_GET['individualItem'];
					$similarItemsApi .= "&maxResults=8";
					
					
					$similarItemsApiCallString = $similarItemsApi;
					$similarItemJson = file_get_contents($similarItemsApiCallString);
					$jsonSimilarItems = json_encode($similarItemJson, true);
					echo "clickedProductDetails(" .$productDetailsJson ."," . $jsonSimilarItems .");";
					//**echo "generateSimilarItemsFunction(" .$jsonSimilarItems .");";*/
				}
			?>
			</script>
			
		</div>	
		
	</body>
</html>