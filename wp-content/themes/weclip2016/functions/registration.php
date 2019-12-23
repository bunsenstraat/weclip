<?php 
/*
Template Name: user registration
*/
?>
<?php
session_start();
get_header();

?>

<div class="order_title">
	<div class="row title_content">

            <span class="first-line">
                <?php 
                if (get_field('streamer_line1')) {
                    echo get_field('streamer_line1');
                }
                else {
                    echo "Gemakkelijk" ;
                } ?>
            </span>
             <span class="second-line">
                <?php 
                if (get_field('streamer_line2')) {
                    echo get_field('streamer_line2');
                }
                else {
                    echo "Online Bestellen" ;
                } ?>
            </span>
            <span class="third-line"><?php echo $_SESSION['steps']; ?></span>
        </h1>

	</div>
</div>
<div class="order_content"><!--  Think for  it-->
<script type="text/javascript"></script>

<style>
#wizard li {
  margin-top:0 !important;
  list-style-type:none !important;
  list-style-image:none !important;
}
input[type="checkbox"]{
display:inline-block;
width:19px;
height:19px;
margin:-1px 4px 0 0;
vertical-align:middle;
/*background:url(check_radio_sheet.png) left top no-repeat;*/
cursor:pointer;
}
</style>
    
	<div id="wizard" style="margin:0px auto 100px;">	
	<div class="items">
<form action="<?php echo get_template_directory_uri();?>/user-action.php" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
			<div class="page" id="pg5">
				<div class="page_5_step">
				<div class="step_content">
				<h2 class="how_title" style="color:#1F2A3D;margin:25px auto 20px;"> ACCOUNT <br/>
				<img class="step_m" src="<?php bloginfo('template_directory'); ?>/images/step_line.png" /><br/>
				<img class="step_m_2" src="<?php bloginfo('template_directory'); ?>/images/cat.png" />
				</h2>
				</div>
	
				<?php if ( is_user_logged_in() ) { ?>
					<p class="with_login">Je bent al ingelogd.</p>
				<?php } else {?>
				<h2>nog geen klant? maak hier een account</h2>
				<div class="h_rule"></div>
				<h3> uw gegevens</h3>	
				<div class="hor_rule" style="margin:10px 0px;"></div>				
				<div class="field">
				<h4>AANHEF</h4>
				<select name="gender" id="gender">
					<option value="male">Dhr.</option>
					<option value="female">Mevr.</option>
				</select>
				</div>
				<div class="field">
				<h4>VOORNAAM</h4>
				<input type="text" value="" name="VOORNAAM" class="required" id="mce-VOORNAAM" placeholder="TYPE HIER_">
				</div>
				<div class="field">
				<h4>ACHTERNAAM</h4>
				 <input type="text" value="" name="ACHTERNAAM" class="required" id="mce-ACHTERNAAM" placeholder="TYPE HIER_">
				</div>
				<div class="hor_rule" style="margin-top:82px;"></div>
				<div class="field">
				<h4>BEDRIJFSNAAM</h4>
				<input type="text" value="" name="BEDRIJF" class="" id="mce-BEDRIJF" placeholder="TYPE HIER_">
				</div>	
				<div class="field">
				<h4>straat en huisnummer</h4>
				<input type="text" name="streetname" placeholder="TYPE HIER_" id="streetname" value="<?php echo $_SESSION['stree']; ?>">
				</div>
				<div class="field">
				<h4>postcode</h4>
				<input type="text" name="postcode" placeholder="TYPE HIER_" id="postcode" minlength="6" maxlength="6" value="<?php echo $_SESSION['postc']; ?>">
				</div>
				<div class="hor_rule" style="margin-top:85px;"></div>
				<div class="field">
				<h4>plaats</h4>
				<input type="text" name="place" placeholder="TYPE HIER_" id="place" value="<?php echo $_SESSION['place']; ?>">
				</div>
				<div class="field">
				<h4>TEL.NUMMER</h4>
				<input type="text" name="telno" placeholder="TYPE HIER_" id="telno" value="<?php echo $_SESSION['telno']; ?>">
				</div>
				<div class="field">
				<h4>EMAIL ADRES</h4>
				<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="TYPE HIER_">
				</div>
				<div class="hor_rule" style="margin-top:88px;"></div>
				<div class="field">
				<h4>KVK NUMMER</h4>
				<input type="text" name="kvkno" placeholder="TYPE HIER_" id="kvkno" value="<?php echo $_SESSION['kvkno']; ?>">
				</div>
				<div class="field">
				<h4>UW WACHTWOORD</h4>
				<input type="password" name="password" placeholder="TYPE HIER_" id="password">
				</div>
				<div class="field">
				<h4>HERHAAL WACHTWOORD</h4>
				<input type="password" name="cpassword" placeholder="TYPE HIER_" id="cpassword">
				</div>
                <!--
				<div class="mc-field-group input-group" style="float: left; width: 100%;">
    <strong style="margin-right: 11px;float: left; padding-top: 10px;">Aanhef  <span class="asterisk">*</span>
</strong>
    <ul style="float: left;">
    	<li style=" margin-top: 7px !important;float: left;"><input style="display : none;" class="ra5" type="radio" name="AANHEF" value="heer" id="mce-AANHEF-0" <?php if($radd == "heer") { echo "checked"; } ?> ><span id="day5" style=" font-size: 16px;width : 150px !important;" >Heer</span>
		<li style=" margin-top: 7px !important;float: left;"><input style="float: left;" type="radio" value="mevrouw" name="AANHEF" id="mce-AANHEF-1"><label style="float: left; line-height: 21px;" for="mce-AANHEF-1">mevrouw</label></li>
</ul>
</div> -->
        <div id="mce-responses" class="clear">
                <div class="response" id="mce-error-response" style="display:none"></div>
                <div class="response" id="mce-success-response" style="display:none"></div>
        </div>   
				<div class="h_rule" style="margin-top:5px;"></div>
				<h3> AKKOORD</h3>	
				<div class="hor_rule" style="10px 0px 20px;"></div>
				<input style=" display: none;" id="regi" class="register_1" name="vv1" type="checkbox" value="" /><span id="register_12">ik ga akkoord met de voorwaarden</span><br />
				<input style=" display: none;" id="regi" class="register_2" name="vv2" type="checkbox" value="1" checked /><span id="register_22">ik blijf graag op de hoogte van de voordelen van weclip </span>
<?php } ?>	
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
					$ = jQuery.noConflict();
					$(document).ready(function() {
					  $('#register_12').on('click', function(event) {
					 	 $('.register_1').trigger('click');
					  });
					  $('.register_1').on('change', function(event) {
					    var checkbox = $(event.target);
					  });
					});				
				
					$(document).ready(function() {
					  $('#register_22').on('click', function(event) {
					 	 $('.register_2').trigger('click');
					  });
					  $('.register_2').on('change', function(event) {
					    var checkbox = $(event.target);
					  });
					});				
				</script>	</div> <!-- Step 5 -->
				<br /><?php if ( is_user_logged_in() ) { } else {?>				
				<p style="margin-top:90px">				   
				  <input type="submit" value="MAAK EEN ACCOUNT AAN" class="next right" style="float:left" name="b_ur" onClick="return ValidationsFour();" /> 	  
				</p><?php } ?>
			</div>
