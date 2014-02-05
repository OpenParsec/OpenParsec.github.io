// a LightBox JS Object
// TODO: Need to test the LightBox stuff, make sure it works.
var LtBox = function() {};

// Function to initalize any links with the lt_box class
LtBox.init = function() {
	// clear out any bound functions to the links with the lt_box class
	jQuery('.lt_box').unbind();
	
	// override the click function with our function
    	jQuery( document ).on("click",".lt_box", function( event ) {
		event.preventDefault();
    	
    		new LtBox.hide();
    	
    		// the width of the LightBox can be specified as an attribute
    		// in the link
		var width = jQuery(this).attr("lb_size");

		// default the width to 250 if it's unspecified
		width = width ? width : 250;


		// load the LightBox.  LB requests should be ajax, otherwise
		// we'll get all the other crap with it too.
		new LtBox.load(this.href+'/ajax=1',{},width);


        	return false;
	});


	jQuery( document ).on( "submit", ".ltBoxForm", function ( event ){

		event.preventDefault();
		jQuery.ajax({
			url: jQuery(this)[0].action,
			data: jQuery(this).serialize(),
			type: 'POST',
			success: function(data){
				jQuery('#LtBox').hide('normal');
				jQuery('#LB_Content').html("");
				jQuery('#LB_Content').html(data);
				//jQuery('#LtBox').slidedown();
				new LtBox.show(250);

			},

		});


		return false;



	});
    
};

// Function to load the content into the light box.
LtBox.load = function(url,params,width) {

	// request to get the HTML data into the content of the LB
	jQuery('#LB_Content').load(url,params);
	
	// now show it.
	new LtBox.show(width);

};

// Function to show the LB
LtBox.show = function(width) {

	// get the dimensions of the body
	var dim = new LtBox.getWidthHeight(document.getElementsByTagName('body')[0]);

	// the hight of the overlay should be the height of the body.
	jQuery('#LB_Overlay').height(dim.height);

	// hide any iframes, cuz they cause badness
	jQuery('iframe').css({visibility:'hidden'});

	// set  the overlay to display: block;
	jQuery('#LB_Overlay').css({display:'block'});

	// set the overlay height equal to the size of the whole page not just
	// the visible part.
	jQuery('#LB_Overlay').height(document.getElementsByTagName('body')[0].scrollHeight);

	// when a user clicks on the overlay, hide everything.
	jQuery('#LB_Overlay').click(function() {
		new LtBox.hide();
	});

	// when a user clicks the x button or a cancel button, hide it too.
	jQuery( document ).on( "click", '#btn_Close,#btn_Cancel', function( event ) {
		event.preventDefault();
		new LtBox.hide();
		return false;
	});
	
	// if a user clicks cancel on a subForm, push then back by 1
	jQuery( document ).on( "click", '#btn_SubCancel', function ( event ) {
		event.preventDefault();
		
		var url=jQuery('#referrer').attr('value');
		
		
		// hide the light box
		jQuery('#LtBox').hide('normal');
		
		// clear the contents
		jQuery('#LB_Content').html("");

		
		// load the new stuff
		jQuery('#LB_Content').load('/index.php' + url);
		
		// animate the show.
		jQuery('#LtBox').slideDown()
		return false;
	});
    
	jQuery( document ).on( "submit",  '#subForm', function ( event ){ 
		event.preventDefault();
		return false;
	});

	
	// stuff for a lightbox that posts to a URL within a lightbox.
	jQuery( document ).on( "click", '#btn_SubSave', function( event ) {
		event.preventDefault();
		//TODO: ajax post the form and get the output
		// request to get the HTML data into the content of the LB
		var url=jQuery('#subForm').attr('action');
		var frm_params=jQuery('#subForm').serializeArray();
		
		// hide the light box
		jQuery('#LtBox').hide('normal');
		
		// clear the contents
		jQuery('#LB_Content').html("");
		
		// load the new stuff
		jQuery('#LB_Content').load(url, frm_params);
		
		
		// animate the show.
		jQuery('#LtBox').slideDown();
		return false;
		
	});
	

	// display the LightBox, all cool style
	jQuery('#LtBox').slideDown();

	return false;
};

// Function to hide the LightBox
LtBox.hide = function() {
	// reshow the iframes.
	jQuery('iframe').css({visibility:'visible'});

	// hide the LightBox
	jQuery('#LtBox').hide('normal');

	// hide the overlay and unbind the click handler
	jQuery('#LB_Overlay').hide();
	jQuery('#LB_Overlay').unbind('click');

	return false;
};

// Utility Function for the LightBox to get WxH for an element
LtBox.getWidthHeight = function(element) {

	return {width: jQuery(element).width(), height: jQuery(element).height()};

};



jQuery(document).ready(function() {
	jQuery.noConflict();
	new LtBox.init();
});
