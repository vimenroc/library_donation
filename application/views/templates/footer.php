        </div>
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

    
    <!-- FastClick -->
    <!-- <script src=" <?= base_url()?>assets/vendors/fastclick/lib/fastclick.js"></script> -->
    <!-- NProgress -->
    <!-- <script src=" <?= base_url()?>assets/vendors/nprogress/nprogress.js"></script> -->
    <!-- Chart.js -->
    <!-- <script src=" <?= base_url()?>assets/vendors/Chart.js/dist/Chart.min.js"></script> -->
    <!-- gauge.js -->
    <!-- <script src=" <?= base_url()?>assets/vendors/gauge.js/dist/gauge.min.js"></script> -->
    <!-- bootstrap-progressbar -->
    <!-- <script src=" <?= base_url()?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> -->
    <!-- iCheck -->
    <!-- <script src=" <?= base_url()?>assets/vendors/iCheck/icheck.min.js"></script> -->
    <!-- Skycons -->
    <!-- <script src=" <?= base_url()?>assets/vendors/skycons/skycons.js"></script> -->
    <!-- Flot -->
    <!-- <script src=" <?= base_url()?>assets/vendors/Flot/jquery.flot.js"></script> -->
    <!-- <script src=" <?= base_url()?>assets/vendors/Flot/jquery.flot.pie.js"></script> -->
    <!-- <script src=" <?= base_url()?>assets/vendors/Flot/jquery.flot.time.js"></script> -->
    <!-- <script src=" <?= base_url()?>assets/vendors/Flot/jquery.flot.stack.js"></script> -->
    <!-- <script src=" <?= base_url()?>assets/vendors/Flot/jquery.flot.resize.js"></script> -->
    <!-- Flot plugins -->
    <!-- <script src=" <?= base_url()?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script> -->
    <!-- <script src=" <?= base_url()?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script> -->
    <!-- <script src=" <?= base_url()?>assets/vendors/flot.curvedlines/curvedLines.js"></script> -->
    <!-- DateJS -->
    <!-- <script src=" <?= base_url()?>assets/vendors/DateJS/build/date.js"></script> -->
    <!-- JQVMap -->
    <!-- <script src=" <?= base_url()?>assets/vendors/jqvmap/dist/jquery.vmap.js"></script> -->
    <!-- <script src=" <?= base_url()?>assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script> -->
    <!-- <script src=" <?= base_url()?>assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js</script> -->
    <!-- bootstrap-daterangepicker -->
    <!-- <script src=" <?= base_url()?>assets/vendors/moment/min/moment.min.js"></script> -->
    <!-- <script src=" <?= base_url()?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js"></script>
    <!-- Custom Theme Scripts -->
    <script src=" <?= base_url()?>assets/build/js/custom.min.js"></script>
    <script>
    $( document ).ready(function() {
        Konami();
    });

    function Konami(){
        var Konami = {};

(function(Konami, window) {
	'use strict';

	/**
	 * Creates an event handler responding to the specified sequence.
	 * @param {...number|function()} arguments
	 * @return {function(Event)}
	 */
	var sequence = Konami.sequence = function() {
		var sequence = Array.prototype.slice.call(arguments),
			state = 0;

		/**
		 * Event handler
		 * @param {Event|number} e
		 */
		return function(e) {
			// patch legacy IE
			e = (e || window.event);
			e = (e.keyCode || e.which || e);

			if (e === sequence[state] || e === sequence[(state = 0)]) {
				// move next and peek
				var action = sequence[++state];

				// sequence complete when a function is reached
				if (typeof action !== 'function') {
					return;
				}

				// fire action
				action();

				// reset when sequence completed
				state = 0;
			}
		};
	};

	/**
	 * Creates an event handler responding to the Konami Code.
	 * @param {function()} action completed sequence callback
	 * @return {function(Event)}
	 */
	Konami.code = function(action) {
		return sequence(38, 38, 40, 40, 37, 39, 37, 39, 66, 65, 13);
	};

})(Konami, window);
    }
    </script>
  </body>
</html>
