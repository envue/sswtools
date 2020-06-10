<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>


<body class="hold-transition skin-blue sidebar-mini fixed">

<div id="wrapper">

@include('partials.topbar')
@include('partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            @if(isset($siteTitle))
                <h3 class="page-title">
                    {{ $siteTitle }}
                </h3>
            @endif

            <div class="row">
                <div class="col-md-12">

                    @if (Session::has('message'))
                        <div class="alert alert-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>
        </section>
    </div>
    @include('partials.controlbar')
</div>

{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}

@include('partials.javascripts')
<!-- Disabled Beamer Script 
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
		user_firstname : "{{ Auth::user()->name ?? "unknown" }}", /*Optional : input your user firstname for better statistics*/
		user_lastname : " ", /*Optional : input your user lastname for better statistics*/
		user_email : "{{ Auth::user()->email ?? ""  }}", /*Optional : input your user email for better statistics*/
        user_id : "{{ Auth::user()->id ?? ""  }}",
	};
</script>
<script type="text/javascript" src="https://app.getbeamer.com/js/beamer-embed.js" defer="defer"></script>
-->
</body>
</html>