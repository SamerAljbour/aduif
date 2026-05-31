<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="Aduif">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('user/images/aduif-white.png') }}"  style="border-radius:50% "/>

	{{-- <link rel="canonical" href="https://demo-basic.adminkit.io/" /> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<title>Aduif</title>

	<link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<style>
		:root {
			--color-primary: #1B2A4A;
			--color-primary-rgb: 27, 42, 74;
			--color-accent: #4A6FA5;
			--color-accent-rgb: 74, 111, 165;
			--color-accent-light: #6B8FC4;
			--color-accent-light-rgb: 107, 143, 196;
			--color-bg: #F2F4F7;
			--color-surface: #FFFFFF;
			--color-muted: #5A6A85;
			--bs-blue: var(--color-accent);
			--bs-primary: var(--color-accent);
			--bs-primary-rgb: var(--color-accent-rgb);
		}

		html,
		body,
		* {
			font-family: 'Tajawal', sans-serif !important;
		}

		.text-primary,
		.link-primary,
		a {
			color: var(--color-accent);
		}

		a:hover,
		.link-primary:hover,
		.link-primary:focus {
			color: var(--color-accent);
		}

		.bg-primary,
		.badge.bg-primary,
		.progress-bar {
			background-color: var(--color-accent) !important;
		}

		.border-primary {
			border-color: var(--color-primary) !important;
		}

		.btn-primary,
		.btn-primary:disabled {
			background-color: var(--color-accent);
			border-color: var(--color-accent);
			color: var(--color-surface);
		}

		.btn-primary:hover,
		.btn-primary:focus,
		.btn-primary:active {
			background-color: var(--color-accent-light);
			border-color: var(--color-accent-light);
		}

		.btn-outline-primary {
			color: var(--color-primary);
			border-color: var(--color-primary);
		}

		.btn-outline-primary:hover,
		.btn-outline-primary:focus,
		.btn-outline-primary:active {
			background-color: var(--color-primary);
			border-color: var(--color-primary);
			color: var(--color-surface);
		}

		.sidebar,
		.sidebar-content {
			background: var(--color-primary);
		}

		.sidebar-brand,
		.sidebar-brand:hover {
			background: var(--color-primary);
		}

		.sidebar-header {
			color: rgba(255, 255, 255, 0.55);
		}

		.sidebar-link,
		a.sidebar-link,
		.sidebar-link i,
		.sidebar-link svg,
		a.sidebar-link i,
		a.sidebar-link svg {
			color: rgba(255, 255, 255, 0.64);
		}

		.sidebar-link,
		a.sidebar-link {
			border-left-color: transparent;
		}

		.sidebar-link:hover,
		a.sidebar-link:hover {
			background: rgba(255, 255, 255, 0.08);
			color: var(--color-surface);
		}

		.sidebar-link:hover i,
		.sidebar-link:hover svg,
		a.sidebar-link:hover i,
		a.sidebar-link:hover svg {
			color: var(--color-surface);
		}

		.sidebar-item.active .sidebar-link,
		.sidebar-item.active > .sidebar-link,
		.sidebar-item.active .sidebar-link:hover,
		.sidebar-item.active > .sidebar-link:hover {
			background: rgba(255, 255, 255, 0.12);
			border-left-color: transparent;
			color: var(--color-surface);
		}

		.sidebar-item.active .sidebar-link i,
		.sidebar-item.active .sidebar-link svg,
		.sidebar-item.active > .sidebar-link i,
		.sidebar-item.active > .sidebar-link svg {
			color: var(--color-surface);
		}

		.form-control:focus,
		.form-select:focus {
			border-color: var(--color-primary);
			box-shadow: 0 0 0 0.2rem rgba(var(--color-primary-rgb), 0.16);
		}

		p {
			text-align: justify;
			text-align-last: auto;
			text-justify: inter-word;
			hyphens: auto;
		}
	</style>
</head>

<body>
	<div class="wrapper">
        @include('adminLayouts.sidebar')
			<main class="content">
                        @yield('content')

			</main>

                @include('adminLayouts.footer')

		</div>
	</div>
	<script src="{{ asset('admin/js/app.js') }}"></script>
	<script>
		window.theme = window.theme || {};
		window.theme.primary = "#4A6FA5";
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var lineCanvas = document.getElementById("chartjs-dashboard-line");
			if (!lineCanvas) {
				return;
			}

			var lineData = window.dashboardLineData || {
				labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
				values: [0, 0, 0, 0, 0, 0, 0],
				label: "New members"
			};

			var ctx = lineCanvas.getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(27, 42, 74, 0.22)");
			gradient.addColorStop(1, "rgba(27, 42, 74, 0)");
			// Line chart
			new Chart(lineCanvas, {
				type: "line",
				data: {
					labels: lineData.labels,
					datasets: [{
						label: lineData.label,
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: lineData.values
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var pieCanvas = document.getElementById("chartjs-dashboard-pie");
			if (!pieCanvas) {
				return;
			}

			var pieData = window.dashboardPieData || {
				labels: ["Approved", "Pending", "Rejected"],
				values: [0, 0, 0]
			};

			new Chart(pieCanvas, {
				type: "pie",
				data: {
					labels: pieData.labels,
					datasets: [{
						data: pieData.values,
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var barCanvas = document.getElementById("chartjs-dashboard-bar");
			if (!barCanvas) {
				return;
			}

			var barData = window.dashboardBarData || {
				labels: ["Members", "Projects", "Posts", "Join Requests"],
				values: [0, 0, 0, 0]
			};

			new Chart(barCanvas, {
				type: "bar",
				data: {
					labels: barData.labels,
					datasets: [{
						label: "Totals",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: barData.values,
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var mapElement = document.querySelector("#world_map");
			if (!mapElement || typeof jsVectorMap === 'undefined') {
				return;
			}

			var markers = [{
					coords: [31.230391, 121.473701],
					name: "Shanghai"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var pickerElement = document.getElementById("datetimepicker-dashboard");
			if (!pickerElement || typeof flatpickr === 'undefined') {
				return;
			}

			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			pickerElement.flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>

</body>

</html>
