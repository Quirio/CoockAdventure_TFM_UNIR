@extends('layouts.app')

@section('content')
<!--<div class="container">
		<!--<div class="row">-->
				<!--<div class="col-md-3">
						<div class="panel panel-primary">
								<div class="panel-heading"> Estadísticas</div>

								<div class="panel-body">
										<div class="row">
													<div class="col-sm-12 col-md-12">
															<center>
																	<img height="60" width="60" src="/images/gorro1" alt="...">
																	<div class="caption">
																		<h3>Lucía</h3>
																		<h2><span class="label label-primary">15</span></h2>
																		<div class="progress">
																			<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
																				<span class="sr-only">45% Complete</span>
																			</div>
																		</div>
																		<ul class="list-group">
																				<li class="list-group-item">
																					<span class="badge"> 6 </span>
																					Nº Recetas
																				</li>
																			 <li class="list-group-item active"> 
																					Mejor Receta
																			 </li>
																			 <li class="list-group-item">
																					Garbanzas
																			 </li>
																		</ul>
																	</div>
															</center>
													</div>
											</div>     
								</div>
						</div>
				</div>-->
				<div class="col-md-9">
						<div class="panel panel-primary">
								<div class="panel-heading">Últimas Recetas Publicadas</i></div>
														
								<div class="panel-body">

										 @foreach ($RecetasTime as $Receta)
											<div class="row">
													<div class="col-sm-12 col-md-12">

															<div class="thumbnail">
																 <img class="media-object" height="60" width="60" src="/images/gorro" alt="...">
																<div class="caption">
																<center>
																	<h3>Alejandro</h3>
																	</center>
																	<p>

															 
															<div class="thumbnail">
															<center>
																	<h3>{{$Receta->nombreReceta}}</h3>
															</center>
																 
										<center>
											<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
												<ol class="carousel-indicators">
													<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
													@for ($i = 1; $i < $Receta->n_images; $i++)
													<li data-target="#carousel-example-generic" data-slide-to="{{$i}}"></li> 
													@endfor
												</ol>

											<!-- Wrapper for slides -->                  
												<div style="height: 10%" class="carousel-inner" role="listbox">                   
												@for ($i = 0; $i < $Receta->n_images; $i++)
													<?php $active = ""; ?>
													@if ($i == 0)
													 <?php $active = "active"; ?>
												@endif
													<div class="item {{$active}}">
														<a href="/recetas/{{$Receta->cdm}}">
															<img class="img-responsive" style=" width: auto;
																																 height: 225px;
																																 max-height: 225px;"
															src="/images/{{$Receta->cdm}}{{$i}}" alt="...">
														</a>
														<div class="carousel-caption">
														</div>
													</div>
												@endfor
												</div>

												<!-- Controls -->
												<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
													<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
													<span class="sr-only">Previous</span>
												</a>
												<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
													<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
													<span class="sr-only">Next</span>
												</a>
											</div>

											 <a href="/recetas/{{$Receta->cdm}}">
												 <div class="caption">                                    
													 <p><?php echo mb_strimwidth(html_entity_decode($Receta->descripcion), 0, 600, "...");?></p>
														<p>
														 	<a class="btn btn-warning" role="button"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></a>
															<a href="receta/valoracion/positiva/{{$Receta->cdm}}" class="btn btn-success" role="button"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></a>
														 	<a href="receta/valoracion/negativa/{{$Receta->cdm}}" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></a> 
														</p>
												 </div>
											 </a>
								 		</center>
								 </div>
								 </p>
								 </div>
							 </div>

					 </div>
			 </div>                  
	 @endforeach 
		 <center><?php echo $RecetasTime->render(); ?>  </center>  
		 </div> 
 	</div>
 </div>
							 
				</div>
				<div class="col-md-4">           

				</div>
										 
										<!--</form>-->
								</div>
						</div>
				</div>
</div>
@endsection
