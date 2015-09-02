<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 


<script src="<?=base_url()?>assets/backend/js/jquery-ui-1.10.2.custom.min.js"></script> <!-- jQuery UI -->



<!-- jQuery Flot -->
<script src="<?=base_url()?>assets/backend/js/excanvas.min.js"></script>
<script src="<?=base_url()?>assets/backend/js/jquery.flot.js"></script>
<script src="<?=base_url()?>assets/backend/js/jquery.flot.resize.js"></script>
<script src="<?=base_url()?>assets/backend/js/jquery.flot.pie.js"></script>
<script src="<?=base_url()?>assets/backend/js/jquery.flot.stack.js"></script>

<script src="<?=base_url()?>assets/backend/js/sparklines.js"></script> <!-- Sparklines -->
<script src="<?=base_url()?>assets/backend/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="<?=base_url()?>assets/backend/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="<?=base_url()?>assets/backend/js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="<?=base_url()?>assets/backend/js/filter.js"></script> <!-- Filter for support page -->
<script src="<?=base_url()?>assets/backend/js/custom.js"></script> <!-- Custom codes -->
<script src="<?=base_url()?>assets/backend/js/charts.js"></script> <!-- Custom chart codes -->
<script src="<?=base_url()?>assets/backend/js/jquery.mousewheel.js"></script> <!-- Mouse Wheel -->
<script src="<?=base_url()?>assets/backend/js/jquery.horizontal.scroll.js"></script> <!-- horizontall scroll with mouse wheel -->
<script type="text/javascript" src="<?=base_url()?>assets/backend/js/jquery.slimscroll.min.js"></script> <!-- vertical scroll with mouse wheel -->




<!-- Script for this page -->
<script type="text/javascript">
$(document).ready(function () {

	//dash
		//hidden filter box
		countshowfilter = 2; showfilterbox();


});

var countshowfilter = 1;
function showfilterbox(){
    if(countshowfilter==1){
        $(".filterbox").show();
        countshowfilter = 2;
    }
    else{
        $(".filterbox").hide();
        countshowfilter = 1;
    }
}




</script>

</body>
</html>