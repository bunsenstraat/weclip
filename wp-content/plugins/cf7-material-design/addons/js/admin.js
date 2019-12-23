jQuery(document).ready(function($){
    $('.mdcf7-color-field').wpColorPicker();
	$( window ).scroll(function() {
	var a = $(".mdcf7-card").offset().top + $(".mdcf7-card").outerHeight();
	var b = $(window).scrollTop() + $(window).height();
	var c = b - a + 25; var d = c + "px";
  if (a < b) { 
  $(".btn-fixed").css("bottom",d);
  } else {
$(".btn-fixed").css("bottom","25px");}
});
$( "pre" ).each(function(index) {
  $(this).find(".mdcf7-copy").on("click", function(){
  var a = $(this).parents("pre").children("code");
  var $temp = $("<textarea>");
  $("body").append($temp);
  $temp.val($(a).text()).select();
  document.execCommand("copy");
  $temp.remove();
    });
});
$( ".input-field" ).each(function(index) {
$(this).click(function() {
  $(this).find("label").addClass("active");
  $(this).find("input").focus();
 
});});
$( ".input-field input" ).each(function(index) { 

	  $(this).focusout(function() { 	if( !$(this).val() ) { $(this).next("label").removeClass("active"); }});
		
	  $(this).focus(function() { $(this).next("label").addClass("active"); });	
});
$( ".input-field textarea" ).each(function(index) { 

	  $(this).focusout(function() { if( !$(this).val() ) { $(this).next("label").removeClass("active"); } });
	  $(this).focus(function() { $(this).next("label").addClass("active"); });	
});

    // Textarea Auto Resize
    var hiddenDiv = $('.hiddendiv').first();
    if (!hiddenDiv.length) {
      hiddenDiv = $('<div class="hiddendiv common"></div>');
      $('body').append(hiddenDiv);
    }
    var text_area_selector = '.materialize-textarea';


function textareaAutoResize($textarea) {
      // Set font properties of hiddenDiv

      var fontFamily = $textarea.css('font-family');
      var fontSize = $textarea.css('font-size');
      var lineHeight = $textarea.css('line-height');
      var padding = $textarea.css('padding');

      if (fontSize) { hiddenDiv.css('font-size', fontSize); }
      if (fontFamily) { hiddenDiv.css('font-family', fontFamily); }
      if (lineHeight) { hiddenDiv.css('line-height', lineHeight); }
      if (padding) { hiddenDiv.css('padding', padding); }

      // Set original-height, if none
      if (!$textarea.data('original-height')) {
        $textarea.data('original-height', $textarea.height());
      }

      if ($textarea.attr('wrap') === 'off') {
        hiddenDiv.css('overflow-wrap', 'normal')
                 .css('white-space', 'pre');
      }

      hiddenDiv.text($textarea.val() + '\n');
      var content = hiddenDiv.html().replace(/\n/g, '<br>');
      hiddenDiv.html(content);


      // When textarea is hidden, width goes crazy.
      // Approximate with half of window size

      if ($textarea.is(':visible')) {
        hiddenDiv.css('width', $textarea.width());
      }
      else {
        hiddenDiv.css('width', $(window).width()/2);
      }


      /**
       * Resize if the new height is greater than the
       * original height of the textarea
       */
      if ($textarea.data('original-height') <= hiddenDiv.height()) {
        $textarea.css('height', hiddenDiv.height());
      } else if ($textarea.val().length < $textarea.data('previous-length')) {
        /**
         * In case the new height is less than original height, it
         * means the textarea has less text than before
         * So we set the height to the original one
         */
        $textarea.css('height', $textarea.data('original-height'));
      }
      $textarea.data('previous-length', $textarea.val().length);
    }
$('body').on('keyup keydown autoresize', text_area_selector, function () {
      textareaAutoResize($(this));
    });
	

});
