</div>
	</div>

        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var s = $("#sticker");
				var pos = s.position();                    
				$(window).scroll(function() {
					var windowpos = $(window).scrollTop();
					if (windowpos >= pos.top) {
						s.addClass("stick");
					} else {
						s.removeClass("stick"); 
					}
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				var s = $("#stickerside");
				var pos = s.position();                    
				$(window).scroll(function() {
					var windowpos = $(window).scrollTop();
					if (windowpos >= pos.top) {
						s.addClass("stickside");
					} else {
						s.removeClass("stickside"); 
					}
				});
			});
		</script>
    </body>
</html>
