@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('content')
	<div class="content">
		{{--@include('flash::message')--}}
		<div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box box-primary ">
					<div class="box-body">
						<h3 class="box-title">
							Bienvenido
							<b class="text-primary">{{Auth::user()->name}}</b>
							@usernoops
							<small>No tiene ninguna opción asignada, pida a un administrador que le asigne</small>
							@endusernoops
						</h3>
						@useradmin
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>Dashboard</h1>
							</section>

							<!-- Main content -->
							<section class="content">
								<div class="row">
									<div class="col-lg-3 col-xs-6">
										<!-- small box -->
										<div class="small-box bg-aqua">
											<div class="inner">
												<h3>{{ isset($quantityClients)? $quantityClients:0 }}</h3>
				
												<p>Clientes</p>
											</div>
											<div class="icon">
												<i class="ion ion-bag"></i>
											</div>
											<a href="{{ route('cliente.index')}}" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
									<!-- ./col -->
									<div class="col-lg-3 col-xs-6">
										<!-- small box -->
										<div class="small-box bg-green">
											<div class="inner">
												<h3>{{ isset($quantityProducts)? $quantityProducts:0 }}</h3>
												<p>Productos</p>
											</div>
											<div class="icon">
												<i class="ion ion-stats-bars"></i>
											</div>
											<a href="{{ route('producto.index')}}" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
									<!-- ./col -->
									<div class="col-lg-3 col-xs-6">
										<!-- small box -->
										<div class="small-box bg-yellow">
											<div class="inner">
												<h3>{{ isset($quantityUsers)? $quantityUsers:0 }}</h3>
												<p>Usuarios</p>
											</div>
											<div class="icon">
												<i class="ion ion-person-add"></i>
											</div>
											<a href="{{ route('users.index')}}" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
									<!-- ./col -->
									<div class="col-lg-3 col-xs-6">
										<!-- small box -->
										<div class="small-box bg-red">
											<div class="inner">
												<h3>{{ isset($quantitySales)? $quantitySales :0 }}</h3>
												<p>Ventas</p>
											</div>
											<div class="icon">
												<i class="ion ion-pie-graph"></i>
											</div>
											<a href="{{ route('venta.index')}}" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
									<!-- ./col -->
								</div>
								<!-- /.row -->

							</section>
							<!-- /.content -->

							{{-- <div class="col-md-12">
								<p class="text-center">
								<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
								</p>
			
								<div class="chart">
								<!-- Sales Chart Canvas -->
								
									<canvas id="barChart" style="height:230px"></canvas>
								</div>
								<!-- /.chart-responsive -->
							</div> --}}

							<div class="col-md-12">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title">Informe de resumen mensual</h3>
		
										<div class="box-tools pull-right">
											<select name="year" id="year" class="form-control">
												@foreach($years as $year)
													<option value="{{ $year->year }}">{{ $year->year }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<div class="row">
											<div class="col-md-12">
												<div id="graphSales" style="margin: 0 auto"></div>
											</div>
										</div>
										<!-- /.row -->
									</div>
									<!-- ./box-body -->
								</div>
								<!-- /.box -->
							</div>
						@enduseradmin

					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
@endsection

@section('scripts')

    <script src="{{ asset('bower/highcharts/highcharts.js') }}" type="text/javascript"></script>

    <script>
        $(function () {
            
			let year = (new Date).getFullYear();

			if($("#graphSales").length > 0)
			{
				dataGrafico(year);
			}

			function dataGrafico(year){
				let nameMonth = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

				$.ajax({
					url: "{{url('grafico')}}",
					type: 'POST',
					dataType: 'json',
					data: {year:year, _token:"{{ csrf_token() }}" },
					success: function(data){

						let meses = new Array();
						let monto = new Array();

						$.each(data, function(key,value){
							meses.push(nameMonth[value.mes - 1]);
							let valor = Number(value.monto);
							monto.push(valor);
						});

						graficar(meses,monto,year); // Call funcion Graficar
					},
				});
			}


			function graficar(meses,monto,year)
			{

				Highcharts.chart('graphSales', {
					chart: {
						type: 'column'
					},
					title: {
						text: 'Monto de las ventas por mes'
					},
					subtitle: {
						text: 'Año ' + year
					},
					xAxis: {
						categories: meses,
						crosshair: true
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Monto Acumulado (USD)'
						}
					},
					tooltip: {
						headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
						pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y:.2f} USD</b></td></tr>',
						footerFormat: '</table>',
						shared: true,
						useHTML: true
					},
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0
						},
						series:{
							dataLabels:{
								enabled:true,
								formatter:function(){
									return Highcharts.numberFormat(this.y,2)
								}
							}
						}
					},
					series: [{
						name: 'Meses',
						data: monto

					}]
				});
			}

			// graphData(year);
			
			// function graphData(year)
			// {
			// 	let nameMonth = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

			// 	$.ajax({
			// 		url: "http://127.0.0.1:8000/grafico",
			// 		type: 'POST',
			// 		dataType: 'json',
			// 		data: {year:year, _token:"{{ csrf_token() }}" },
			// 		success: function(data){

			// 			let mounth = new Array();
			// 			let amount = new Array();

			// 			$.each(data, function(key,value){
			// 				//console.log(value);
			// 				mounth.push(nameMonth[value.mes - 1]);
			// 				let total = Number(value.monto);
			// 				amount.push(total);
			// 			});

			// 			drawGraph(mounth,amount,year); // Call funcion Graficar
			// 		},
			// 		error: function(){
			// 			console.log('entry');
			// 		}
			// 	});

			// }
			
			// function drawGraph(mounth, amount, year)
			// {
			// 	console.log(amount);
			// 	var barChartData = {
			// 		labels  : mounth,
			// 		datasets: [
			// 			{
			// 			label               : 'Ventas Por Mes',
			// 			fillColor           : 'rgba(210, 214, 222, 1)',
			// 			strokeColor         : 'rgba(210, 214, 222, 1)',
			// 			pointColor          : 'rgba(210, 214, 222, 1)',
			// 			pointStrokeColor    : '#c1c7d1',
			// 			pointHighlightFill  : '#fff',
			// 			pointHighlightStroke: 'rgba(220,220,220,1)',
			// 			data                : amount
			// 			}
			// 		]
			// 	}

			// 		var barChartOptions = {
			// 			//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
			// 			scaleBeginAtZero        : true,
			// 			//Boolean - Whether grid lines are shown across the chart
			// 			scaleShowGridLines      : true,
			// 			//String - Colour of the grid lines
			// 			scaleGridLineColor      : 'rgba(0,0,0,.05)',
			// 			//Number - Width of the grid lines
			// 			scaleGridLineWidth      : 1,
			// 			//Boolean - Whether to show horizontal lines (except X axis)
			// 			scaleShowHorizontalLines: true,
			// 			//Boolean - Whether to show vertical lines (except Y axis)
			// 			scaleShowVerticalLines  : true,
			// 			//Boolean - If there is a stroke on each bar
			// 			barShowStroke           : true,
			// 			//Number - Pixel width of the bar stroke
			// 			barStrokeWidth          : 2,
			// 			//Number - Spacing between each of the X value sets
			// 			barValueSpacing         : 5,
			// 			//Number - Spacing between data sets within X values
			// 			barDatasetSpacing       : 1,
			// 			//String - A legend template
			// 			legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
			// 			//Boolean - whether to make the chart responsive
			// 			responsive              : true,
			// 			maintainAspectRatio     : true
			// 		}

			// 		var barChartCanvas = $('#barChart').get(0).getContext('2d')
   			// 		var barChart = new Chart(barChartCanvas);

			// 		barChart.Bar(barChartData, barChartOptions)
					
			// }
        })
    </script>
@endsection
