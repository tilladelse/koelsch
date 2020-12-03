(function( $ ) {
	'use strict';

	$(function() {
    $('.reset-homepage').on('click', function(e){
      e.preventDefault();
      confirm('Are you sure?');
      var element = '<input type="hidden" name="_create_homepage" value="1">';
      $(this).append(element);
      $('input[name="save"]').click();

      // console.log('reset homepage id');
    });

  });

})( jQuery );
