@extends('layouts.layout_base')
 
@section('title')
    Tags
@stop


@section('head')
	@parent
    {{ HTML::style('css/lectorRFID.css')}}
@stop

@section('content')

<div>

	
     
      
            
	<div class="row">
		<div class="col-lg-12 col-sm-12">
            <div  id="inventarioetiquetas" class="card hovercard">
                <div class="cardheader inventarioetiquetas"></div>
					<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-info" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
						<span class="sr-only"></span>
						</div>
					</div>
                <div class="avatar">
                    <img id="inventarioetiquetasImg" src="../images/play.jpg">
                </div>
                <div class="info">
                    <div class="title col-lg-12 col-sm-12">
                    <div class="col-lg-8 col-sm-8">Inventario de etiquetas</div>
                    <div class="desc col-lg-4 col-sm-4"><span id="connectionStatus"></span></div></div>                    
                </div>
            </div>
			<table id="tagsLeidos" class="table"> <thead> <tr> <th>#</th> <th>EPC</th> <th>Cantidad</th></tr> </thead> <tbody>  </tbody>
			</table>
		</div>
	</div>
		
	          
              

  
  
    </div>
{{ HTML::script('js/libros/tags.js') }}
@stop