<script>
    window.deleteButtonTrans = '{{ trans("quickadmin.qa_delete_selected") }}';
    window.copyButtonTrans = '{{ trans("quickadmin.qa_copy") }}';
    window.csvButtonTrans = '{{ trans("quickadmin.qa_csv") }}';
    window.excelButtonTrans = '{{ trans("quickadmin.qa_excel") }}';
    window.pdfButtonTrans = '{{ trans("quickadmin.qa_pdf") }}';
    window.printButtonTrans = '{{ trans("quickadmin.qa_print") }}';
    window.colvisButtonTrans = '{{ trans("quickadmin.qa_colvis") }}';
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>

<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ url('adminlte/js') }}/bootstrap.min.js"></script>
<script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
<script src="{{ url('adminlte/js') }}/main.js"></script>

<script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('adminlte/js/app.min.js') }}"></script>
<script>
    window._token = '{{ csrf_token() }}';
</script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/English.json"
        }
    });
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

<script>
(function (u, s, e, r, g) { 
    u[r] = u[r] || [];
    u[r].push({
      'ug.start': new Date().getTime(), event: 'embed.js',
    });
    var f = s.getElementsByTagName(e)[0],
        j = s.createElement(e);
    j.async = true;
    j.src = 'https://static.userguiding.com/media/user-guiding-'
     + g + '-embedded.js';
    f.parentNode.insertBefore(j, f);
})(window, document, 'script', 'userGuidingLayer', '63239968ID');
</script>

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

<!-- start ConvertFox JS code-->
<script>
(function(d,h,w){var convertfox=w.convertfox=w.convertfox||[];convertfox.methods=['trackPageView','identify','track','setAppId'];convertfox.factory=function(t){return function(){var e=Array.prototype.slice.call(arguments);e.unshift(t);convertfox.push(e);return convertfox;}};for(var i=0;i<convertfox.methods.length;i++){var c=convertfox.methods[i];convertfox[c]=convertfox.factory(c)}s=d.createElement('script'),s.src="//d3sjgucddk68ji.cloudfront.net/convertfox.min.js",s.async=!0,e=d.getElementsByTagName(h)[0],e.appendChild(s),s.addEventListener('load',function(e){},!1),convertfox.setAppId("4bp2bv2e"),convertfox.trackPageView()})(document,'head',window);
</script>
<!-- end ConvertFox JS code-->


@yield('javascript')
