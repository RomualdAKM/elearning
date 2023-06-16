<!DOCTYPE html>
<html>

<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">

				<title>EdupMe</title>

				<!-- Fonts -->
				<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


				<!-- Favicon -->
				<link rel="shortcut icon" href="assets/images/favicon.ico">

				<!-- Google Font -->
				<link rel="preconnect" href="https://fonts.googleapis.com/">
				<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
				<link
								href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap"
								rel="stylesheet">

				<!-- Plugins CSS -->
				<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
				<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
				<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/choices/css/choices.min.css') }}">
				<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tiny-slider/tiny-slider.css') }}">
				<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/glightbox/css/glightbox.css') }}">
				<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/aos/aos.css') }}">

				<!-- Theme CSS -->
				<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

				<!-- Bootstrap JS -->
				<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

				<!-- Vendors -->
				<script src="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}"></script>
				<script src="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}"></script>
				<script src="{{ asset('assets/vendor/aos/aos.css') }}"></script>

				<script src="{{ asset('assets/vendor/choices/js/choices.min.js') }}"></script>
				<script src="{{ asset('assets/vendor/tiny-slider/tiny-slider.js') }}"></script>
				<script src="{{ asset('assets/vendor/glightbox/js/glightbox.js') }}"></script>
				<script src="{{ asset('assets/vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
				<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>


				<!-- Template Functions -->
				<script src="{{ asset('assets/js/functions.js') }}"></script>

				<!-- Dark Mode -->
		<script>
								const storedTheme = localStorage.getItem('theme')

								const getPreferredTheme = () => {
												if (storedTheme) {
																return storedTheme
												}
												return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
								}

								const setTheme = function(theme) {
												if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
																document.documentElement.setAttribute('data-bs-theme', 'dark')
												} else {
																document.documentElement.setAttribute('data-bs-theme', theme)
												}
								}

								setTheme(getPreferredTheme())

								window.addEventListener('DOMContentLoaded', () => {
												var el = document.querySelector('.theme-icon-active');
												if (el != 'undefined' && el != null) {
																const showActiveTheme = theme => {
																				const activeThemeIcon = document.querySelector('.theme-icon-active use')
																				const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
																				const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

																				document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
																								element.classList.remove('active')
																				})

																				btnToActive.classList.add('active')
																				activeThemeIcon.setAttribute('href', svgOfActiveBtn)
																}

																window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
																				if (storedTheme !== 'light' || storedTheme !== 'dark') {
																								setTheme(getPreferredTheme())
																				}
																})

																showActiveTheme(getPreferredTheme())

																document.querySelectorAll('[data-bs-theme-value]')
																				.forEach(toggle => {
																								toggle.addEventListener('click', () => {
																												const theme = toggle.getAttribute('data-bs-theme-value')
																												localStorage.setItem('theme', theme)
																												setTheme(theme)
																												showActiveTheme(theme)
																								})
																				})

												}
								})
				</script>

				@vite('resources/css/app.css')


</head>

<body class="antialiased">

				<div id="app"></div>

				@vite('resources/js/app.js')
				{{-- <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    --}}
</body>

</html>
