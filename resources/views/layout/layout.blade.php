<!doctype html>
<html lang="en">
<head>
    @include('layout.partials.head')
	@stack('styles')
</head>

<body>

{{-- @include('layout.partials.nav') --}}

<main role="main" class="max-w-screen-sm mx-auto flex flex-col h-full mb-6">
	<a href="{{ route('inicio') }}" id="header-logo" class="self-center my-10 w-1/3 sm:w-1/4">
		<img src="{{ asset('images/si-hay-logo.png') }}" alt="Si Hay Logo" />
	</a>
	<div class="flex-grow flex items-center">
		@yield('content')
	</div>
</main><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@include('layout.partials.footer-scripts')
@stack('scripts')
</body>
</html>