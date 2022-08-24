document.addEventListener('DOMContentLoaded', function() {
    const hero = new HeroSlider();
});


class HeroSlider {
    constructor() {
        this.Swiper = new Swiper('.swiper', {
            loop: true,  
            grabCursor: true, //ポインタが手になる
            effect: 'fade',
            centeredSlideres: true,  //中央ぞろえ
            slidersPerView: 1, 
            speed: 3000,  //3sかけて動く
            autoplay: {
                delay: 3000,  //3s後に変わる
                disableOnInteraction: false  //自分で動かしても、また動く
            }
          });

    }
}
