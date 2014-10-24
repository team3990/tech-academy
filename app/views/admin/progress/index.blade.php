@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            ADMINISTRATION / Gestion de progression
        @stop
        
        @section('stylesheets')
           @parent
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
		            <div class="page-header">
		                <h1>Administration <small>Gestion des progressions</small></h1>
		            </div>
				</div>
			</div>
            
            <?php if (Auth::user()->is_mentor) : ?>
		    <div class="row">
                <div class="col-xs-12">
                    
                    <?php if (Session::has('update') && Session::get('update') == true) : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Progression enregistrée</h4> La progression a été enregistrée pour <strong><?php echo strip_tags(Session::get('object_name')); ?></strong>.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Courriel</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $user->last_name; ?></td>
                                <td><?php echo $user->first_name; ?></td>
                                <td><?php echo ($user->email != NULL) ? '<i class="fa fa-envelope-o fa-fw"></i> '.HTML::mailto($user->email) : ''; ?></td>
                                <td><?php echo $user->role->title; ?></td>
                                <td><a href="<?php echo route('academy.admin.progress.edit', $user->id); ?>" class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o fa-fw"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
		    
		    <?php else : ?>
		    <div class="row"><div class="col-xs-12"><div class="alert alert-warning text-center">Vous n'avez pas les autorisations nécessaires.</div></div></div>
		    <?php endif; ?>
		    
        @stop
        
    @stop
    
    @section('footer')
        
        @parent 
        
        @section('footer-content')
            @parent
        @stop
    
        @section('scripts_eof')
            @parent
        @stop
        
    @stop
