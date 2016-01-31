function addEvent( obj, type, fn)
{
	if(obj.addEventListener)
		obj.addEventListener( type, fn, false );
	else if(obj.attachEvent){
		obj['e'+type+fn] = fn;
		obj[type+fn] = function() { obj['e'+type+fn]( window.event ); }
		obj.attachEvent('on'+type, obj[type+fn] );
	}
}
function openMenu(event)
{
	var el, x, y, id;
	id = this.getAttribute('m');
	el = document.getElementById('menu'+id);
	if(window.event) {
		x = window.event.clientX + document.documentElement.scrollLeft
								 + document.body.scrollLeft;
		y = window.event.clientY + document.documentElement.scrollTop +
								 + document.body.scrollTop;
	}
	else {
		x = event.clientX + window.scrollX;
		y = event.clientY + window.scrollY;
	}
	x -= 10;
	y -= 10;
	el.style.left = x + 'px';
	el.style.top  = y + 'px';
	el.style.visibility = 'visible';
	//el.style.display = 'block';
	el.onmouseout = closeMenu;
	event.returnValue = false;
	hideBTooltip();
}
function closeMenu(event)
{
	var current, related;
	if(window.event){
		current = this;
		related = window.event.toElement;
	}
	else{
		current = event.currentTarget;
		related = event.relatedTarget;
	}
	if(current != related && !contains(current, related))
		current.style.visibility = 'hidden';
		//current.style.display = 'none';
}
// Return true if node a contains node b.
function contains(a, b)
{
	if(!b) return true;
	while(b.parentNode)
		if((b = b.parentNode) == a) return true;
	return false;
}
function findPosX(obj)
{
	var curleft = 0;
	if (obj.offsetParent){
		while (obj.offsetParent){
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x) curleft += obj.x;
	return curleft;
}
function findPosY(obj)
{
	var curtop = 0;
	if(obj.offsetParent){
		while(obj.offsetParent){
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y) curtop += obj.y;
	return curtop;
}
function mapInit()
{
	var map_div = document.getElementById('map');
	if(map_div)
	{
		var mapconf = new Array();
		var obj_arr = map_div.getElementsByTagName('div');
		var len = obj_arr.length;
		for(var i=0,mid=0; i<len; i++)
		{
			var el = obj_arr[i];
			if(el.className.indexOf('spot')==-1) continue;
			// menu handler
			addEvent(el,'click', openMenu );
			el.setAttribute('m', mid);
			// over
			addEvent( el, 'mouseover', onMouseOver);
			addEvent( el, 'mouseout', onMouseOut);

			// attach _over on every <tr> in menu table
			var tbl = document.getElementById('menu'+mid);
			if(!tbl || tbl.nodeName.toLowerCase() != 'table') continue;
			var trarr = tbl.getElementsByTagName('tr');
			var trlen = trarr.length;
			for(var k=0; k<trlen; k++)
			{
				addEvent( trarr[k], 'mouseover', _onMouseOver);
				addEvent( trarr[k], 'mouseout', _onMouseOut);
			}
			mid++;
		}
	}
}
function onMouseOver(){ this.className += '_over'; }
function onMouseOut(){ this.className = this.className.replace('_over', ''); }
function _onMouseOver(){ this.style.backgroundColor = '#666666'; }
function _onMouseOut(){ this.style.backgroundColor = ''; }