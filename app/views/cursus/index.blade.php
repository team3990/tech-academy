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
		                <h1>Cursus et progression <small>Progression des apprentissages académiques</small></h1>
		            </div>
				</div>
			</div>
			
			<ul class="nav nav-pills">
				<li class="disabled"><a>Choisissez un sujet d'étude : </a></li>
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
                            	<p><i class="fa fa-line-chart fa-fw"></i> <?php echo count($subject->tracks); ?> parcours proposé(s).</p>
                            	<hr />
                            	<p><strong>Légende :</strong></p>
                            	<p>
                            		<i class="fa fa-square fa-fw level-1"></i> Cours de 1re année (obligatoires pour tous les élèves)<br />
                            		<i class="fa fa-square fa-fw level-2"></i> Cours de 2e année<br />
                            		<i class="fa fa-square fa-fw level-3"></i> Cours de 3e année<br />
                            		<i class="fa fa-square fa-fw"></i> Cours optionnels et complémentaires
                            	</p>
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
	                            					<i class="fa fa-square fa-fw level-<?php echo $subtrack->level; ?> pull-right"></i> 
					            					<span class="label label-class"><?php echo $track->number.$subtrack->number; ?>0</span> 
					            					<strong><?php echo $subtrack->title; ?></strong>
	                            				</p>
	                            				
							            		<div class="panel <?php echo $panel_type; ?>">
							            			<table class="table table-hover">
							            				<tbody>
							            					<?php foreach ($subtrack->courses as $course) : ?>
							            					<tr>
							            						<td>
							            							<span class="label label-class"><?php echo $course->course_code; ?></span> 
							            							<a href="<?php echo route('academy.courses.view', $course->id); ?>">
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
