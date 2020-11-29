@extends('layouts.admin')

@section('title', 'Inicio')

@section('links')
<link href="{{ asset('/admins/vendor/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-xl-5 col-12 mb-3"> 
						<div class="d-flex justify-content-start text-white card-left-radius border-solid border-width-5px border-grey"> 
							<div class="rounded-circle border-solid border-width-5px border-grey">
								<img src="{{ image_exist('/admins/img/', 'logoadmin.png', false, false) }}" class="card-logo-rounded rounded-circle pt-1 px-1" alt="Logo">
							</div>
							<div class="card-logo-text py-2">
								<p class="h5 text-primary font-weight-bold pl-2">Bienvenido:</p>
								<p class="pl-2">Administre toda su empresa de forma simple, fácil, comoda y a medida!</p>
							</div>
						</div>
					</div>

					<div class="col-xl-7 col-12">
						<div class="row">
							<div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-3"> 
								<div class="d-flex justify-content-start text-white card-left-radius border-solid border-width-5px border-grey"> 
									<div class="rounded-circle border-solid border-width-5px border-grey">
										<img src="{{ image_exist('/admins/img/icons/', 'pacientes.png', false, false) }}" class="card-logo-rounded" alt="Noticias">
									</div>
									<div class="py-2 counter-card">
										<p class="h5 font-weight-bold pl-2">Pacientes</p>
										<p class="h3 font-weight-bold text-primary text-center pl-2">{{ $patient }}</p>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-3"> 
								<div class="d-flex justify-content-start text-white card-left-radius border-solid border-width-5px border-grey"> 
									<div class="rounded-circle border-solid border-width-5px border-grey">
										<img src="{{ image_exist('/admins/img/icons/', 'medicos.png', false, false) }}" class="card-logo-rounded" alt="Usuarios">
									</div>
									<div class="py-2 counter-card">
										<p class="h5 font-weight-bold pl-2">Médicos</p>
										<p class="h3 font-weight-bold text-success text-center pl-2">{{ $doctor }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="widget widget-chart-two">
							<div class="widget-heading">
								<h5 class="">Los 5 Servicios más Visitados</h5>
							</div>
							<div class="widget-content">
								<div id="servicesViews" class=""></div>
							</div>
						</div>
					</div>

					<div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="widget widget-chart-one">
							<div class="widget-heading">
								<ul class="tabs tab-pills">
									<li><a href="javascript:void(0);" id="week_tab" class="tabmenu">Semanal</a></li>
									<li><a href="javascript:void(0);" id="month_tab" class="tabmenu">Mensual</a></li>
								</ul>
							</div>

							<div class="widget-content">
								<div class="tabs tab-content" tab="week_tab">
									<div id="content_1" class="tabcontent"> 
										<div id="weeklyViews"></div>
									</div>
								</div>
							</div>

							<div class="widget-content d-none" tab="month_tab">
								<div class="tabs tab-content">
									<div id="content_1" class="tabcontent"> 
										<div id="monthlyViews"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/apex/apexcharts.min.js') }}"></script>
<script type="text/javascript">
	var options = {
		chart: {
			type: 'donut',
			width: 380
		},
		colors: ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'],
		dataLabels: {
			enabled: false
		},
		legend: {
			position: 'bottom',
			horizontalAlign: 'center',
			fontSize: '14px',
			markers: {
				width: 10,
				height: 10,
			},
			itemMargin: {
				horizontal: 0,
				vertical: 8
			}
		},
		plotOptions: {
			pie: {
				donut: {
					size: '65%',
					background: 'transparent',
					labels: {
						show: true,
						name: {
							show: true,
							fontSize: '29px',
							fontFamily: 'Nunito, sans-serif',
							color: undefined,
							offsetY: -10
						},
						value: {
							show: true,
							fontSize: '26px',
							fontFamily: 'Nunito, sans-serif',
							color: '20',
							offsetY: 16,
							formatter: function (val) {
								return val
							}
						},
						total: {
							show: true,
							showAlways: true,
							label: 'Total',
							color: '#888ea8',
							formatter: function (w) {
								return w.globals.seriesTotals.reduce( function(a, b) {
									return a + b
								}, 0)
							}
						}
					}
				}
			}
		},
		stroke: {
			show: true,
			width: 25,
		},
		series: [{{ implode(",", $data['services_values']) }}],
		labels: [{!! $data['services_labels'] !!}],
		responsive: [{
			breakpoint: 1599,
			options: {
				chart: {
					width: '350px',
					height: '400px'
				},
				legend: {
					position: 'bottom'
				}
			},

			breakpoint: 1439,
			options: {
				chart: {
					width: '250px',
					height: '390px'
				},
				legend: {
					position: 'bottom'
				},
				plotOptions: {
					pie: {
						donut: {
							size: '65%',
						}
					}
				}
			},
		}]
	}

	var options1 = {
		chart: {
			fontFamily: 'Nunito, sans-serif',
			height: 365,
			type: 'area',
			zoom: {
				enabled: false
			},
			dropShadow: {
				enabled: true,
				opacity: 0.3,
				blur: 5,
				left: -7,
				top: 22
			},
			toolbar: {
				show: false
			},
			events: {
				mounted: function(ctx, config) {
					const highest1 = ctx.getHighestValueInSeries(0);
					const highest2 = ctx.getHighestValueInSeries(1);

					ctx.addPointAnnotation({
						x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
						y: highest1,
						label: {
							style: {
								cssClass: 'd-none'
							}
						},
						customSVG: {
							SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
							cssClass: undefined,
							offsetX: -8,
							offsetY: 5
						}
					})

					ctx.addPointAnnotation({
						x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
						y: highest2,
						label: {
							style: {
								cssClass: 'd-none'
							}
						},
						customSVG: {
							SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
							cssClass: undefined,
							offsetX: -8,
							offsetY: 5
						}
					})
				},
			}
		},
		colors: ['#1b55e2', '#e7515a'],
		dataLabels: {
			enabled: false
		},
		markers: {
			discrete: [{
				seriesIndex: 0,
				dataPointIndex: 7,
				fillColor: '#000',
				strokeColor: '#000',
				size: 5
			}, {
				seriesIndex: 2,
				dataPointIndex: 11,
				fillColor: '#000',
				strokeColor: '#000',
				size: 4
			}]
		},
		subtitle: {
			text: 'Total',
			align: 'left',
			margin: 0,
			offsetX: -10,
			offsetY: 35,
			floating: false,
			style: {
				fontSize: '14px',
				color:  '#888ea8'
			}
		},
		title: {
			text: 'Visitas Mensuales',
			align: 'left',
			margin: 0,
			offsetX: -10,
			offsetY: 0,
			floating: false,
			style: {
				fontSize: '25px',
				color:  '#0e1726'
			},
		},
		stroke: {
			show: true,
			curve: 'smooth',
			width: 2,
			lineCap: 'square'
		},
		series: [{
			name: 'Visitas Mensuales',
			data: [{{ implode(",", $data['month_values']) }}]
		}],
		labels: [{!! $data['month_year'] !!}],
		xaxis: {
			axisBorder: {
				show: false
			},
			axisTicks: {
				show: false
			},
			crosshairs: {
				show: true
			},
			labels: {
				offsetX: 0,
				offsetY: 5,
				style: {
					fontSize: '12px',
					fontFamily: 'Nunito, sans-serif',
					cssClass: 'apexcharts-xaxis-title',
				},
			}
		},
		yaxis: {
			labels: {
				formatter: function(value, index) {
					return value
				},
				offsetX: -22,
				offsetY: 0,
				style: {
					fontSize: '12px',
					fontFamily: 'Nunito, sans-serif',
					cssClass: 'apexcharts-yaxis-title',
				},
			}
		},
		grid: {
			borderColor: '#e0e6ed',
			strokeDashArray: 5,
			xaxis: {
				lines: {
					show: true
				}
			},   
			yaxis: {
				lines: {
					show: false,
				}
			},
			padding: {
				top: 0,
				right: 0,
				bottom: 0,
				left: -10
			}, 
		}, 
		legend: {
			position: 'top',
			horizontalAlign: 'right',
			offsetY: -50,
			fontSize: '16px',
			fontFamily: 'Nunito, sans-serif',
			markers: {
				width: 10,
				height: 10,
				strokeWidth: 0,
				strokeColor: '#fff',
				fillColors: undefined,
				radius: 12,
				onClick: undefined,
				offsetX: 0,
				offsetY: 0
			},    
			itemMargin: {
				horizontal: 0,
				vertical: 20
			}
		},
		tooltip: {
			theme: 'dark',
			marker: {
				show: true,
			},
			x: {
				show: false,
			}
		},
		fill: {
			type:"gradient",
			gradient: {
				type: "vertical",
				shadeIntensity: 1,
				inverseColors: !1,
				opacityFrom: .28,
				opacityTo: .05,
				stops: [45, 100]
			}
		},
		responsive: [{
			breakpoint: 575,
			options: {
				legend: {
					offsetY: -30,
				},
			},
		}]
	}

	var options2 = {
		chart: {
			fontFamily: 'Nunito, sans-serif',
			height: 365,
			type: 'area',
			zoom: {
				enabled: false
			},
			dropShadow: {
				enabled: true,
				opacity: 0.3,
				blur: 5,
				left: -7,
				top: 22
			},
			toolbar: {
				show: false
			},
			events: {
				mounted: function(ctx, config) {
					const highest1 = ctx.getHighestValueInSeries(0);
					const highest2 = ctx.getHighestValueInSeries(1);

					ctx.addPointAnnotation({
						x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
						y: highest1,
						label: {
							style: {
								cssClass: 'd-none'
							}
						},
						customSVG: {
							SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
							cssClass: undefined,
							offsetX: -8,
							offsetY: 5
						}
					})

					ctx.addPointAnnotation({
						x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
						y: highest2,
						label: {
							style: {
								cssClass: 'd-none'
							}
						},
						customSVG: {
							SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
							cssClass: undefined,
							offsetX: -8,
							offsetY: 5
						}
					})
				},
			}
		},
		colors: ['#1b55e2', '#e7515a'],
		dataLabels: {
			enabled: false
		},
		markers: {
			discrete: [{
				seriesIndex: 0,
				dataPointIndex: 7,
				fillColor: '#000',
				strokeColor: '#000',
				size: 5
			}, {
				seriesIndex: 2,
				dataPointIndex: 11,
				fillColor: '#000',
				strokeColor: '#000',
				size: 4
			}]
		},
		subtitle: {
			text: 'Total',
			align: 'left',
			margin: 0,
			offsetX: -10,
			offsetY: 35,
			floating: false,
			style: {
				fontSize: '14px',
				color:  '#888ea8'
			}
		},
		title: {
			text: 'Visitas Semanales',
			align: 'left',
			margin: 0,
			offsetX: -10,
			offsetY: 0,
			floating: false,
			style: {
				fontSize: '25px',
				color:  '#0e1726'
			},
		},
		stroke: {
			show: true,
			curve: 'smooth',
			width: 2,
			lineCap: 'square'
		},
		series: [{
			name: 'Visitas Semanales',
			data: [{{ implode(",", $data['week_values']) }}]
		}],
		labels: [{!! $data['week_days'] !!}],
		xaxis: {
			axisBorder: {
				show: false
			},
			axisTicks: {
				show: false
			},
			crosshairs: {
				show: true
			},
			labels: {
				offsetX: 0,
				offsetY: 5,
				style: {
					fontSize: '12px',
					fontFamily: 'Nunito, sans-serif',
					cssClass: 'apexcharts-xaxis-title',
				},
			}
		},
		yaxis: {
			labels: {
				formatter: function(value, index) {
					return value
				},
				offsetX: -22,
				offsetY: 0,
				style: {
					fontSize: '12px',
					fontFamily: 'Nunito, sans-serif',
					cssClass: 'apexcharts-yaxis-title',
				},
			}
		},
		grid: {
			borderColor: '#e0e6ed',
			strokeDashArray: 5,
			xaxis: {
				lines: {
					show: true
				}
			},   
			yaxis: {
				lines: {
					show: false,
				}
			},
			padding: {
				top: 0,
				right: 0,
				bottom: 0,
				left: -10
			}, 
		}, 
		legend: {
			position: 'top',
			horizontalAlign: 'right',
			offsetY: -50,
			fontSize: '16px',
			fontFamily: 'Nunito, sans-serif',
			markers: {
				width: 10,
				height: 10,
				strokeWidth: 0,
				strokeColor: '#fff',
				fillColors: undefined,
				radius: 12,
				onClick: undefined,
				offsetX: 0,
				offsetY: 0
			},    
			itemMargin: {
				horizontal: 0,
				vertical: 20
			}
		},
		tooltip: {
			theme: 'dark',
			marker: {
				show: true,
			},
			x: {
				show: false,
			}
		},
		fill: {
			type:"gradient",
			gradient: {
				type: "vertical",
				shadeIntensity: 1,
				inverseColors: !1,
				opacityFrom: .28,
				opacityTo: .05,
				stops: [45, 100]
			}
		},
		responsive: [{
			breakpoint: 575,
			options: {
				legend: {
					offsetY: -30,
				},
			},
		}]
	}

	var services_views = new ApexCharts(document.querySelector("#servicesViews"), options);
	services_views.render();

	var monthly_views = new ApexCharts(document.querySelector("#monthlyViews"), options1);
	monthly_views.render();

	var weekly_views = new ApexCharts(document.querySelector("#weeklyViews"), options2);
	weekly_views.render();
</script>
@endsection