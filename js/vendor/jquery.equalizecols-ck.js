/**
 *
 * Copyright (c) 2007 Tom Deater (http://www.tomdeater.com)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 * 
 */(function(e){e.fn.equalizeCols=function(){var t=0,n=e.browser.msie&&e.browser.version<7?"1%":"auto";return this.css("height",n).each(function(){t=Math.max(t,this.offsetHeight)}).css("height",t).each(function(){var n=this.offsetHeight;n>t&&e(this).css("height",t-(n-t))})}})(jQuery);