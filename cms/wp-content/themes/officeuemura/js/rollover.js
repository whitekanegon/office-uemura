//menu
$(function()
{
		var targetImgs = $('img');
		
		targetImgs.each(function()
		{
			if(this.src.match('_off'))
			{
				
				this.rollOverImg = new Image();
				this.rollOverImg.src = this.getAttribute("src").replace("_off", "_on");
				$(this.rollOverImg).css({position: 'absolute', opacity: 0});
				$(this).before(this.rollOverImg);
				
				$(this.rollOverImg).mousedown(function(){
					$(this).stop().animate({opacity: 0}, {duration: 0, queue: false});
				});
				
				$(this.rollOverImg).hover(function(){
					$(this).animate({opacity: 1}, {duration: 200, queue: false});
				},
				function(){
					$(this).animate({opacity: 0}, {duration: 200, queue: false});
				});
				
			}
		});
});



//スクロールしたらトップに戻るボタン
if(!navigator.userAgent.match(/(iPhone|Android)/)){
$(function() {
	var showFlag = false;
	var topBtn = $('#page-top');	
	topBtn.css('bottom', '-150px');
	var showFlag = false;
	//スクロールが100に達したらボタン表示
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			if (showFlag == false) {
				showFlag = true;
				topBtn.stop().animate({'bottom' : '0px'}, 200); 
			}
		} else {
			if (showFlag) {
				showFlag = false;
				topBtn.stop().animate({'bottom' : '-150px'}, 200); 
			}
		}
	});
	//スクロールしてトップ
    topBtn.click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
    });
});

document.write('<a href="#header" id="page-top"><img src="/cms/wp-content/themes/officeuemura/img/pagetop.png" /></a>');
}