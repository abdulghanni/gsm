<!-- start: FIRST SECTION -->
<div class="container-fluid container-fullw padding-bottom-10">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="panel panel-white no-radius">
						<!--
						<div class="panel-heading border-light">
							<h4 class="panel-title"> Acquisition </h4>
						</div>
						-->
						<div class="panel-body">
							<div class="row">
								<div class="col-md-7 col-lg-8">
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-white no-radius">
												<div class="panel-body padding-20 text-center">
													<div class="col-md-6 text-center">
														<h4 class="text-dark no-margin">Purchase Order</h4>
														<h6 class="text-dark no-margin">Today</h6>
														<!--<h6 class="no-margin"><small>Rp.</small>1,450,000.00</h6>-->
														<span class="badge badge-success margin-top-10"><?=$num_data_po?> P.O</span>
													</div>
													<div class="col-md-6 text-center">
														<h4 class="text-dark no-margin">Penerimaan</h4>
														<h6 class="text-dark no-margin">Today</h6>
														<!--<h6 class="no-margin"><small>Rp.</small>2,250,000.00</h6>-->
														<span class="badge badge-success margin-top-10"><?=$num_data_pembelian?> Penerimaan</span>
													</div>
													<div class="height-350">
														<canvas id="chart1" class="full-width"></canvas>
														<div class="margin-top-20">
															<div class="inline pull-left">
																<div id="chartPoLegend" class="chart-legend"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-5 col-lg-4">
									<div class="panel panel-white no-radius">
										<div class="panel-heading border-light">
											<h4 class="panel-title"> Info Stok </h4>
										</div>
										<div class="panel-body">
											<h3 class="inline-block no-margin"><?=$num_stok?></h3> Total Jenis Barang
											<div class="progress progress-xs no-radius">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
													<span class="sr-only"> 100% Complete</span>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<h4 class="no-margin"><?=$num_stok_tersedia?></h4>
													<div class="progress progress-xs no-radius no-margin">
														<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
															<span class="sr-only"> 100% Complete</span>
														</div>
													</div>
													Stok jenis barang tersedia
												</div>
												<div class="col-sm-6">
													<h4 class="no-margin"><?=$num_stok_minimum?></h4>
													<div class="progress progress-xs no-radius no-margin">
														<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
															<span class="sr-only"> 100% Complete</span>
														</div>
													</div>
													Stok Barang Dibawah Minimum
												</div>
											</div>
											<div class="row margin-top-30">
												<div class="col-xs-4 text-center">
													<div class="rate">
														<span class="value">26</span><span class="percentage">%</span>
													</div>
													Barang Jadi
												</div>
												<div class="col-xs-4 text-center">
													<div class="rate">
														<span class="value">62</span><span class="percentage">%</span>
													</div>
													Barang Mentah
												</div>
												<div class="col-xs-4 text-center">
													<div class="rate">
														<span class="value">12</span><span class="percentage">%</span>
													</div>
													Barang Inventaris
												</div>
											</div>
											<div class="margin-top-10">
												<div class="height-180">
													<canvas id="chart2" class="full-width"></canvas>
													<div class="inline pull-left legend-xs">
														<div id="chart2Legend" class="chart-legend"></div>
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
				<!-- E.O DASHBOARD PURCHASING -->

				<!-- DASHBOARD BUAT MARKETING -->
				<div class="col-md-12 col-lg-12">
					<div class="panel panel-white no-radius">
						<!--
						<div class="panel-heading border-light">
							<h4 class="panel-title"> Acquisition </h4>
						</div>
						-->
						<div class="panel-body">
							<div class="row">
								<div class="col-md-7 col-lg-8">
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-white no-radius">
												<div class="panel-body padding-20 text-center">
													<div class="col-md-4 text-center">
														<h4 class="text-dark no-margin">Sales Order</h4>
														<h6 class="text-dark no-margin">Today</h6>
														<!--<h6 class="no-margin"><small>Rp.</small>2,450,000.00</h6>-->
														<span class="badge badge-success margin-top-10"><?=$num_data_so?> S.O</span>
													</div>
													<div class="col-md-4 text-center">
														<h4 class="text-dark no-margin">Pengeluaran</h4>
														<h6 class="text-dark no-margin">Today</h6>
														<!--<h6 class="no-margin"><small>Rp.</small>2,450,000.00</h6>-->
														<span class="badge badge-success margin-top-10"><?=$num_data_pengeluaran?> Pengeluaran</span>
													</div>
													<div class="col-md-4 text-center">
														<h4 class="text-dark no-margin">Invoicing</h4>
														<h6 class="text-dark no-margin">Today</h6>
														<!--<h6 class="no-margin"><small>Rp.</small>2,950,000.00</h6>-->
														<span class="badge badge-success margin-top-10"><?=$num_data_penjualan?> Penjualan</span>
													</div>
													<div class="height-350">
														<canvas id="chartSo" class="full-width"></canvas>
														<div class="margin-top-20">
															<div class="inline pull-left">
																<div id="chartSoLegend" class="chart-legend"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-5 col-lg-4">
									<div class="panel panel-white no-radius">
										<div class="panel-heading border-light">
											<h4 class="panel-title"> Info Stok </h4>
										</div>
										<div class="panel-body">
											<h3 class="inline-block no-margin"><?=$num_stok?></h3> Total Jenis Barang
											<div class="progress progress-xs no-radius">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
													<span class="sr-only"> 100% Complete</span>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<h4 class="no-margin"><?=$num_stok_tersedia?></h4>
													<div class="progress progress-xs no-radius no-margin">
														<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
															<span class="sr-only"> 100% Complete</span>
														</div>
													</div>
													Stok jenis barang tersedia
												</div>
												<div class="col-sm-6">
													<h4 class="no-margin"><?=$num_stok_minimum?></h4>
													<div class="progress progress-xs no-radius no-margin">
														<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
															<span class="sr-only"> 100% Complete</span>
														</div>
													</div>
													Stok Barang Dibawah Minimum
												</div>
											</div>
											<div class="row margin-top-30">
												<div class="col-xs-4 text-center">
													<div class="rate">
														<span class="value">26</span><span class="percentage">%</span>
													</div>
													Barang Jadi
												</div>
												<div class="col-xs-4 text-center">
													<div class="rate">
														<span class="value">62</span><span class="percentage">%</span>
													</div>
													Barang Mentah
												</div>
												<div class="col-xs-4 text-center">
													<div class="rate">
														<span class="value">12</span><span class="percentage">%</span>
													</div>
													Barang Inventaris
												</div>
											</div>
											<div class="margin-top-10">
												<div class="height-180">
													<canvas id="chart2" class="full-width"></canvas>
													<div class="inline pull-left legend-xs">
														<div id="chart2Legend" class="chart-legend"></div>
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
				<!-- E.O DASHBOARD MARKETING -->

				<!-- DASHBOARD BUAT LOGISTIK -->
				<div class="col-md-12 col-lg-12">
					<div class="panel panel-white no-radius">
						<!--
						<div class="panel-heading border-light">
							<h4 class="panel-title"> Acquisition </h4>
						</div>
						-->
						<div class="panel-body">
							<div class="row">
								<div class="col-md-7 col-lg-8">
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-white no-radius">
												<div class="panel-body padding-20 text-center">
													<div class="col-md-6 text-center">
														<h4 class="text-dark no-margin">Penerimaan Stok</h4>
														<h6 class="text-dark no-margin">Today</h6>
														<!--<h6 class="no-margin"><small>Rp.</small>2,450,000.00</h6>-->
														<span class="badge badge-success margin-top-10"><?=$num_data_penerimaan?> Penerimaan Stok</span>
													</div>
													<div class="col-md-6 text-center">
														<h4 class="text-dark no-margin">Pengeluaran Stok</h4>
														<h6 class="text-dark no-margin">Today</h6>
														<!--<h6 class="no-margin"><small>Rp.</small>2,950,000.00</h6>-->
														<span class="badge badge-success margin-top-10"><?=$num_data_pengeluaran?> Pengeluaran Stok</span>
													</div>
													<div class="height-350">
														<canvas id="chartStok" class="full-width"></canvas>
														<div class="margin-top-20">
															<div class="inline pull-left">
																<div id="chartStokLegend" class="chart-legend"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-5 col-lg-4">
									<div class="panel panel-white no-radius">
										<div class="panel-heading border-light">
											<h4 class="panel-title"> Info Stok </h4>
										</div>
										<div class="panel-body">
											<h3 class="inline-block no-margin"><?=$num_stok?></h3> Total Jenis Barang
											<div class="progress progress-xs no-radius">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
													<span class="sr-only"> 100% Complete</span>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<h4 class="no-margin"><?=$num_stok_tersedia?></h4>
													<div class="progress progress-xs no-radius no-margin">
														<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
															<span class="sr-only"> 100% Complete</span>
														</div>
													</div>
													Stok jenis barang tersedia
												</div>
												<div class="col-sm-6">
													<h4 class="no-margin"><?=$num_stok_minimum?></h4>
													<div class="progress progress-xs no-radius no-margin">
														<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
															<span class="sr-only"> 100% Complete</span>
														</div>
													</div>
													Stok Barang Dibawah Minimum
												</div>
											</div>
											<div class="row margin-top-30">
												<div class="col-xs-4 text-center">
													<div class="rate">
														<span class="value">26</span><span class="percentage">%</span>
													</div>
													Barang Jadi
												</div>
												<div class="col-xs-4 text-center">
													<div class="rate">
														<span class="value">62</span><span class="percentage">%</span>
													</div>
													Barang Mentah
												</div>
												<div class="col-xs-4 text-center">
													<div class="rate">
														<span class="value">12</span><span class="percentage">%</span>
													</div>
													Barang Inventaris
												</div>
											</div>
											<div class="margin-top-10">
												<div class="height-180">
													<canvas id="chart2" class="full-width"></canvas>
													<div class="inline pull-left legend-xs">
														<div id="chart2Legend" class="chart-legend"></div>
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
				<!-- E.O DASHBOARD LOGISTIK -->

				<div class="col-md-12 col-lg-12">
					<div class="panel panel-white no-radius" id="">
						<div class="panel-heading border-light">
						<div class="panel-body">
							<h4 class="panel-title"> Utang-Piutang </h4>
							<div class="margin-top-10">
								<div class="height-250">
									<canvas id="chartUt" class="full-width"></canvas>
									<div class="inline pull-left legend-xs">
										<div id="chartUtLegend" class="chart-legend"></div>
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
</div>
<!-- end: FIRST SECTION -->

						
						
						