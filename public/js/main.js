document.addEventListener('DOMContentLoaded',function() {
	if(document.querySelector('select[name="sort"]')){
    	document.querySelector('select[name="sort"]').onchange=sortThreads;
	}
},false);

function sortThreads(e){
	var v = e.target.value;
	window.location = '/threads?sort=' + v;
}