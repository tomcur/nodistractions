$(window).resize(function()
{
    moveImages();
    resizeRelated();
});

/**
 On node insert
*/
var c = document.getElementById('main');
c.__appendChild = c.appendChild;
c.appendChild = function()
{
    c.__appendChild.apply(c, arguments); 
    moveImages();
    resizeRelated();
}

moveImages();
resizeRelated();

/**
 Move right-aligned images to the right to fill the gap at the right side of the
 article content (the gap is there to make lines shorter, but with 
 right-aligned images text is squished).
*/
function moveImages()
{
    var content = $('.entry-content');
    var parent = content.parent();
    var contentGap = parent.width() - content.width();
    
    $('.entry-content figure.alignright, .entry-content img.alignright').each(function()
    {
        var $this = $(this);
        $this.css('marginRight', -Math.min($this.width() + parseInt($this.css('marginLeft')), contentGap));
    });
}

/**
 Resize related box to fit full width.
*/
function resizeRelated()
{
    var content = $('.entry-content');
    var parent = content.parent();
    
    $('.entry-content .jp-relatedposts').width(parent.width());
}