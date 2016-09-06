!function(a,b,c){"use strict";var d=a(b),e=b.document,f=a(e),g=function(){for(var a,b=3,c=e.createElement("div"),d=c.getElementsByTagName("i");c.innerHTML="<!--[if gt IE "+ ++b+"]><i></i><![endif]-->",d[0];);return b>4?b:a}(),h=function(){var a=b.pageXOffset!==c?b.pageXOffset:"CSS1Compat"==e.compatMode?b.document.documentElement.scrollLeft:b.document.body.scrollLeft,d=b.pageYOffset!==c?b.pageYOffset:"CSS1Compat"==e.compatMode?b.document.documentElement.scrollTop:b.document.body.scrollTop;"undefined"==typeof h.x&&(h.x=a,h.y=d),"undefined"==typeof h.distanceX?(h.distanceX=a,h.distanceY=d):(h.distanceX=a-h.x,h.distanceY=d-h.y);var f=h.x-a,g=h.y-d;h.direction=f<0?"right":f>0?"left":g<=0?"down":g>0?"up":"first",h.x=a,h.y=d};d.on("scroll",h),a.fn.style=function(c){if(!c)return null;var d,f=a(this),g=f.clone().css("display","none");g.find("input:radio").attr("name","copy-"+Math.floor(100*Math.random()+1)),f.after(g);var h=function(a,c){var d;return a.currentStyle?d=a.currentStyle[c.replace(/-\w/g,function(a){return a.toUpperCase().replace("-","")})]:b.getComputedStyle&&(d=e.defaultView.getComputedStyle(a,null).getPropertyValue(c)),d=/margin/g.test(c)?parseInt(d)===f[0].offsetLeft?d:"auto":d};return"string"==typeof c?d=h(g[0],c):(d={},a.each(c,function(a,b){d[b]=h(g[0],b)})),g.remove(),d||null},a.fn.extend({hcSticky:function(e){return 0==this.length?this:(this.pluginOptions("hcSticky",{top:0,bottom:0,bottomEnd:0,innerTop:0,innerSticker:null,className:"sticky",wrapperClassName:"wrapper-sticky",stickTo:null,responsive:!0,followScroll:!0,offResolutions:null,onStart:a.noop,onStop:a.noop,on:!0,fn:null},e||{},{reinit:function(){a(this).hcSticky()},stop:function(){a(this).pluginOptions("hcSticky",{on:!1}).each(function(){var b=a(this),c=b.pluginOptions("hcSticky"),d=b.parent("."+c.wrapperClassName),e=b.offset().top-d.offset().top;b.css({position:"absolute",top:e,bottom:"auto",left:"auto",right:"auto"}).removeClass(c.className)})},off:function(){a(this).pluginOptions("hcSticky",{on:!1}).each(function(){var b=a(this),c=b.pluginOptions("hcSticky"),d=b.parent("."+c.wrapperClassName);b.css({position:"relative",top:"auto",bottom:"auto",left:"auto",right:"auto"}).removeClass(c.className),d.css("height","auto")})},on:function(){a(this).each(function(){a(this).pluginOptions("hcSticky",{on:!0,remember:{offsetTop:d.scrollTop()}}).hcSticky()})},destroy:function(){var b=a(this),c=b.pluginOptions("hcSticky"),e=b.parent("."+c.wrapperClassName);b.removeData("hcStickyInit").css({position:e.css("position"),top:e.css("top"),bottom:e.css("bottom"),left:e.css("left"),right:e.css("right")}).removeClass(c.className),d.off("resize",c.fn.resize).off("scroll",c.fn.scroll),b.unwrap()}}),e&&"undefined"!=typeof e.on&&(e.on?this.hcSticky("on"):this.hcSticky("off")),"string"==typeof e?this:this.each(function(){var e=a(this),i=e.pluginOptions("hcSticky"),j=function(){var a=e.parent("."+i.wrapperClassName);return a.length>0&&(a.css({height:e.outerHeight(!0),width:function(){var b=a.style("width");return b.indexOf("%")>=0||"auto"==b?("border-box"==e.css("box-sizing")||"border-box"==e.css("-moz-box-sizing")?e.css("width",a.width()):e.css("width",a.width()-parseInt(e.css("padding-left")-parseInt(e.css("padding-right")))),b):e.outerWidth(!0)}()}),a)}()||function(){var b=e.style(["width","margin-left","left","right","top","bottom","float","display"]),c=e.css("display"),d=a("<div>",{class:i.wrapperClassName}).css({display:c,height:e.outerHeight(!0),width:function(){return b.width.indexOf("%")>=0||"auto"==b.width&&"inline-block"!=c&&"inline"!=c?(e.css("width",parseFloat(e.css("width"))),b.width):"auto"!=b.width||"inline-block"!=c&&"inline"!=c?"auto"==b["margin-left"]?e.outerWidth():e.outerWidth(!0):e.width()}(),margin:b["margin-left"]?"auto":null,position:function(){var a=e.css("position");return"static"==a?"relative":a}(),float:b.float||null,left:b.left,right:b.right,top:b.top,bottom:b.bottom,"vertical-align":"top"});return e.wrap(d),7===g&&0===a("head").find("style#hcsticky-iefix").length&&a('<style id="hcsticky-iefix">.'+i.wrapperClassName+" {zoom: 1;}</style>").appendTo("head"),e.parent()}();if(!e.data("hcStickyInit")){e.data("hcStickyInit",!0);var k=!(!i.stickTo||!("document"==i.stickTo||i.stickTo.nodeType&&9==i.stickTo.nodeType||"object"==typeof i.stickTo&&i.stickTo instanceof("undefined"!=typeof HTMLDocument?HTMLDocument:Document))),l=i.stickTo?k?f:"string"==typeof i.stickTo?a(i.stickTo):i.stickTo:j.parent();e.css({top:"auto",bottom:"auto",left:"auto",right:"auto"}),d.load(function(){e.outerHeight(!0)>l.height()&&(j.css("height",e.outerHeight(!0)),e.hcSticky("reinit"))});var m=function(a){e.hasClass(i.className)||(a=a||{},e.css({position:"fixed",top:a.top||0,left:a.left||j.offset().left}).addClass(i.className),i.onStart.apply(e[0]),j.addClass("sticky-active"))},n=function(a){a=a||{},a.position=a.position||"absolute",a.top=a.top||0,a.left=a.left||0,"fixed"!=e.css("position")&&parseInt(e.css("top"))==a.top||(e.css({position:a.position,top:a.top,left:a.left}).removeClass(i.className),i.onStop.apply(e[0]),j.removeClass("sticky-active"))},o=function(b){if(i.on&&!(e.outerHeight(!0)>=l.height())){var c,f=i.innerSticker?a(i.innerSticker).position().top:i.innerTop?i.innerTop:0,g=j.offset().top,o=l.height()-i.bottomEnd+(k?0:g),p=j.offset().top-i.top+f,q=e.outerHeight(!0)+i.bottom,r=d.height(),s=d.scrollTop(),t=e.offset().top,u=t-s;if("undefined"!=typeof i.remember&&i.remember){var v=t-i.top-f;return void(q-f>r&&i.followScroll?v<s&&s+r<=v+e.height()&&(i.remember=!1):i.remember.offsetTop>v?s<=v&&(m({top:i.top-f}),i.remember=!1):s>=v&&(m({top:i.top-f}),i.remember=!1))}s>p?o+i.bottom-(i.followScroll&&r<q?0:i.top)<=s+q-f-(q-f>r-(p-f)&&i.followScroll&&(c=q-r-f)>0?c:0)?n({top:o-q+i.bottom-g}):q-f>r&&i.followScroll?u+q<=r?"down"==h.direction?m({top:r-q}):u<0&&"fixed"==e.css("position")&&n({top:t-(p+i.top-f)-h.distanceY}):"up"==h.direction&&t>=s+i.top-f?m({top:i.top-f}):"down"==h.direction&&t+q>r&&"fixed"==e.css("position")&&n({top:t-(p+i.top-f)-h.distanceY}):m({top:i.top-f}):n()}},p=!1,q=!1,r=function(){if(t(),s(),i.on){var a=function(){"fixed"==e.css("position")?e.css("left",j.offset().left):e.css("left",0)};if(i.responsive){q||(q=e.clone().attr("style","").css({visibility:"hidden",height:0,overflow:"hidden",paddingTop:0,paddingBottom:0,marginTop:0,marginBottom:0}),j.after(q));var b=j.style("width"),c=q.style("width");"auto"==c&&"auto"!=b&&(c=parseInt(e.css("width"))),c!=b&&j.width(c),p&&clearTimeout(p),p=setTimeout(function(){p=!1,q.remove(),q=!1},250)}if(a(),e.outerWidth(!0)!=j.width()){var d="border-box"==e.css("box-sizing")||"border-box"==e.css("-moz-box-sizing")?j.width():j.width()-parseInt(e.css("padding-left"))-parseInt(e.css("padding-right"));d=d-parseInt(e.css("margin-left"))-parseInt(e.css("margin-right")),e.css("width",d)}}};e.pluginOptions("hcSticky",{fn:{scroll:o,resize:r}});var s=function(){if(i.offResolutions){a.isArray(i.offResolutions)||(i.offResolutions=[i.offResolutions]);var b=!0;a.each(i.offResolutions,function(a,c){c<0?d.width()<c*-1&&(b=!1,e.hcSticky("off")):d.width()>c&&(b=!1,e.hcSticky("off"))}),b&&!i.on&&e.hcSticky("on")}};s(),d.on("resize",r);var t=function(){if(e.outerHeight(!0)<l.height()){var f=!1;a._data(b,"events").scroll!=c&&a.each(a._data(b,"events").scroll,function(a,b){b.handler==i.fn.scroll&&(f=!0)}),f||(i.fn.scroll(!0),d.on("scroll",i.fn.scroll))}};t()}}))}})}(jQuery,this),function(a,b){"use strict";a.fn.extend({pluginOptions:function(c,d,e,f){return this.data(c)||this.data(c,{}),c&&"undefined"==typeof d?this.data(c).options:(e=e||d||{},"object"==typeof e||e===b?this.each(function(){var b=a(this);b.data(c).options?b.data(c,a.extend(b.data(c),{options:a.extend(b.data(c).options,e||{})})):(b.data(c,{options:a.extend(d,e||{})}),f&&(b.data(c).commands=f))}):"string"==typeof e?this.each(function(){a(this).data(c).commands[e].call(this)}):this)}})}(jQuery);