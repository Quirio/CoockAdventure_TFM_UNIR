@extends('layouts.app')

@section('content')

<div class="container">
    <!--<div class="row">-->
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading"> Estadísticas</div>

                <div class="panel-body">
                    <div class="row">
                          <div class="col-sm-12 col-md-12">
                              <center>
                                  <img src="..." alt="...">
                                  <div class="caption">
                                    <h3>{{Auth::user()->name}}</h3>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                          <span class="badge"> {{$NRecetasUsuario}} </span>
                                          Nº Recetas
                                        </li>
                                       <li class="list-group-item active"> 
                                          Mejor Receta
                                       </li>
                                       <li class="list-group-item">
                                       @if(isset($MejoresRecetas[0]))
                                          {{$MejoresRecetas[0]->nombreReceta}}
                                       @else
                                          No tienes recetas publicadas.
                                       @endif   
                                       </li>
                                    </ul>
                                  </div>
                              </center>
                          </div>
                      </div>     
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading">Últimas Recetas </i></div>
                            
                <div class="panel-body">             
                     @foreach ($RecetasTime as $Receta)
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
	                                     <p><a href="/user/recetas/modify/{{$Receta->cdm}}" class="btn btn-primary" role="button">Modificar</a> <a href="/user/recetas/delete/{{$Receta->cdm}}" class="btn btn-danger" role="button">Eliminar</a> </p>
	                                  </div>
	                              </center>
	                              </div>
                          </div>
                      </div>                  
                  @endforeach 
                   <center><?php echo $RecetasTime->render(); ?>  </center>   
                </div>
            </div>
             <div class="panel panel-primary">
                <div class="panel-heading">Mejores Recetas</div>
                  
                <div class="panel-body">            
                     @foreach ($MejoresRecetas as $Receta)
                      <div class="row">
                          <div class="col-sm-12 col-md-12">
                              <div class="thumbnail">
                                <center>
                                  <h3>{{$Receta->nombreReceta}}</h3>
                                  <img src="..." alt="...">
                                  <div class="caption">                                    
                                    <p><?php echo html_entity_decode($Receta->descripcion);?></p>
                                     <p><a href="/user/recetas/modify/{{$Receta->cdm}}" class="btn btn-primary" role="button">Modificar</a> <a href="/user/recetas/delete/{{$Receta->cdm}}" class="btn btn-danger" role="button">Eliminar</a> </p>
                                  </div>                              
                                </center>
                              </div>
                          </div>
                      </div>                  
                  @endforeach
                </div>
            </div>

             <div class="panel panel-primary">
                <div class="panel-heading">Buscar Recetas</div>

                <div class="panel-body">
                   
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                @if(isset($modifyCdm))
                    <div class="panel-heading">Modificar Receta </i></div>
                    {!! Form::open(array('url'=>'/user/recetas/modify/done/'.$modifyCdm,'method'=>'POST', 'files'=>true)) !!}                    
                @else
                    <div class="panel-heading">Receta Nueva </i></div>
                   <!--<form class="form-horizontal" role="form" action="recetas/crear" method="post">-->
                     {!! Form::open(array('url'=>'user/recetas/crear','method'=>'POST', 'files'=>true)) !!}
                @endif
                   <div class="col-md-12" style="padding:5%">
                       
                          <div class="form-group @if ($errors->has('nombre')) has-error @endif">
                              <div class="col-sm-12">
                                <input type="text" value="<?php if(isset($modifyCdm)) echo $recetaToModify[0]->nombreReceta; ?>" placeholder="Nombre" class="form-control" id="nombre" name="nombre">
                                @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
                              </div>
                          </div>
                          <div class="form-group @if ($errors->has('descripcion')) has-error @endif">
                              <div class="col-sm-12"> 
                                <span>Descripción de receta</span><br>
                                <textarea class="ckeditor" id="descripcion" name="descripcion" placeholder="Descripción de receta"><?php if(isset($modifyCdm)) echo $recetaToModify[0]->descripcion; ?></textarea>
                                @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-10"> 
                                  <span>Tipo de receta</span><br>
                                  <select class="selectpicker" id="tipo" name="tipo">
                                      @foreach ($tipos as $tipo)
                                         <option  class="<?php if(isset($modifyCdm) && $tipo->id == $recetaToModify[0]->id_TipoReceta) echo 'selected';?>" value="{{$tipo->nombre_tipo}}">{{$tipo->nombre_tipo}}</option>
                                      @endforeach
                                  </select>                                
                              </div>
                          </div>
                          <div class="form-group @if ($errors->has('coccion')) has-error @endif">
                              <div class="col-sm-12">
                                <span>Introduce metodo de cocción/herramientas usadas para cocinar</span><br>
                                <input type="text" id="coccion" name="coccion" value="Horno,microondas" data-role="tagsinput" />
                                @if ($errors->has('coccion')) <p class="help-block">{{ $errors->first('coccion') }}</p> @endif
                              </div>
                          </div>
                          <div class="form-group @if ($errors->has('ingredientes')) has-error @endif">
                              <div class="col-sm-12"> 
                                <span>Introduce lista de ingredientes usados para cocinar</span><br>
                                <input type="text" id="ingredientes" name="ingredientes"  value="Pollo,Maíz" data-role="tagsinput" />
                                @if ($errors->has('ingredientes')) <p class="help-block">{{ $errors->first('ingredientes') }}</p> @endif
                              </div>
                          </div>  
                           <div class="form-group @if ($errors->has('images')) has-error @endif">
                              <div class="col-sm-12"> 
                              	<span>Selecciona al menos una imágen de tu receta.</span>
                               	{!! Form::file('images[]', array('multiple'=>true)) !!}
                                   @if ($errors->has('images')) <p class="help-block">{{ $errors->first('images') }}</p> @endif
                              </div>
                          </div> 
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">                       
                        
                        @if(isset($modifyCdm))
                        <div class="form-group"> 
                          <div class="col-sm-offset-2 col-sm-10">
                            <center><button type="submit" class="btn btn-primary">Modificar Receta</button></center>
                            <center><a href="/user/recetas" class="btn btn-primary">Cancelar</a></center>
                          </div>
                        </div>
                        @else
                         <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                               <center><button type="submit" class="btn btn-primary">Crear Tu Receta</button></center>
                            </div>
                          </div>
                        @endif

             </div>
                      {!! Form::close() !!}
                      @if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
                    <!--</form>-->
                </div>
            </div>
        </div>

    <!--<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Dropdown
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul></div>-->
</div>
@endsection