</form>
	
		</div>	
</div> <!-- Wizard  -->	
<div class="icon">
	<div class="icon_content">
		<div class="icon_one">
			<img class="icon_big" src="<?php bloginfo('template_directory'); ?>/images/icon_big.png" />
		</div>
		<div class="icon_second">
			<div class="icon_f_l">
				<li class="first"><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/adidas.png" /></li>
				<li><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/bruna.png" /></li>
				<li><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/heineken.png" /></li>
				<li class="last"><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/interbakery.png" /></li>
			</div>
			<div clas="icon_s_l">
				<li class="first"><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/bacardi.png" /></li>
				<li><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/nike.png" /></li>
				<li><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/casio.png" /></li>
				<li class="last"><img class="icon_s" src="<?php bloginfo('template_directory'); ?>/images/zwitsal.png" /></li>
			</div>
		</div>
	</div>
</div>	
<script type="text/javascript">
/*function mymail(){
alert("SOFG");*/
var fnames = new Array();var ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='VOORNAAM';ftypes[1]='text';fnames[2]='ACHTERNAAM';ftypes[2]='text';fnames[3]='BEDRIJF';ftypes[3]='text';fnames[4]='AANHEF';ftypes[4]='radio';
try {
    var jqueryLoaded=jQuery;
    jqueryLoaded=true;
} catch(err) {
    var jqueryLoaded=false;
}
var head= document.getElementsByTagName('head')[0];
if (!jqueryLoaded) {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = '//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
    head.appendChild(script);
    if (script.readyState && script.onload!==null){
        script.onreadystatechange= function () {
              if (this.readyState == 'complete') mce_preload_check();
        }    
    }
}

