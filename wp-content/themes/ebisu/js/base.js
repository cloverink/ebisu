function loc(url) {
  var localA  = document.createElement("a");
      localA.href = url;
  var path    = localA.pathname.toLowerCase();
  if (path.charAt(0) == "/") path = path.substr(1);
  if (path.charAt(path.length - 1) == "/") path = path.substr(0, path.length - 1);
  return path;
}


jQuery(document).ready(__DetectMObile);
jQuery( window ).resize(__DetectMObile);

function __DetectMObile() {
  $width = jQuery(document).width();
  if($width < 1024) {
    jQuery("body").addClass("tablet");
    if($width < 768) {
      jQuery("body").addClass("mobile");
    } else {
      jQuery("body").removeClass("mobile");
    }
  } else {
    jQuery("body").removeClass("tablet");
  }
  
}
