(function($) {
 $.fn.collidesWith = function(elements) {
  var rects = this;
  var checkWith = $(elements);
  var c = $([]);

  if (!rects || !checkWith) { return false; }

  rects.each(function() {            
   var rect = $(this);

   // define minimum and maximum coordinates
   var rectOff = rect.offset();
   var rectMinX = rectOff.left;
   var rectMinY = rectOff.top;
   var rectMaxX = rectMinX + rect.outerWidth();
   var rectMaxY = rectMinY + rect.outerHeight();

   checkWith.not(rect).each(function() {
    var otherRect = $(this);
    var otherRectOff = otherRect.offset();
    var otherRectMinX = otherRectOff.left;
    var otherRectMinY = otherRectOff.top;
    var otherRectMaxX = otherRectMinX + otherRect.outerWidth();
    var otherRectMaxY = otherRectMinY + otherRect.outerHeight();
	
    // check for intersection
    if ( rectMinX >= otherRectMaxX ||
         rectMaxX <= otherRectMinX ||
         rectMinY >= otherRectMaxY ||
         rectMaxY <= otherRectMinY ) {
           return true; // no intersection, continue each-loop
    } else {
		// intersection found, add only once
		if(c.length == c.not(this).length) { c.push(this); }
    }
   });
        });
   // return collection
        return c;
 }
})(jQuery);