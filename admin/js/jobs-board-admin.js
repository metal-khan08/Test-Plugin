(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );
// ajax to export applications
jQuery(document).ready(function($){
	$('#applicationExport').ajaxForm({
		success:function(response){
			window.open( response );
		}
	});
});

//ajax for jobs imort and export
		jQuery('#jobsExport').submit(function(event){
		event.preventDefault();		
		var formD=jQuery("#jobsExport").serialize();
    var formData =new FormData;
    formData.append('action','jobs_board_csv');
		formData.append('jobs_board_csv',formD);
		jQuery.ajax({
			url:my_ajax_object.ajax_url,
			data:formData,
			processData:false,
			contentType: false,
			type:'post',
			success:function(data){
				console.log('success');
				window.open( data );
				jQuery.unlink( data );
				
          }
		});
		});

		// ajax for the csv import
			jQuery(document).ready(function($){
		$('#importAction').ajaxForm({
			success:function(response){
				console.log(response);
				document.getElementById("importAction").reset();
				document.getElementById("result").innerHTML += response;

			}
		});
	});