var err_style = '';
try{
    err_style = mc_custom_error_style;
} catch(e){
    err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
}
var head= document.getElementsByTagName('head')[0];
var style= document.createElement('style');
style.type= 'text/css';
if (style.styleSheet) {
  style.styleSheet.cssText = err_style;
} else {
  style.appendChild(document.createTextNode(err_style));
}
head.appendChild(style);
setTimeout('mce_preload_check();', 250);

var mce_preload_checks = 0;
function mce_preload_check(){
    if (mce_preload_checks>40) return;
    mce_preload_checks++;
    try {
        var jqueryLoaded=jQuery;
    } catch(err) {
        setTimeout('mce_preload_check();', 250);
        return;
    }
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
    head.appendChild(script);
    try {
        var validatorLoaded=jQuery("#fake-form").validate({});
    } catch(err) {
        setTimeout('mce_preload_check();', 250);
        return;
    }
    mce_init_form();
}
function mce_init_form(){
    jQuery(document).ready( function($) {
      var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
      var mce_validator = $("#signup_form").validate(options);
      $("#signup_form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
      options = { url: 'http://weclip.us7.list-manage1.com/subscribe/post-json?u=f4fcc4bda3f4d3021f6729b49&id=a1a050ca83&c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
                    beforeSubmit: function(){
                        $('#mce_tmp_error_msg').remove();
                        $('.datefield','#pg5').each(
                            function(){
                                var txt = 'filled';
                                var fields = new Array();
                                var i = 0;
                                $(':text', this).each(
                                    function(){
                                        fields[i] = this;
                                        i++;
                                    });
                                $(':hidden', this).each(
                                    function(){
                                        var bday = false;
                                        if (fields.length == 2){
                                            bday = true;
                                            fields[2] = {'value':1970};//trick birthdays into having years
                                        }
                                            if ( fields[0].value=='MM' && fields[1].value=='DD' && (fields[2].value=='YYYY' || (bday && fields[2].value==1970) ) ){
                                                    this.value = '';
                                                                            } else if ( fields[0].value=='' && fields[1].value=='' && (fields[2].value=='' || (bday && fields[2].value==1970) ) ){
                                                    this.value = '';
                                                                            } else {
                                                                                if (/\[day\]/.test(fields[0].name)){
                                                    this.value = fields[1].value+'/'+fields[0].value+'/'+fields[2].value;                                                                                
                                                                                } else {
                                                    this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
                                                }
                                            }
                                    });
                            });
                        $('.phonefield-us','#pg5').each(
                            function(){
                                var fields = new Array();
                                var i = 0;
                                $(':text', this).each(
                                    function(){
                                        fields[i] = this;
                                        i++;
                                    });
                                $(':hidden', this).each(
                                    function(){
                                        if ( fields[0].value.length != 3 || fields[1].value.length!=3 || fields[2].value.length!=4 ){
                                                    this.value = '';
                                                                            } else {
                                                                                this.value = 'filled';
                                            }
                                    });
                            });
                        return mce_validator.form();
                    }, 
                    success: mce_success_cb
                };
      $('#signup_form').ajaxForm(options);
      
      
    });
}
function mce_success_cb(resp){
    $('#mce-success-response').hide();
    $('#mce-error-response').hide();
    if (resp.result=="success"){
        $('#mce-'+resp.result+'-response').show();
        $('#mce-'+resp.result+'-response').html(resp.msg);
        $('#signup_form').each(function(){
            this.reset();
            });
    } else {
        var index = -1;
        var msg;
        try {
            var parts = resp.msg.split(' - ',2);
            if (parts[1]==undefined){
                msg = resp.msg;
            } else {
                i = parseInt(parts[0]);
                if (i.toString() == parts[0]){
                    index = parts[0];
                    msg = parts[1];
                } else {
                    index = -1;
                    msg = resp.msg;
                }
            }
        } catch(e){
            index = -1;
            msg = resp.msg;
        }
        try{
            if (index== -1){
                $('#mce-'+resp.result+'-response').show();
                $('#mce-'+resp.result+'-response').html(msg);            
            } else {
                err_id = 'mce_tmp_error_msg';
                html = '<div id="'+err_id+'" style="'+err_style+'"> '+msg+'</div>';
                
                var input_id = '#pg5';
                var f = $(input_id);
                if (ftypes[index]=='address'){
                    input_id = '#mce-'+fnames[index]+'-addr1';
                    f = $(input_id).parent().parent().get(0);
                } else if (ftypes[index]=='date'){
                    input_id = '#mce-'+fnames[index]+'-month';
                    f = $(input_id).parent().parent().get(0);
                } else {
                    input_id = '#mce-'+fnames[index];
                    f = $().parent(input_id).get(0);
                }
                if (f){
                    $(f).append(html);
                    $(input_id).focus();
                } else {
                    $('#mce-'+resp.result+'-response').show();
                    $('#mce-'+resp.result+'-response').html(msg);
                }
            }
        } catch(e){
            $('#mce-'+resp.result+'-response').show();
            $('#mce-'+resp.result+'-response').html(msg);
        }
    }
}
/*}*/
</script>
<script type="text/javascript">
	function ValidationsFour() 
	{
				var fi_name = document.getElementById("mce-VOORNAAM").value;
                var su_name = document.getElementById("mce-ACHTERNAAM").value;
                var co_name = document.getElementById("mce-BEDRIJF").value;
                var st_name = document.getElementById("streetname").value;
                var zi_code = document.getElementById("postcode").value;
				var pl_name = document.getElementById("place").value;
                var tel_num = document.getElementById("telno").value;
                var eml_add = document.getElementById("mce-EMAIL").value;
                var kvk_num = document.getElementById("kvkno").value;
                var pas_wrd = document.getElementById("password").value;
				var cpas_wr = document.getElementById("cpassword").value;

		if(fi_name==null || fi_name=="")
                {
                    alert("Voer uw voornaam in.");
                    document.getElementById("mce-VOORNAAM").focus();
                    return false;
                }

		if(su_name==null || su_name=="")
                {
                    alert("Voer uw achternaam in.");
                    document.getElementById("mce-ACHTERNAAM").focus();
                    return false;
                }

		if(co_name==null || co_name=="")
                {
                    alert("Voer uw bedrijfsnaam in.");
                    document.getElementById("mce-BEDRIJF").focus();
                    return false;
                }
	
		if(st_name==null || st_name=="")
                {
                    alert("Voer uw adres in.");
                    document.getElementById("streetname").focus();
                    return false;
                }

		if(zi_code==null || zi_code=="")
                {
                    alert("Voer uw postcode in.");
                    document.getElementById("postcode").focus();
                    return false;
                }	
	
		if(zi_code.length < 6){
        		alert(zi_code + " is te kort.");
			document.getElementById('postcode').focus();
			return false;
    		}

		if(pl_name==null || pl_name=="")
                {
                    alert("Voer uw plaats in.");
                    document.getElementById("place").focus();
                    return false;
                }

		if(tel_num==null || tel_num=="")
                {
                    alert("Voer uw telefoonnummer in.");
                    document.getElementById("telno").focus();
                    return false;
                }

		if(eml_add==null || eml_add=="")
                {
                    alert("Voer een geldig e-mailadres in.");
                    document.getElementById("mce-EMAIL").focus();
                    return false;
                }

		/*if(kvk_num==null || kvk_num=="")
                {
                    alert("Voer uw kvk nummer in.");
                    document.getElementById("kvkno").focus();
                    return false;
                }*/

		var isANumber = isNaN(kvk_num) === false;	
		if(isNaN(kvk_num))
		{
			alert('Voer uw kvk nummer in.');
			document.getElementById('kvkno').focus();
			return false;
		}

		if(pas_wrd==null || pas_wrd=="")
                {
                    alert("Geef een geldig wachtwoord op.");
                    document.getElementById("password").focus();
                    return false;
                }

		if(cpas_wr==null || cpas_wr=="")
                {
                    alert("Geef een geldig wachtwoord op.");
                    document.getElementById("cpassword").focus();
                    return false;
                }

		if(cpas_wr !==pas_wrd)
                {
                    alert("Wachtwoord wordt niet overeen.");
                    document.getElementById("cpassword").focus();
                    return false;
                } 
				
		if(document.signup_form.vv1.checked == false)
		{
		    alert ('Selecteer systemen en voorwaarden.');
   		    return false;
		}
		/*if(document.signup_form.vv2.checked == true)
		{ 
			alert("Helloo");
			mymail();
		}*/
		
				var regArray=new Array();
				regArray[0]=fi_name;
				regArray[1]=su_name;
				regArray[2]=co_name;
				regArray[3]=st_name;
				regArray[4]=zi_code;
				regArray[5]=pl_name;
				regArray[6]=tel_num;
				regArray[7]=eml_add;
				regArray[8]=kvk_num;
				regArray[9]=pas_wrd;
				regArray[10]=cpas_wr;
				
				window.location='../wp-content/themes/weclip/user-action.php?ar='+regArray+''; 
		/*}*/
				
	}
</script>

	
<?php get_footer(); ?>
