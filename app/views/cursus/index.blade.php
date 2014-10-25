@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Cursus et progression
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
				<div class="col-xs-12">
		            <div class="page-header">
		                <h1>
		                	Cursus et progression <br />
		                	<small>Progression des apprentissages pour 
		                	<?php if (Auth::user()->is_mentor) : ?>
		                		<span class="dropdown">
			                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user->full_name; ?> <i class="fa fa-caret-down fa-fw"></i></a>
			                        <ul class="dropdown-menu">
			                        	<?php foreach ($students as $student) : ?>
			                            <li><a href="<?php echo route('academy.cursus.index', $student->id); ?>"><?php echo $student->last_name.', '.$student->first_name; ?></a></li>
			                            <?php endforeach; ?>
			                        </ul>
				                </span>
				            <?php elseif (Auth::user()->is_parent) : ?>
				            	<span class="dropdown">
			                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo (Route::input('id') == NULL) ? 'Veuillez sélectionner votre enfant...' : $user->full_name; ?> <i class="fa fa-caret-down fa-fw"></i></a>
			                        <ul class="dropdown-menu">
			                        	<?php foreach (Auth::user()->children as $child) : ?>
			                            <li><a href="<?php echo route('academy.cursus.index', $child->user->id); ?>"><?php echo $child->user->full_name; ?></a></li>
			                            <?php endforeach; ?>
			                        </ul>
				                </span>
		                	<?php else : ?>
		                		<strong><?php echo $user->full_name; ?></strong>
		                	<?php endif; ?>
		                	</small>
	                	</h1>
		            </div>
				</div>
			</div>
			
			<?php if (!Auth::user()->is_parent && Route::input('id') != NULL) : ?>
			
			<ul class="nav nav-pills">
				<li class="disabled"><a>Choisissez une concentration : </a></li>
				<?php for ($i = count($subjects)-1; $i >= 0; $i--) : ?>
				<li <?php echo ($i == count($subjects)-1) ? ' class="active"' : ''; ?>><a href="<?php echo '#'.$subjects[$i]->code; ?>" data-toggle="tab"><?php echo $subjects[$i]->code; ?></a></li>
				<?php endfor; ?>
			</ul>
			
			<p>&nbsp;</p>
            
            <div class="tab-content">
	            <?php $i = count($subjects)-1; foreach ($subjects as $subject) : ?>
	            	<div class="tab-pane<?php echo ($i == 0) ? ' active' : ''; ?>" id="<?php echo $subject->code; ?>">
			            <div class="row">
			            
			            	<div class="col-sm-4 col-xs-12">
			            	
			            		<h2 style="margin-top: 0">
			            			<span class="label label-course"><?php echo $subject->code; ?></span> <br />
	                            	<small><?php echo $subject->title; ?></small>
                            	</h2>
                            	<p><i class="fa fa-line-chart fa-fw"></i> <?php echo count($subject->tracks); ?> blocs d'apprentissage proposé(s).</p>
                            	<hr />
                            	<p><strong>Légende :</strong></p>
                            	<p>
                            		<i class="fa fa-circle fa-fw level-1"></i> Cours d'introduction <br />
                            		<i class="fa fa-fw"></i> <strong class="small">obligatoires pour tous les élèves</strong><br />
                            		<i class="fa fa-circle fa-fw level-2"></i> Cours avancés<br />
                            		<i class="fa fa-circle fa-fw level-3"></i> Cours experts<br />
                            		<i class="fa fa-circle fa-fw"></i> Cours optionnels et complémentaires
                            	</p>
                            	<p class="text-muted">Peu importe la(les) concentration(s) choisie(s) par l'élève, tous les cours d'introduction de toutes les concentrations sont obligatoires.</p>
                            	<p>
                            		<i class="fa fa-square-o text-muted fa-fw"></i> Cours non complété<br />
                            		<i class="fa fa-check-square-o fa-fw text-success"></i> Cours complété avec succès<br />
                            	</p>
                            	<hr />
                            	<p><strong>Mentor(s) et bénévole(s) enseignant(s) : </strong></p>
                            	<?php foreach ($subject->teachers as $teacher) : ?>
                            		<div class="row">
                            			<div class="col-xs-2 text-center">
                            				<img src="http://www.team3990.com/assets/img/photosEquipe/NoPhoto.jpg" class="img-responsive img-rounded" />
                            			</div>
                            			<div class="col-xs-10">
                            				<strong><?php echo $teacher->full_name; ?></strong><br />
                            				<i class="fa fa-envelope-o fa-fw"></i> <a href="mailto:<?php echo $teacher->email; ?>"><?php echo $teacher->email; ?></a>
                            			</div>
                            		</div>
                            	<?php endforeach; ?>
                            </div>
                            
                            <div class="col-sm-8 col-xs-12">
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
                            				
	                            			<div class="col-sm-6 col-xs-12">
	                            			
	                            				<p>
	                            					<i class="fa fa-circle fa-fw level-<?php echo $subtrack->level; ?> pull-right"></i> 
					            					<span class="label label-class"><?php echo $track->number.$subtrack->number; ?>0</span> 
					            					<strong><?php echo $subtrack->title; ?></strong>
	                            				</p>
	                            				
							            		<div class="panel <?php echo $panel_type; ?>">
							            			<table class="table table-hover">
							            				<tbody>
							            					<?php foreach ($subtrack->courses as $course) : ?>
							            					<tr<?php echo ($course->is_completed($user->id)) ? ' class="active"' : ''; ?>>
							            						<td>
							            							<i class="fa <?php echo ($course->is_completed($user->id)) ? 'fa-check-square-o text-success': 'fa-square-o text-muted'; ?> fa-fw"></i>
							            							<span class="label label-class"><?php echo $course->course_code; ?></span> 
							            							<a href="<?php echo route('academy.courses.view', $course->id); ?>"<?php echo ($course->is_completed($user->id)) ? ' class="text-muted"' : ''; ?>>
							            								<?php echo $course->title; ?>
						            								</a>
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
			            	</div>
			            	
			            </div>
			        </div>
	            <?php $i--; endforeach; ?>
            </div>
            
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
