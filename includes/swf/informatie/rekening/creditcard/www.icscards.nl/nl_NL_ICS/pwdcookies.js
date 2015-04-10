// JavaScript Cookie and auxiliary Functions

// Given a domain name, compute and return the most permissive version
function computeTopDomain(dom) {
  var dot1 = dom.lastIndexOf(".");
  if(dot1 <= 0)
    return dom;
  var dot2 = dom.lastIndexOf(".", dot1 - 1);
  if(dot2 < 0)
    return dom;
  var suffix = dom.substr(dot1 + 1).toLowerCase();
  if(suffix == "com" || suffix == "net" || suffix == "edu" || suffix == "org" || suffix == "gov" || suffix == "mil" || suffix == "int")
    return dom.substr(dot2 + 1);
  var dot3 = dom.lastIndexOf(".", dot2 - 1);
  if(dot3 < 0)
    return dom;
  else
    return dom.substr(dot3 + 1);
}

// Return the most permissive version of this document's domain
function getTopDomain() {
  return computeTopDomain(document.domain);
}

// Returns true iff the current domain is already maximally permissive
// (i.e. has fewer than two '.'s in it)
function isTopDomain() {
  return document.domain == getTopDomain();
}

// Convert an arbitrary string to a legal JavaScript window name
function makeWindowName(name) {
  var i;
  var c;
  var ret = "";
  for(i = 0; i < name.length; ++i) {
    c = name.charAt(i);
    if((c >= 'a' && c <= 'z') || (c >= 'A' && c <= 'Z'))
      ret += c;
    else
      ret += '_';
  }
  return ret;
}

function getCookie(name) {
  var dcookie = document.cookie; 
  var cname = name + "=";
  var clen = dcookie.length;
  var cbegin = 0;
  var hasempty = 0;
  while(cbegin < clen) {
    var vbegin = cbegin + cname.length;
    if(dcookie.substring(cbegin, vbegin) == cname) { 
      var vend = dcookie.indexOf(";", vbegin);
      if(vend == -1)
        vend = clen;
      if(vbegin == vend) // Ignore empty cookies unless that's all we have
        ++hasempty;
      else
        return unescape(dcookie.substring(vbegin, vend));
    }
    cbegin = dcookie.indexOf(" ", cbegin) + 1;
    if(cbegin == 0)
      break;
    }
  if(hasempty > 0)
    return "";
  else
    return null;
}

function setCookie(name, value) {
  document.cookie = name + "=" + escape(value) + "; path=/";

  // Note: to use custom domain names in cookies, use the following line instead:
  // document.cookie = name + "=" + escape(value) + "; path=/; domain=domainname.com";

}

function setPermCookie(name, value) {
  var dom = "";
  if(!isTopDomain()) {
    // Erase old cookie
    document.cookie = name + "=; path=/; expires=Sat, 09-Jan-2038 12:00:00 GMT";
    dom = "domain=." + getTopDomain() + "; ";
  }
  document.cookie = name + "=" + escape(value) + "; path=/; " + dom + "expires=Sat, 09-Jan-2038 12:00:00 GMT";
}

function delCookie(name) {
  document.cookie = name + "=" + "; path=/";

  // Note: to use custom domain names in cookies, use the following line instead:
  // document.cookie = name + "=" + "; path=/; domain=domainname.com";


}

function removeCookie(name) {
  var value = getCookie(name);
  if(value != null)
    delCookie(name);
  return value;
}
