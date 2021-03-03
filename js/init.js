(function() 
{
	$('html').removeClass('no-js').addClass('js').delay(100).queue(function(next)
	{
		$(this).removeClass('load');
		next();
	});
})();
