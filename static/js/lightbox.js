/* 
A lightbox class for displaying pop ups and other form content on the site.

To show a new lightbox, just call the "showLightbox" function with the following parameters:
@param title : The title you would like to have in the top left of the lightbox (provide empty string if no title).
@param content : The selector of the div you would like to place inside the lightbox.
@param width : The inner width of the lightbox body.

Use the class "lightbox-content" for hiding the content div on the page.
*/

function showLightbox(title, content, width) {
	var lbinner = $('#lightbox-inner');
	var lbtitle = $('#lightbox-title');
	var lbbody = $('#lightbox-body');

	/* Set the title */
	if(title == '') {
		lbtitle.hide();
	} else {
		lbtitle.show().html(title);
	}

	/* Set the body */
	lbbody.html($(content).html());

	/* Set the height and width */
	lbinner.width(width);

	/* Show the lightbox */
	$('body').addClass('no-scroll');
	$('#lightbox').fadeIn(200);
}

function hideLightbox() {
	$('#lightbox').fadeOut(200, function(){
		$('#lightbox-title').empty();
		$('#lightbox-body').empty();
		$('body').removeClass('no-scroll');
	});
}