all_images	=	new Array(
					"slides/about_01.jpg",
					"slides/about_02.jpg",
					"slides/about_03.jpg",
					"slides/about_04.jpg"
				);
var ImgNum		=	0;
var ImgLength	=	all_images.length - 1;
var delay		=	5000;
var lock		=	false;
var run;
function chgImg(direction){
	if(	document.images){
		ImgNum	=	ImgNum + direction;
		if(	ImgNum	>	ImgLength){
			ImgNum	=	0;
		}
		if(	ImgNum	<	0){
			ImgNum	=	ImgLength;
		}
		document.slide_show.src	=	all_images[ImgNum];
	}
}
function auto(){
	if(	lock	==	true){
		lock	=	false;
		window.clearInterval(run);
	}else
		if(	lock	==	false){
			lock	=	true;
			run		=	setInterval("chgImg(1)", delay);
	}
}