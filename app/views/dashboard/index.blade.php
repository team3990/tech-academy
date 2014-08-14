@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Tableau de bord
        @stop
        
        @section('stylesheets')
			@parent
           	<style type="text/css">
           		body {
           			background-image: url("<?php echo asset('assets/images/bckgrnd.jpg'); ?>");
           			background-repeat:no-repeat;
					background-position: center 20%;
           		}
           	</style>
        @stop
        
        @section('scripts_header')
           	@parent
        @stop
        
    @stop

    {{-- HTML Body Section --}}
    @section('body')
    
        @parent
    
        @section('content')
            <div class="row">
				<div class="col-lg-12">
		            <div class="jumbotron" style="background: none; color: #FFF">
		                <h1>Tech Academy</h1>
		                <p>La plateforme d'apprentissage en ligne et en classe d'Équipe 3990, <em>Tech for Kids</em>.</p>
		                <p><a href="<?php echo route('academy.courses.index'); ?>" class="btn btn-default btn-lg" style="background-color: rgba(255, 255, 255, 0.7)">Consultez la liste des cours <i class="fa fa-arrow-circle-right fa-fw"></i></a></p> 
		            </div>
				</div>
			</div>
            

        @stop
        
    @stop
    
    @section('footer')
        
        @parent 
        
        @section('footer-content')
            
        @stop
    
        @section('scripts_eof')
            @parent
        @stop
        
    @stop
