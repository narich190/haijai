<footer style="margin:0;background:#30dbb5;width:100%;color:white;padding:0;margin:0;min-height:250px;">
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title></title>  
		</div>
<style type="text/css">  
html{  
    padding:0px;  
    margin:0px;  
}  
div#map_canvas{  
    margin:auto;  
    width:800px;  
    height:230px;  
    overflow:hidden;  
}  
</style>  
</style>  
  
</head>  
  
<body>  
</head>  
	<!--เนื้อหา-->
<style>
	p.normal {
		font-style: normal;   
	}
	p.italic 
		font-style: italic;
	}
	p.oblique {
		font-style: oblique;
	}
	p.margin {
		 margin-: 18cm;
	}
</style>
	<div class="container" style="padding:40px;margin:0;">
		<!--ข้อมูลติดต่อ-->
		<div class="col-sm-12" style="padding:0;">
			<div class="col-sm-2"></div>
			<div class="col-sm-6">
				<br>
				<br>
				<p class="italic"><span style="font-size:35;">CONTACT US</span></p>
				<span style="font-size:17">School of Information Technology<br>
					King Mongkut's University of Technology Thonburi,<br>
					126 Pracha Uthit Road,Bang Mod,Thung Khru,Bangkok, Thailand 10140
					<br></span>
					<br>
					<span><a href=https://www.google.co.th>เกี่ยวกับเรา</a></span>&nbsp
					<span><a href=https://www.google.co.th>นโยบายของเรา</a></span>&nbsp	
					<span><a href=https://www.google.co.th>รายงานปัญหาทั่วไป</a></span>&nbsp
					<span><a href=https://www.google.co.th>ช่วยเหลือ</a></span>&nbsp
				<br>
			</div>
			<div class="col-sm-4" style="padding-right:50px;margin:0;">
				<span><div id="map_canvas" style='width:350px;padding:20px;'></div></span>
			</div>
		</div>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAcNvUk-nhOGHxtqYjlYDTRRQIRG6yKtEoODg8BfMKCyHqWgeYjhTbSKxVXskDpcNKx0i7Msr1-E1jhg" type="text/javascript"></script>  
	<script type="text/javascript">   
		function initialize() {   
		  if (GBrowserIsCompatible()) {   
		    var map = new GMap2(document.getElementById("map_canvas"));   
		    var center = new GLatLng(13.651595, 100.496436); // การกำหนดจุดเริ่มต้น  

		    map.setCenter(center, 15);  // เลข 13 คือค่า zoom  สามารถปรับตามต้องการ   
		    map.setUIToDefault();   
		      
		    var marker = new GMarker(center, {draggable: true});    
		    map.addOverlay(marker);  
		       
		    GEvent.addListener(marker, "dragend", function() {  
		        var point = marker.getPoint();  
		        map.panTo(point);  
		  
		        $("#lat_value").val(point.lat());  
		        $("#lon_value").val(point.lng());  
		        $("#zoom_value").val(map.getZoom());  
		  
		    });    
       
  }   
}   
</script>   

<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>  
<script type="text/javascript">  
$(function(){  
    initialize();  
    $(document.body).unload(function(){  
            GUnload();  
    });  
});  
</script>  

		<!---->
		<!--เมนูติดต่อ-->
 
		<!---->
	</div>
</footer>

</body>
</html>