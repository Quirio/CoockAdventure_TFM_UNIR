	@extends('layouts.app')

	@section('content')
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="thumbnail">
				<center>
					<h3>{{$Receta->nombreReceta}}</h3>
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
								<img class="img-responsive" style=" width: auto;
								height: 225px;
								max-height: 225px;"
								src="/images/{{$Receta->cdm}}{{$i}}" alt="...">
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
					<div class="caption">                                    
						<p><?php echo html_entity_decode($Receta->descripcion);?></p>
						<p>
							<a class="btn btn-warning" role="button"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></a>
							<a class="btn btn-success" role="button"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></a>
							<a  class="btn btn-danger" role="button"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></a> 
						</p>
					</div>
				</center>
			</div>
		</div>
	</div>                  
	@endsection