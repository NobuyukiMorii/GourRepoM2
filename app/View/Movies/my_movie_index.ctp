<?php echo $this->Html->css('bootstrap.min'); ?>
<?php echo $this->Html->css('view-myMovieIndex/common-setting'); ?>
<?php echo $this->Html->css('view-myMovieIndex/place-title.css'); ?>
<?php echo $this->Html->css('view-myMovieIndex/movie-list.css'); ?>
<?php echo $this->Html->css('view-myMovieIndex/select-page-button-movie.css'); ?>
<?php echo $this->Html->css('view-myMovieIndex/view-reccomend-movie-for-movie.css'); ?>

<div class="container">

  	<!-- CONTENT ============-->
	<div class="row main-content">

	  	<!-- 動画とお店の詳細 ============-->
	  	<!-- ROW ============-->
	  	<div class="row">
		    <div class="col-md-10">
		      <div class="row">
		        <!-- 動画 ============-->
		        <table class="movie-list-table table table-striped">

					<?php for ($i = 0; $i < count($userMoviePostHistory); ++$i): ?>
		          	<tr class="movie-list-tr">
			            <td class="movie-list-photo-td">
			              	<a href ="<?php echo $this->html->url(array('controller' => 'Movies' , 'action' => 'view' , $userMoviePostHistory[$i]['Movie']['id'])) ;?>" class="movie-list-photo-a">
			                	<img src="<?php echo $userMoviePostHistory[$i]['Movie']['thumbnails_url'] ;?>"  class="movie-list-photo">
			              	</a>
			            </td>
			            <td class="movie-list-description-td" valign="top">
			              	<div class="movie-list-description-div">
				                <a href="<?php echo $this->html->url(array('controller' => 'Movies' , 'action' => 'view' , $userMoviePostHistory[$i]['Movie']['id'])) ;?>" class="movie-list-description-title-ahref">
				                  <span class="movie-list-description-title">
				                  	<?php echo $userMoviePostHistory[$i]['Restaurant']['name'] ;?>
				                  </span>
				                  <br>
				                </a>
				                <a href="<?php echo $this->html->url(array('controller' => 'Movies' , 'action' => 'view' , $userMoviePostHistory[$i]['Movie']['id'])) ;?>" class="movie-list-reporter-introduction-ahref">
				                  	<span class="label label-default">最寄駅</span>&nbsp;<span class="black-text">
				                  		<?php echo $userMoviePostHistory[$i]['Restaurant']['name'] ;?>
				              		</span> &nbsp;&nbsp;
				                  	<span class="label label-default">ジャンル</span>&nbsp;<span class="black-text">
				                  		<?php echo $userMoviePostHistory[$i]['Restaurant']['category'] ;?>
				                  	</span> &nbsp;&nbsp;
				                  	<span class="label label-default">料金</span>&nbsp;<span class="black-text">
				                  		<?php echo $userMoviePostHistory[$i]['Restaurant']['budget'] ;?>
				                  	</span> &nbsp;&nbsp;
				                  	<br>
					            	<?php for ($j = 0; $j < count($userMoviePostHistory[$i]['TagRelation']); ++$j): ?>
					                  	<span class="label label-default">
					                  		<?php echo $userMoviePostHistory[$i]['TagRelation'][$j]['Tag']['name'] ;?>
					                  	</span>&nbsp;
					            	<?php endfor ;?>
					            	<br>
				                  	<span class="movie-list-reporter-introduction">
				                  		<?php echo $userMoviePostHistory[$i]['Movie']['description'] ;?>
				                  	</span>
				                </a>  
			              	</div>  
			            </td>
			            <td>
			            	<a class="btn btn-info" href="<?php echo $this->Html->url(array('controller' => 'Movies' , 'action' => 'edit', $userMoviePostHistory[$i]['Movie']['id'])); ?>">
                    			編集
                    		</a>
			            </td>
			            <td>
			            	<?php echo $this->Form->create('Movie', array('type' => 'post' , 'action' => 'delete')); ?>
					        <?php echo $this->Form->input('Movie.id', array(
					            'label' => false,
					            'type' => 'hidden',
					            'value' => $userMoviePostHistory[$i]['Movie']['id'],
					        )); ?>
					        <button type="submit" class="btn btn-warning">送信</button>
					        <?php echo $this->Form->end(); ?>
			            </td>
		          	</tr>
		          	<?php endfor ;?>
		        </table>
		        <!-- /動画 ============-->
		      </div>
		    </div>
		    <!-- /動画とお店の詳細 ============-->
		</div>
		<!-- /ROW ============-->
	</div>
	<!-- /CONTENT ============-->

	<div class="pagination" style="margin-left:20px;">                         
	  <ul>                                           
	    <?php echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
	    <?php echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1, 'ellipsis' => '<li class="disabled"><a>...</a></li>')); ?>                              
	    <?php echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
	  </ul>                                          
	</div>

</div>