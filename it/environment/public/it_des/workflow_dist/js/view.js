
$(function() {	
	
	$(document).mouseup(function(e) {
		var target = $(e.target);
		if (e.which === 1) {
			if($(target).parents('aside').length < 1) {
				$('aside').addClass('invisible');
				$('#workflowBtn').removeClass('active');
			}
		}
	});
	
	$('#workflowBtn').click(function() {
		$(this).toggleClass('active');
		$('aside').toggleClass('invisible');
	});
	
	$('.key').show();
	if($.cookie('help_collapsed')) {
		$('.key').addClass('collapsed');
	}
	$('.key .close, .key .help').click(function() {
		$('.key').toggleClass('collapsed');
		if($('.key').hasClass('collapsed')) {
			$.cookie('help_collapsed', true, { expires: 365 });
		}
		else {
			$.removeCookie('help_collapsed');
		}
	});
	
	$('a:not(.realLink)').bind("click dblclick", function(event) {
		event.preventDefault();
	});
	
	$('article').css('visibility', '');
	
});

	