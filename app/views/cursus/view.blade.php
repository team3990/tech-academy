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
		                <h1>
                			<span class="label label-course"><?php echo $course->subject->code; ?></span>
                            <span class="label label-class"><?php echo $course->class; ?></span> 
                            <?php echo $course->title; ?>
		                </h1>
		            </div>
				</div>
			</div>
            
            <div class="row">
            
				<div class="col-lg-3 col-md-3 col-sm-3 hidden-xs small">
	                <div class="list-group">
	                    <a href="<?php echo route('academy.courses.index'); ?>" class="list-group-item"><i class="fa fa-arrow-circle-left fa-fw"></i> Retourner à la liste des cours</a>
	                    <a href="<?php echo route('academy.courses.view', $course->id); ?>" class="list-group-item"><i class="fa fa-home fa-fw"></i> Plan de cours</a>
	                </div>
	                <div class="text-muted">Contenu du cours</div>
	                <div class="list-group">
	                    <?php if (count($course->chapters) > 0) : ?>
	                        <?php foreach ($course->chapters as $c) : ?>
	                            <a href="<?php echo route('academy.courses.view', array($course->id, $c->id)); ?>" class="list-group-item<?php echo (Route::input('chapter_id') == $c->id) ? ' active active-warning' : ''; ?>">
	                            	<p class="pull-left"><?php echo $c->chapter_number; ?></p>
	                            	<p class="pull-left" style="margin-left: 5px"><i class="fa fa-angle-right fa-fw"></i></p>
	                            	<p style="margin-bottom: 0"><?php echo $c->title; ?></p>
								</a>
	                        <?php endforeach; ?>
	                    <?php else : ?>
	                    <div class="alert alert-warning">Aucun contenu de cours pour le moment.</div>
	                    <?php endif; ?>
	                </div>
                </div>
                
                <div class="col-lg-9 col-md-3 col-sm-3 col-xs-12">
                
                	<?php if (Route::input('chapter_id') == NULL && Route::input('page_id') == NULL) : ?>
                		<div class="row small">
			            	<div class="col-sm-6 col-xs-12">
			                    <div class="panel panel-warning">
			                        <div class="panel-heading">
			                            <i class="fa fa-info-circle fa-fw"></i> <strong>Résumé du cours</strong>
			                        </div>
			                        <div class="panel-body">
			                        	<?php echo $course->desc; ?>
		                        	</div>
			                    </div>
			                </div>
			    			<div class="col-sm-3 hidden-xs">
			                    <div class="panel panel-default">
			                        <div class="panel-heading">
			                            <i class="fa fa-graduation-cap fa-fw"></i> <strong>Enseignant(s)</strong>
			                        </div>
			                        <div class="panel-body">
			                        	<?php if (count($course->teachers) > 0) : ?>
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
			                            <?php endif; ?>
			                        </div>
			                    </div>
			                </div>
			    			<div class="col-sm-3 hidden-xs">
			                    <div class="panel panel-default">
			                        <div class="panel-heading">
			                            <i class="fa fa-info-circle fa-fw"></i> <strong>Format du cours</strong>
			                        </div>
			                        <div class="panel-body">
			                        	<?php echo $course->type->title; ?>
		                        	</div>
			                    </div>
			                </div>
			            </div>
			        <?php endif; ?>
			            
		            <?php if (Route::input('chapter_id') == NULL && Route::input('page_id') == NULL) : ?>
			            <div class="row">
			            	<div class="col-xs-12">
			            		<div class="page-header" style="margin-top: 0">
	            					<h3 style="margin-top: 0"><i class="fa fa-sitemap fa-fw"></i> Plan du cours</h3>
	            				</div>
	            				<?php if (count($course->chapters) > 0) : ?>
	                                <?php foreach ($course->chapters as $c) : ?>
	                                    <p class="lead" style="margin-bottom: 0">
	                                    	<i class="fa fa-bookmark fa-fw"></i> <?php echo $c->chapter_number; ?> &mdash; 
	                                    	<a href="<?php echo route('academy.courses.view', array($course->id, $c->id)); ?>">
	                                    	<?php echo $c->title; ?>
	                                    	</a>
                                    	</p>
                                    	<?php foreach ($c->pages as $p) : ?>
                                    		<p style="margin-left: 30px; margin-bottom: 0">
                                    			<i class="fa fa-angle-right fa-fw"></i> 
                                    			<a href="<?php echo route('academy.courses.view', array($course->id, $c->id, $p->id)); ?>">
                                    			<?php echo $c->chapter_number.'.'.$p->page_number.' &mdash; '.$p->title; ?>
                                    			</a>
                                    		</p>
                                    	<?php endforeach; ?>
                                    	<hr />
	                                <?php endforeach; ?>
	                            <?php else : ?>
	                                <div class="alert alert-warning text-center">Ce cours n'a pas encore de plan de cours.</div>
	                            <?php endif; ?>
			            	</div>
			            </div>
			            
			        <?php elseif (Route::input('chapter_id') != NULL && Route::input('page_id') == NULL) : ?>
			        	<div class="row">
			        		<div class="col-xs-4 hidden-xs">
			        			<?php if (count($chapter->previous) > 0) : ?>
			        			<ul class="pager pull-left">
									<li class="text-left"><a href="<?php echo route('academy.courses.view', array($course->id, $chapter->previous->id)); ?>">
										<i class="fa fa-arrow-circle-left fa-fw"></i> Chapitre précédent<br />
										<strong><?php echo $chapter->previous->chapter_number.' &mdash; '.$chapter->previous->title; ?></strong>
									</a></li>
								</ul>
								<?php endif; ?>
			        		</div>
			        		<div class="col-xs-4 hidden-xs">
			        		</div>
			        		<div class="col-xs-4 hidden-xs">
			        			<?php if (count($chapter->next) > 0) : ?>
			        			<ul class="pager pull-right">
									<li class="text-right"><a href="<?php echo route('academy.courses.view', array($course->id, $chapter->next->id)); ?>">
										Chapitre suivant <i class="fa fa-arrow-circle-right fa-fw"></i><br />
										<strong><?php echo $chapter->next->chapter_number.' &mdash; '.$chapter->next->title; ?></strong>
									</a></li>
								</ul>
								<?php endif; ?>
			        		</div>
		        		</div>
		        		
			        	<div class="row">
			        		<div class="col-xs-12">
				        		<div class="page-header" style="margin-top: 0">
	            					<h3 style="margin-top: 0">
	            						<i class="fa fa-bookmark fa-fw"></i> 
	            						<?php echo $chapter->chapter_number; ?> &mdash; <?php echo $chapter->title; ?>
            						</h3>
	            				</div>
	            				<?php foreach ($chapter->pages as $p) : ?>
									<p style="margin-left: 30px; margin-bottom: 0">
										<i class="fa fa-angle-right fa-fw"></i> 
										<a href="<?php echo route('academy.courses.view', array($course->id, $chapter->id, $p->id)); ?>">
										<?php echo $chapter->chapter_number.'.'.$p->page_number.' &mdash; '.$p->title; ?>
										</a>
									</p>
								<?php endforeach; ?>
            				</div>
			        	</div>
			        	
			        	<div class="row">
			        		<div class="col-xs-4 hidden-xs">
			        			<?php if (count($chapter->previous) > 0) : ?>
			        			<ul class="pager pull-left">
									<li class="text-left"><a href="<?php echo route('academy.courses.view', array($course->id, $chapter->previous->id)); ?>">
										<i class="fa fa-arrow-circle-left fa-fw"></i> Chapitre précédent<br />
										<strong><?php echo $chapter->previous->chapter_number.' &mdash; '.$chapter->previous->title; ?></strong>
									</a></li>
								</ul>
								<?php endif; ?>
			        		</div>
			        		<div class="col-xs-4 hidden-xs">
			        		</div>
			        		<div class="col-xs-4 hidden-xs">
			        			<?php if (count($chapter->next) > 0) : ?>
			        			<ul class="pager pull-right">
									<li class="text-right"><a href="<?php echo route('academy.courses.view', array($course->id, $chapter->next->id)); ?>">
										Chapitre suivant <i class="fa fa-arrow-circle-right fa-fw"></i><br />
										<strong><?php echo $chapter->next->chapter_number.' &mdash; '.$chapter->next->title; ?></strong>
									</a></li>
								</ul>
								<?php endif; ?>
			        		</div>
		        		</div>
			        
			        <?php elseif (Route::input('chapter_id') != NULL && Route::input('page_id') != NULL) : ?>
			        	<div class="row">
			        		<div class="col-xs-4 hidden-xs">
			        			<?php if (count($page->previous) > 0) : ?>
			        			<ul class="pager pull-left">
									<li class="text-left"><a href="<?php echo route('academy.courses.view', array($course->id, $page->previous->chapter->id, $page->previous->id)); ?>">
										<i class="fa fa-arrow-circle-left fa-fw"></i> Page précédente<br />
										<strong><?php echo $page->previous->chapter->chapter_number.'.'.$page->previous->page_number.' &mdash; '.$page->previous->title; ?></strong>
									</a></li>
								</ul>
								<?php endif; ?>
			        		</div>
			        		<div class="col-xs-4 hidden-xs">
			        			<ul class="pager">
									<li><a href="<?php echo route('academy.courses.view', array($course->id, $chapter->id)); ?>">
										<i class="fa fa-arrow-circle-up fa-fw"></i> Remonter au chapitre<br />
										<strong><?php echo $chapter->chapter_number.' &mdash; '.$chapter->title; ?></strong>
									</a></li>
								</ul>
			        		</div>
			        		<div class="col-xs-4 hidden-xs">
			        			<?php if (count($page->next) > 0) : ?>
			        			<ul class="pager pull-right">
									<li class="text-right"><a href="<?php echo route('academy.courses.view', array($course->id, $page->next->chapter->id, $page->next->id)); ?>">
										Page suivante <i class="fa fa-arrow-circle-right fa-fw"></i><br />
										<strong><?php echo $page->next->chapter->chapter_number.'.'.$page->next->page_number.' &mdash; '.$page->next->title; ?></strong>
									</a></li>
								</ul>
								<?php endif; ?>
			        		</div>
			        		<div class="col-xs-12 visible-xs">
			        			<ul class="pager">
									<li><a href="<?php echo route('academy.courses.view', array($course->id, $chapter->id)); ?>">
										<i class="fa fa-arrow-circle-up fa-fw"></i> Remonter au chapitre<br />
										<strong><?php echo $chapter->chapter_number.' &mdash; '.$chapter->title; ?></strong>
									</a></li>
								</ul>
			        		</div>
		        		</div>
		        		
			        	<div class="row">
			        		<div class="col-xs-12">
			        			<hr />
				        		<div class="page-header" style="margin-top: 0">
	            					<h3 style="margin-top: 0">
	            						<small><i class="fa fa-bookmark fa-fw"></i> <?php echo $chapter->chapter_number.' &mdash; '.$chapter->title; ?></small><br />
	            						<?php echo $chapter->chapter_number.'.'.$page->page_number.' &mdash; '.$page->title; ?>
            						</h3>
	            				</div>
	            				<?php echo ($page->content != NULL) ? $page->content : '<div class="alert alert-warning text-center">Aucun contenu disponible pour le moment.</div>'; ?>
	            				<hr />
            				</div>
			        	</div>
			        	
			        	<div class="row">
			        		<div class="col-xs-4 hidden-xs">
			        			<?php if (count($page->previous) > 0) : ?>
			        			<ul class="pager pull-left">
									<li class="text-left"><a href="<?php echo route('academy.courses.view', array($course->id, $page->previous->chapter->id, $page->previous->id)); ?>">
										<i class="fa fa-arrow-circle-left fa-fw"></i> Page précédente<br />
										<strong><?php echo $page->previous->chapter->chapter_number.'.'.$page->previous->page_number.' &mdash; '.$page->previous->title; ?></strong>
									</a></li>
								</ul>
								<?php endif; ?>
			        		</div>
			        		<div class="col-xs-4 hidden-xs">
			        			<ul class="pager">
									<li><a href="<?php echo route('academy.courses.view', array($course->id, $chapter->id)); ?>">
										<i class="fa fa-arrow-circle-up fa-fw"></i> Remonter au chapitre<br />
										<strong><?php echo $chapter->chapter_number.' &mdash; '.$chapter->title; ?></strong>
									</a></li>
								</ul>
			        		</div>
			        		<div class="col-xs-4 hidden-xs">
			        			<?php if (count($page->next) > 0) : ?>
			        			<ul class="pager pull-right">
									<li class="text-right"><a href="<?php echo route('academy.courses.view', array($course->id, $page->next->chapter->id, $page->next->id)); ?>">
										Page suivante <i class="fa fa-arrow-circle-right fa-fw"></i><br />
										<strong><?php echo $page->next->chapter->chapter_number.'.'.$page->next->page_number.' &mdash; '.$page->next->title; ?></strong>
									</a></li>
								</ul>
								<?php endif; ?>
			        		</div>
			        		<div class="col-xs-12 visible-xs">
			        			<ul class="pager">
									<li><a href="<?php echo route('academy.courses.view', array($course->id, $chapter->id)); ?>">
										<i class="fa fa-arrow-circle-up fa-fw"></i> Remonter au chapitre<br />
										<strong><?php echo $chapter->chapter_number.' &mdash; '.$chapter->title; ?></strong>
									</a></li>
								</ul>
			        		</div>
		        		</div>
			        
			        <?php else : ?>
			        
			        
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
