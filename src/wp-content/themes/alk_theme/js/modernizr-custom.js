/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-backgroundblendmode-bgpositionxy-bgsizecover-boxshadow-cookies-cssanimations-flexboxtweener-fontface-svg-prefixes-setclasses !*/
!function(e,t,n){function r(e){var t=w.className,n=Modernizr._config.classPrefix||"";if(C&&(t=t.baseVal),Modernizr._config.enableJSClass){var r=new RegExp("(^|\\s)"+n+"no-js(\\s|$)");t=t.replace(r,"$1"+n+"js$2")}Modernizr._config.enableClasses&&(t+=" "+n+e.join(" "+n),C?w.className.baseVal=t:w.className=t)}function o(e,t){return typeof e===t}function s(){var e,t,n,r,s,i,a;for(var l in S)if(S.hasOwnProperty(l)){if(e=[],t=S[l],t.name&&(e.push(t.name.toLowerCase()),t.options&&t.options.aliases&&t.options.aliases.length))for(n=0;n<t.options.aliases.length;n++)e.push(t.options.aliases[n].toLowerCase());for(r=o(t.fn,"function")?t.fn():t.fn,s=0;s<e.length;s++)i=e[s],a=i.split("."),1===a.length?Modernizr[a[0]]=r:(!Modernizr[a[0]]||Modernizr[a[0]]instanceof Boolean||(Modernizr[a[0]]=new Boolean(Modernizr[a[0]])),Modernizr[a[0]][a[1]]=r),x.push((r?"":"no-")+a.join("-"))}}function i(e){return e.replace(/([a-z])-([a-z])/g,function(e,t,n){return t+n.toUpperCase()}).replace(/^-/,"")}function a(){return"function"!=typeof t.createElement?t.createElement(arguments[0]):C?t.createElementNS.call(t,"http://www.w3.org/2000/svg",arguments[0]):t.createElement.apply(t,arguments)}function l(){var e=t.body;return e||(e=a(C?"svg":"body"),e.fake=!0),e}function f(e,n,r,o){var s,i,f,u,c="modernizr",d=a("div"),p=l();if(parseInt(r,10))for(;r--;)f=a("div"),f.id=o?o[r]:c+(r+1),d.appendChild(f);return s=a("style"),s.type="text/css",s.id="s"+c,(p.fake?p:d).appendChild(s),p.appendChild(d),s.styleSheet?s.styleSheet.cssText=e:s.appendChild(t.createTextNode(e)),d.id=c,p.fake&&(p.style.background="",p.style.overflow="hidden",u=w.style.overflow,w.style.overflow="hidden",w.appendChild(p)),i=n(d,e),p.fake?(p.parentNode.removeChild(p),w.style.overflow=u,w.offsetHeight):d.parentNode.removeChild(d),!!i}function u(e,t){return!!~(""+e).indexOf(t)}function c(e,t){return function(){return e.apply(t,arguments)}}function d(e,t,n){var r;for(var s in e)if(e[s]in t)return n===!1?e[s]:(r=t[e[s]],o(r,"function")?c(r,n||t):r);return!1}function p(e){return e.replace(/([A-Z])/g,function(e,t){return"-"+t.toLowerCase()}).replace(/^ms-/,"-ms-")}function m(t,n,r){var o;if("getComputedStyle"in e){o=getComputedStyle.call(e,t,n);var s=e.console;if(null!==o)r&&(o=o.getPropertyValue(r));else if(s){var i=s.error?"error":"log";s[i].call(s,"getComputedStyle returning null, its possible modernizr test results are inaccurate")}}else o=!n&&t.currentStyle&&t.currentStyle[r];return o}function g(t,r){var o=t.length;if("CSS"in e&&"supports"in e.CSS){for(;o--;)if(e.CSS.supports(p(t[o]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var s=[];o--;)s.push("("+p(t[o])+":"+r+")");return s=s.join(" or "),f("@supports ("+s+") { #modernizr { position: absolute; } }",function(e){return"absolute"==m(e,null,"position")})}return n}function v(e,t,r,s){function l(){c&&(delete A.style,delete A.modElem)}if(s=o(s,"undefined")?!1:s,!o(r,"undefined")){var f=g(e,r);if(!o(f,"undefined"))return f}for(var c,d,p,m,v,h=["modernizr","tspan","samp"];!A.style&&h.length;)c=!0,A.modElem=a(h.shift()),A.style=A.modElem.style;for(p=e.length,d=0;p>d;d++)if(m=e[d],v=A.style[m],u(m,"-")&&(m=i(m)),A.style[m]!==n){if(s||o(r,"undefined"))return l(),"pfx"==t?m:!0;try{A.style[m]=r}catch(y){}if(A.style[m]!=v)return l(),"pfx"==t?m:!0}return l(),!1}function h(e,t,n,r,s){var i=e.charAt(0).toUpperCase()+e.slice(1),a=(e+" "+z.join(i+" ")+i).split(" ");return o(t,"string")||o(t,"undefined")?v(a,t,r,s):(a=(e+" "+N.join(i+" ")+i).split(" "),d(a,t,n))}function y(e,t,r){return h(e,n,n,t,r)}var x=[],w=t.documentElement,C="svg"===w.nodeName.toLowerCase(),S=[],b={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,t){var n=this;setTimeout(function(){t(n[e])},0)},addTest:function(e,t,n){S.push({name:e,fn:t,options:n})},addAsyncTest:function(e){S.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=b,Modernizr=new Modernizr,Modernizr.addTest("cookies",function(){try{t.cookie="cookietest=1";var e=-1!=t.cookie.indexOf("cookietest=");return t.cookie="cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT",e}catch(n){return!1}}),Modernizr.addTest("svg",!!t.createElementNS&&!!t.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect);var _=b._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):["",""];b._prefixes=_;var T=b.testStyles=f,k=function(){var e=navigator.userAgent,t=e.match(/w(eb)?osbrowser/gi),n=e.match(/windows phone/gi)&&e.match(/iemobile\/([0-9])+/gi)&&parseFloat(RegExp.$1)>=9;return t||n}();k?Modernizr.addTest("fontface",!1):T('@font-face {font-family:"font";src:url("https://")}',function(e,n){var r=t.getElementById("smodernizr"),o=r.sheet||r.styleSheet,s=o?o.cssRules&&o.cssRules[0]?o.cssRules[0].cssText:o.cssText||"":"",i=/src/i.test(s)&&0===s.indexOf(n.split(" ")[0]);Modernizr.addTest("fontface",i)});var E="Moz O ms Webkit",z=b._config.usePrefixes?E.split(" "):[];b._cssomPrefixes=z;var P=function(t){var r,o=_.length,s=e.CSSRule;if("undefined"==typeof s)return n;if(!t)return!1;if(t=t.replace(/^@/,""),r=t.replace(/-/g,"_").toUpperCase()+"_RULE",r in s)return"@"+t;for(var i=0;o>i;i++){var a=_[i],l=a.toUpperCase()+"_"+r;if(l in s)return"@-"+a.toLowerCase()+"-"+t}return!1};b.atRule=P;var N=b._config.usePrefixes?E.toLowerCase().split(" "):[];b._domPrefixes=N;var R={elem:a("modernizr")};Modernizr._q.push(function(){delete R.elem});var A={style:R.elem.style};Modernizr._q.unshift(function(){delete A.style}),b.testAllProps=h,b.testAllProps=y,Modernizr.addTest("cssanimations",y("animationName","a",!0)),Modernizr.addTest("bgpositionxy",function(){return y("backgroundPositionX","3px",!0)&&y("backgroundPositionY","5px",!0)}),Modernizr.addTest("bgsizecover",y("backgroundSize","cover")),Modernizr.addTest("boxshadow",y("boxShadow","1px 1px",!0)),Modernizr.addTest("flexboxtweener",y("flexAlign","end",!0));var O=b.prefixed=function(e,t,n){return 0===e.indexOf("@")?P(e):(-1!=e.indexOf("-")&&(e=i(e)),t?h(e,t,n):h(e,"pfx"))};Modernizr.addTest("backgroundblendmode",O("backgroundBlendMode","text")),s(),r(x),delete b.addTest,delete b.addAsyncTest;for(var j=0;j<Modernizr._q.length;j++)Modernizr._q[j]();e.Modernizr=Modernizr}(window,document);