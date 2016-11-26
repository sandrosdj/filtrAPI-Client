// Init. (No Codeparts)
var filtrApp = 452123;
var script = document.createElement("script");script.src = "//filtr.sandros.hu/statistics/"+filtrApp+(document.referrer ? "?cf="+encodeURIComponent(document.referrer):"");document.getElementsByTagName("head")[0].appendChild(script);
function filtrAction(action){return ($.ajax({url: '//filtr.sandros.hu/statistics/'+filtrApp+'?action='+action+'&uid='+filtrUser, async: false}) ? true : true);}


// Codeparts Support
// - modify the second line of the Init code to this
var script = document.createElement("script");script.src = "//filtr.sandros.hu/statistics/"+filtrApp+"?codeparts"+(document.referrer ? "&amp;cf="+encodeURIComponent(document.referrer):"");document.getElementsByTagName("head")[0].appendChild(script);


// Example usage
$('#click_on_me').click(function() {
  filtrAction('clicked_on_the_box');
});

/*
  If you want you can delay the action on your site until the registration of the "pre-action" completed on our side.

  This is useful when you want to monitor links.
  If you're using the normal jQuery get method, you won't be able to monitor clicks on links.

  IMPORTANT! You should use the "Example usage" and this code mixed, because if you're going to use this code only on internal actions like click/gocus on elements your site will slow down drasticly.
*/
$('a').click(function() {
  return filtrAction('clicked_on_the_box');
});
