$(document).ready(function(){
	/*$('#accordion').accordion({heightStyle: "content", activate:heightDivs });*/
	setTimeout(heightDivs, 500);
});

var counter = 0;

function heightDivs(){
if (counter === 0){
	var heightContainer = $('#container').height();
	var heightMenu = $('#menu').innerHeight();
	var heightContent = $('#content').innerHeight();
	var heightMedia = $('#media').innerHeight();	
	
	if (heightMedia < heightContent){
		$('#media').css('height', heightContainer + "px");
	}
	if (heightMenu < heightContent){
//		$('#menu').css('height', heightContainer + "px");
		$('#menu').height(heightContent);
	}
	
	console.log(heightContainer);
	console.log(heightMenu);
	console.log(heightContent);
	console.log(heightMedia);
	counter = 1;
	}
}