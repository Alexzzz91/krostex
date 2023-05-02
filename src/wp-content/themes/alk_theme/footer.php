<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar( 'footer' ); ?>

			<?php 
				$alk_email_text = get_theme_mod('alk_email_text');
				if( !empty($alk_email_text) ):
					echo '<h3 class="featurette-heading">НАШИ КОНТАКТЫ:</h3>';
					echo "<div class='col-md-6 col-sm-6 footer-email '>";
						echo "<p><i class='fa fa-map-marker' aria-hidden='true'></i> Омск, 2-я Солнечная ул., 63</p>";
            echo $alk_email_text;
					echo "</div>";
					echo "<div class='col-md-6  col-sm-6 footer-telefon-menu'>";
						wp_nav_menu( array( 'theme_location' => 'telefon' ) ); 
					echo "</div>";
					else:
					echo "<div class='col-md-12 footer-telefon-menu'>";
						echo "НАШИ КОНТАКТЫ:";
						wp_nav_menu( array( 'theme_location' => 'telefon' ) ); 
					echo "</div>";
				endif;
			?>
			<p class="pull-right">
				<a href="#" style="display:none;" class="back-to-top">
					<span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span>
				</a>
			</p>
			<?php 
				$alk_copyright = get_theme_mod('alk_copyright');
				if( !empty($alk_copyright) ):
					echo '<p id="alk-copyright">'.wp_kses_post($alk_copyright).'</p>';
					else:
					echo '<p id="alk-copyright">© 2016 ООО КРОСТЕКС</a></p>';
				endif;
			?>
		</footer>
	</div><!-- #page -->

	<?php wp_footer(); ?>
<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "Бетон М200",
  "image": "http://krostex-beton.ru/wp-content/uploads/2016/05/Beton-M200-min-300x225.jpg",
  "description": "Бетон М200 является популярным в сфере строительства. Данный вид бетон устойчив к трещинам, не деформируется и быстро твердеет. Подходит для различных видов фундамента, подпорных стен, лестниц, изготовление бордюров, тротуарной плитки, различных арматурных работах.",
  "mpn": "925872",
  "brand": {
    "@type": "Thing",
    "name": "КРОСТЕКС"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "reviewCount": "189"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "Руб",
    "price": "2850",
    "priceValidUntil": "2020-11-05",
    "itemCondition": "http://krostex-beton.ru",
    "availability": "http://krostex-beton.ru",
    "seller": {
      "@type": "Organization",
      "name": "КРОСТЕКС"
    }
  }
}
</script>
<!-- Yandex.Metrika informer -->
<a class="yandex-metrica" href="https://metrika.yandex.ru/stat/?id=37548255&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/37548255/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:37548255,lang:'ru'});return false}catch(e){}" /></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter37548255 = new Ya.Metrika({
                    id:37548255,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/37548255" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
