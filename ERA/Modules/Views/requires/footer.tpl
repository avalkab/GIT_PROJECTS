</div>
</div>
<!-- /.main -->

@mark:html_footer_top@
<!-- .footer -->
<div class="footer container">
<div class="grid">

    <div class="footer-left">
        <a class="footer-logo" href="#"><img src="images/logo.png"></a>
        <h5 class="footer-input-title">En son bonuslardan haberdar olun !</h5>
        <div class="footer-input-container">
            <input class="footer-input" type="text" placeholder="Telefon numaranızı giriniz">
            <input class="footer-btn" type="submit" value="Kayıt Ol">
        </div>
    </div>

    <div class="footer-right">
        <div class="footer-right-list">
            <h6>LOREM IPSUM</h6>
            <ul>
                <li><a href="#">Site Ekle</a></li>
                <li><a href="#">Bonus Ekle</a></li>
                <li><a href="#">Haber Ekle</a></li>
                <li><a href="#">Haberler</a></li>
                <li><a href="#">Son Siteler</a></li>
            </ul>
        </div>
        <div class="footer-right-list">
            <h6>LOREM IPSUM</h6>
            <ul>
                <li><a href="#">İletişim</a></li>
                <li><a href="#">Hakkımızda</a></li>
                <li><a href="#">Bu site de ne?</a></li>
                <li><a href="#">Biz Kimiz</a></li>
                <li><a href="#">Lorem Ipsum</a></li>
            </ul>
        </div>

        <div class="fotoer-socials">
            <h6>BİZİ TAKİP EDİN</h6>
            <ul class="fotoer-socials-list">
                <li><a href="facebook"><img src="images/footer-fb.png"></a></li>
                <li><a href="twitter"><img src="images/footer-gl.png"></a></li>
                <li><a href="google"><img src="images/footer-tt.png"></a></li>
            </ul>
            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
            Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>
        </div>

    </div>

</div>
</div>
<!-- /.footer -->

@mark:html_footer_end@

<script type="text/javascript" src="js/carousel/js/carousel.min.js"></script>
<script type="text/javascript" src="http://www.owlcarousel.owlgraphic.com/assets/owlcarousel/owl.carousel.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".owlCarouselSelector, .owlCarouselSelector").owlCarousel({
      autoPlay: 3000,
      items : 4,
      stopOnHover : true,
      navigation : true,
      pagination : false,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
    });

    /* TABLAR */
    $(".tabContent").hide();
    $(".tabItem.active").each(function(i, d){
        var target = $(this).attr('data-target');
        $(target).show();
    });

    $(".tabItem").on('click', function(){
        var $this = $(this);
        var parent = $this.parent();
        var isActive = $this.hasClass('active') ? true : false;
        var id = $this.attr("data-target");
        var item = $(id);
        if (isActive == false) {
            $(parent).find(".tabItem").removeClass('active');
            $(parent).find(".tabContent").hide();
            $this.addClass('active');
            item.show();
        }
        return false;
    });
    /* TABLAR */

    $(".btn-updown .btn-updownU").on('click', function(){
        var input = $(this).parent().find('input[type=text]');
        var inputInt = parseInt(input.val());
        var newVal = inputInt+1;
        if (newVal>0) {
            input.val('+'+newVal);
        }else if( newVal<0 ) {
            input.val(newVal);
        }else{
            input.val(0);
        }
    });
    $(".btn-updown .btn-updownD").on('click', function(){
        var input = $(this).parent().find('input[type=text]');
        var inputInt = parseInt(input.val());
        var newVal = inputInt-1;
        if (newVal>0) {
            input.val('+'+newVal);
        }else if( newVal<0 ) {
            input.val(newVal);
        }else{
            input.val(0);
        }
    });
});
</script>
@mark:html_body_bot@
</body>
</html>
@mark:html_bot@