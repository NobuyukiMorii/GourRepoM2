<?php echo $this->Html->css('bootstrap.min'); ?>
<?php echo $this->Html->css('view-userWatchMovieList/common-setting'); ?>
<?php echo $this->Html->css('view-userWatchMovieList/place-title.css'); ?>
<?php echo $this->Html->css('view-userWatchMovieList/movie-list.css'); ?>
<?php echo $this->Html->css('view-userWatchMovieList/select-page-button-movie.css'); ?>
<?php echo $this->Html->css('view-userWatchMovieList/view-reccomend-movie-for-movie.css'); ?>


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

					<?php for ($i = 0; $i < count($UserWatchMovieList); ++$i): ?>
		          	<tr class="movie-list-tr">
			            <td class="movie-list-photo-td">
			              	<a href ="<?php echo $this->html->url(array('controller' => 'Movies' , 'action' => 'view' , $UserWatchMovieList[$i]['Movie']['id'])) ;?>" class="movie-list-photo-a">
			                	<img src="<?php echo $UserWatchMovieList[$i]['Movie']['thumbnails_url'] ;?>"  class="movie-list-photo">
			              	</a>
			            </td>
			            <td class="movie-list-description-td" valign="top">
			              	<div class="movie-list-description-div">
				                <a href="<?php echo $this->html->url(array('controller' => 'Movies' , 'action' => 'view' , $UserWatchMovieList[$i]['Movie']['id'])) ;?>" class="movie-list-description-title-ahref">
				                  <span class="movie-list-description-title">
				                  	<?php echo $UserWatchMovieList[$i]['Movie']['Restaurant']['name'] ;?>
				                  </span>
				                  <br>
				                </a>
				                <a href="<?php echo $this->html->url(array('controller' => 'Movies' , 'action' => 'view' , $UserWatchMovieList[$i]['Movie']['id'])) ;?>" class="movie-list-reporter-introduction-ahref">
				                  	<span class="label label-default">最寄駅</span>&nbsp;<span class="black-text">
				                  		<?php echo $UserWatchMovieList[$i]['Movie']['Restaurant']['name'] ;?>
				              		</span> &nbsp;&nbsp;
				                  	<span class="label label-default">ジャンル</span>&nbsp;<span class="black-text">
				                  		<?php echo $UserWatchMovieList[$i]['Movie']['Restaurant']['category'] ;?>
				                  	</span> &nbsp;&nbsp;
				                  	<span class="label label-default">料金</span>&nbsp;<span class="black-text">
				                  		<?php echo $UserWatchMovieList[$i]['Movie']['Restaurant']['budget'] ;?>
				                  	</span> &nbsp;&nbsp;
				                  	<br>
				                  	<span class="movie-list-reporter-introduction">
				                  		<?php echo $UserWatchMovieList[$i]['Movie']['description'] ;?>
				                  	</span>
				                </a>  
			              	</div>  
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