<script>
    window.deleteButtonTrans = 'Delete selected';
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>

<!--Old datatables scripts-->
<script src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>

<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>


<!--New combined Datatables Scripts with Bootstrap>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/sl-1.2.6/datatables.min.js"></script>
<!-->

<!--theme scripts-->
<script src="{{ url('adminlte/js') }}/bootstrap.min.js"></script>
<script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
<script src="{{ url('adminlte/js') }}/main.js"></script>
<script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('adminlte/js/app.min.js') }}"></script>
<script>
    window._token = '{{ csrf_token() }}';
</script>

<script>
    $(function(){
        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function() {
             return this.href == url;
        }).parentsUntil('.sidebar-menu > .treeview-menu').addClass('menu-open').css('display', 'block');
    });
</script>

<!--beamer notifications script-->
<script>
	var beamer_config = {
		product_id : "aONXugsr3184", //DO NOT CHANGE: This is your product code on Beamer
		//selector : "selector", /*Optional: Id, class (or list of both) of the HTML element to use as a button*/
		//display : "right", /*Optional: Side on which the Beamer panel will be shown in your site*/
		top: 6, /*Optional: Top position offset for the notification bubble*/
		right: 5, /*Optional: Right position offset for the notification bubble*/
		//button_position: 'bottom-right', /*Optional: Position for the notification button that shows up when the selector parameter is not set*/
		//language: 'EN', /*Optional: Bring news in the language of choice*/
		//filter: 'admin', /*Optional : Bring the news for a certain role as well as all the public news*/
		//lazy: false, /*Optional : true if you want to manually start the script by calling Beamer.init()*/
		//alert : true, /*Optional : false if you don't want to initialize the selector*/
		//callback : your_callback_function, /*Optional : Beamer will call this function, with the number of new features as a parameter, after the initialization*/
		//---------------Visitor Information---------------
		//user_firstname : "firstname", /*Optional : input your user firstname for better statistics*/
		//user_lastname : "lastname", /*Optional : input your user lastname for better statistics*/
		//user_email : "email", /*Optional : input your user email for better statistics*/
	};
</script>
<script type="text/javascript" src="https://app.getbeamer.com/js/beamer-embed.js" defer="defer"></script>
@yield('javascript')
