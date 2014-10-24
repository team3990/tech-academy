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
            <?php echo Form::model(@$progress, array('route' => array('academy.admin.progress.update', $user->id), 'files' => true)); ?>         
            <div class="row">
                <div class="col-xs-12">
                
                			<div class="btn-toolbar" role="toolbar">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-warning" ><i class="fa fa-save fa-fw"></i> Enregistrer la progression</button>
                                </div>
                                <div class="btn-group">
                                    <a href="<?php echo route('academy.admin.progress.index'); ?>" class="btn btn-default"><i class="fa fa-times fa-fw"></i> Annuler</a>
                                </div>
                            </div>
                            
		                    <hr />
		                    <span class="lead">Progression pour <strong><?php echo $user->full_name; ?></strong></span>                    
                </div>
            </div>
            
            <?php foreach ($subjects as $subject) : ?>
            	<div class="row">
            		<div class="col-xs-12">
            			<hr />
            			<h3>
	            			<span class="label label-course"><?php echo $subject->code; ?></span> 
	                        <strong><?php echo $subject->title; ?></strong>
                        </h3>
            		</div>
            	</div>
            	
            					<?php foreach ($subject->tracks as $track) : ?>
                            	
                            		<div class="row">
                            			<div class="col-xs-12">
                            				<p class="lead">
				            					<span class="label label-class"><?php echo $track->number; ?>00</span> 
				            					<?php echo $track->title; ?>
			            					</p>
                            			</div>
                            		</div>
                            		
                            		<div class="row">
                            			<?php foreach ($track->subtracks as $subtrack) : ?>
                            			
                            				<?php 
                            				$panel_type = "panel-default";
                            				switch ($subtrack->level) :
												case 1 :
                            						$panel_type = "panel-level-1";
                            						break;
												case 2 : 
													$panel_type = "panel-level-2";
													break;
												case 3 :
													$panel_type = "panel-level-3";
													break;
												default :
													$panel_type = "panel-default";
                            					endswitch; 
                            				?>
                            				
	                            			<div class="col-sm-4 col-xs-12">
	                            			
	                            				<p>
	                            					<i class="fa fa-circle fa-fw level-<?php echo $subtrack->level; ?> pull-right"></i> 
					            					<span class="label label-class"><?php echo $track->number.$subtrack->number; ?>0</span> 
					            					<strong><?php echo $subtrack->title; ?></strong>
	                            				</p>
	                            				
							            		<div class="panel <?php echo $panel_type; ?>">
							            			<table class="table table-hover small">
							            				<tbody>
							            					<?php foreach ($subtrack->courses as $course) : ?>
							            					<tr<?php echo ($course->is_completed($user->id)) ? ' class="active"' : ''; ?>>
							            						<td>
							            							<?php echo Form::checkbox($course->id, 1, $course->is_completed($user->id)); ?>
							            							<span class="label label-class"><?php echo $course->course_code; ?></span> 
						            								<?php echo $course->title; ?>
						            							</td>
							            					</tr>
							            					<?php endforeach; ?>
							            				</tbody>
							            			</table>
							            		</div>
						            		</div>
				            			<?php endforeach; ?>
			            			</div>
				            		
			            		<?php endforeach; ?>
			            		
            <?php endforeach; ?>
            <?php echo Form::close(); ?>
		    
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
