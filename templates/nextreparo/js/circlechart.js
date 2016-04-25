/* Copyright (C) YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

!function(t,e){
	var i=['<svg class="uk-circlechart" preserveAspectRatio="xMinYMin meet" xmlns="http://www.w3.org/2000/svg">',"<path />",'<circle cx="90" cy="90" r="60"/>','<text x="50%" y="50%"></text>',"</svg>"].join(""),
	r=function(s,c){
		var n=this;

		if(this.element=t(s),this.options=t.extend({},r.defaults,c),!this.element.data("circle")){
			var a=t(i),
			//l=this.options.size,
			l=130,
			h=l/2;
			console.log(l);
			if(this.element.replaceWith(a),navigator.userAgent.match(/AppleWebKit\/(.+?) Version\/(.+?) Safari\//))
				for(var o,p,d,m=0;m<document.styleSheets.length;m++)
					for(var u=document.styleSheets[m].cssRules,f=0;f<u.length;f++)

						if(u[f].type===CSSRule.STYLE_RULE&&u[f].selectorText.match(/uk-circlechart/)&&
							(
								d=u[f].cssText.replace(/\n/g,"").match(/(.+)\{(.+)\}/),
								d&&(
									p=d[2].split(";"),
									o=!1,
									-1!=d[1].indexOf(" path")
									&&
									a.is(t.trim(d[1]).replace(" path",""))
									&&
									(o="path"),
									-1!=d[1].indexOf(" circle")
									&&
									a.is(t.trim(d[1]).replace(" circle",""))
									&&
									(o="circle"),
									-1!=d[1].indexOf(" text")
									&&
									a.is(t.trim(d[1]).replace(" text",""))
									&&
									(o="text"),
									o
								)
							)
						){
							var x=a.find(o);

							p.forEach(function(e){var i=e.split(":");2==i.length&&x.attr(t.trim(i[0]),t.trim(i[1]))})
						}

						this.element=a.attr({width:l,height:l,viewbox:"0 0 "+[l,l].join(" ")}),
						this.circle=this.element.find("circle").attr({cx:h,cy:h,r:h-this.options.border}),
						this.border=this.element.find("path").attr("transform","translate("+[h,h].join(",")+")"),
						this.text=this.element.find("text"),
						this.update(0),
						this.element.on("inview.uk.scrollspy",function(){
							{
								var t=0;!function e(){
									t>100||t>n.options.maxPercent||(n.update(t++),setTimeout(e,20))
								}()
							}
						}),
						this.scrollspy=new e.scrollspy(this.element),
						this.element.data("circle",this)
		}
	};

	t.extend(r.prototype,{
		update:function(t){
			var e=100==t?359.9999:360*(t/100),
			//i=this.options.size/2;
			i=115/2;
			e%=360;
			var r=e*Math.PI/180,
			s=Math.sin(r)*i,
			c=Math.cos(r)*-i,
			n=e>180?1:0,
			a="M 0 0 v -"+i+" A "+i+" "+i+" 0 "+n+" 1 "+s+" "+c+" z";
			this.border.attr("d",a),
			this.text.text(Math.ceil(t)+"%")
		}
	}),
	r.defaults={timerSeconds:5,callback:function(){},timerCurrent:0,showPercentage:!0,maxPercent:100,size:180,border:10},t(document).ready(function(){t("[data-uk-circle-chart]").each(function(){var i,s=t(this);s.data("circle")||(i=new r(s,e.Utils.options(s.attr("data-uk-circle-chart"))))})})
}(jQuery,jQuery.UIkit);
	console.log(document.styleSheets);