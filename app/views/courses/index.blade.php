@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Cours
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
		                <h1>Cours <small>Liste des cours disponibles</small></h1>
		            </div>
				</div>
			</div>
            
            <?php if (Auth::check()) : ?>
            <div class="row">
		    	<div class="btn-toolbar">
		        	<div class="btn-group">
		                <a class="btn disabled">Filtrer par : </a>
		            </div>
		            <div class="btn-group">
		                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		                    <?php if (Route::input('id') == NULL) : ?>
		                    	Tous les cours
							<?php else : ?>
								<i class="fa fa-check-square-o fa-fw"></i> 
	                            <span class="label label-course"><?php echo $selected_subject->code; ?></span> 
	                            <?php echo $selected_subject->title; ?>
                            <?php endif; ?> <span class="caret"></span>
		                </button>
		                <ul class="dropdown-menu">
		                    <li><a href="<?php echo route('academy.courses.index'); ?>">Tous les cours</a></li>
		                    <?php if (count($subjects) > 0) : ?>
			                    <li class="divider"></li>
			                    <li class="dropdown-header">Sujets d'étude</li>
			                    <?php foreach ($subjects as $subject) : ?>
			                        <li<?php echo ($subject->id == Route::input('id')) ? ' class="active active-warning"' : ''; ?>>
			                            <a href="<?php echo route('academy.courses.index', $subject->id); ?>">
			                            <i class="fa <?php echo ($subject->id == Route::input('id')) ? 'fa-check-square-o' : 'fa-square-o'; ?> fa-fw"></i> 
			                            <span class="label label-course"><?php echo $subject->code; ?></span> 
			                            <?php echo $subject->title; ?>
			                            </a>
			                        </li>
		                        <?php endforeach; ?>
		                    <?php endif; ?>
		                </ul>
		            </div>
		        	<div class="btn-group">
		                <a class="btn disabled"><?php echo $ItemsCount; ?> cours disponible(s)</a>
		            </div>
				</div>
			</div>
			<?php endif; ?>
			
			<div class="row">
		    	<div class="col-lg-12">
		    		<?php if (!isset($courses)) $courses = $selected_subject->courses; ?>
					<?php if (count($courses) > 0) : ?>
		                <?php $i = 0; foreach ($courses as $course) : ?>
		                
		                    <?php // create new row if 4 boxes
		                    if ($i % 3 == 0 && $i != 0) : ?>
		            		</div>
		                    <?php endif; ?>
		            
		                    <?php // create new row if 4 boxes
		                    if ($i % 3 == 0) : ?>
		            		<div class="row">
		                    <?php endif; ?>
		                    
		                <div class="col-lg-4">
		                    <div class="panel panel-default panel-level-<?php echo $course->subtrack->level; ?>">
		                    
		                        <div class="panel-body<?php echo ($course->is_completed()) ? ' panel-completed' : ''; ?>">
		                        
		                        	<i class="fa fa-circle fa-fw level-<?php echo $course->subtrack->level; ?> pull-right"></i>
		                            <span class="label label-course"><?php echo $course->subject_code; ?></span>
		                            <span class="label label-class"><?php echo $course->course_code; ?></span> 
		                            <a href="<?php echo route('academy.courses.view', $course->id); ?>">
		                            <strong><?php echo $course->title; ?></strong>
		                            </a>
		                            
		                            <div class="small text-muted" style="margin-top: 10px">
		                            
			                            <?php if (count($course->teachers) > 0) : ?>
			                            	<i class="fa fa-graduation-cap fa-fw pull-left"></i> 
			                            	<div style="margin-left: 20px">
			                            	<?php 
			                            	$j = 0; 
			                            	foreach ($course->teachers as $teacher) 
			                            	{
			                            		echo $teacher->full_name;
			                            		if ($j == count($course->teachers) - 2) echo ' et ';
			                            		if ($j != count($course->teachers) - 2 && $j != count($course->teachers) - 1) echo ', ';
			                            		$j++;
			                            	}
			                            	?>
			                            	</div>
			                            <?php endif; ?>
			                            
			                            <i class="fa fa-info-circle fa-fw pull-left" style="margin-top: 2px"></i> 
			                            <div style="margin-left: 20px"><?php echo $course->type->title; ?></div>
		                            
		                            </div>
	                        	
	                        	</div>
		                        
		                    </div>
		                </div>
		                    
	                    <?php $i++; endforeach; ?>
		            <?php else : ?>
		            <div class="alert alert-warning text-center">
		                <p>Aucun cours disponible pour le moment.</p>
		                <p>Aidez-nous à en créer un!</p>
		            </div>
	                <?php endif; ?>
		        </div>
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
