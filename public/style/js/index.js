var mySwiper1 = new Swiper('#head-nav',{
    freeMode : true,
    slidesPerView : 'auto',
    freeModeSticky : true ,
});
$('.tab li').click(function(){
    var index = $(this).index();
     $(this).addClass('on');
     $(this).siblings().removeClass('on')
     $('.part4 .bd ul').eq(index).addClass('show');
     $('.part4 .bd ul').eq(index).siblings().removeClass('show');
})