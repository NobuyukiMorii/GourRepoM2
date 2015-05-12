<?php
class ApiMoviesController extends AppController {

    /*利用するモデル*/
    public $uses = array('Movie' , 'User' , 'Restaurant' , 'TagRelation' , 'UserFavoriteMovieList' , 'UserWatchMovieList' , 'Tag' , 'TagRelation' , 'UserProfile' , 'Preference' , 'LargeCategory' , 'SmallCategory' , 'LargeArea' , 'MiddleArea' , 'SmallArea');

    public $components = array('RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

   	public function returnMoviesJson(){ 
		//ポストされた場合
		if(!empty($this->request->data['areaname'])){

			//送信されてきたデータをviewに渡す
			$areaname = $this->request->data['areaname'];

			$this->set('areaname',$areaname);

			//ユーザープロフィールを検索する
			$this->User->unbindModel(
	            array('hasMany' =>array('Movie' , 'UserFavoriteMovieList', 'UserWatchMovieList'))
	        );
			$this->Restaurant->unbindModel(
	            array('hasMany' =>array('Movie','UserProfile'))
	        );
	        $UserName = $this->UserProfile->find('all',array(
	        	'conditions'=>
	        		array( '`UserProfile`.`name` LIKE ' => '%'.$this->request->data['areaname'].'%'
	        			),
	        	'fields' =>array('user_id','name')
	        ));

	        //ユーザープロフィールがあるかどうかを判定する
	        if(!empty($UserName)){

		        //キーワードに合致したuser_idだけの配列を作成する
		        $user_id_array = array();

		        foreach ($UserName as $key => $value) {
			        $user_id_array[] = $value['UserProfile']['user_id'];

		        }

		        //条件を設定する
	        	$conditions = array(
					'OR' =>
					array(	
						'`Movie`.`title` LIKE '			     		=> '%'.$this->request->data['areaname'].'%',
						'`Movie`.`description` LIKE '	     		=> '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`name` LIKE '          		=> '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`access_line` LIKE '   		=> '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`access_station` LIKE '		=> '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`category_name_s` LIKE '      => '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`category_name_l` LIKE '      => '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`address` LIKE '       		=> '%'.$this->request->data['areaname'].'%',
						'`Movie`.`user_id` IN '        		 		=> $user_id_array
					),
					'Movie.del_flg' => 0
				);
			}

			if(empty($UserName)){

		        //条件を設定する
	        	$conditions = array(
					'OR' =>
					array(	
						'`Movie`.`title` LIKE '			     		=> '%'.$this->request->data['areaname'].'%',
						'`Movie`.`description` LIKE '	     		=> '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`name` LIKE '          		=> '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`access_line` LIKE '   		=> '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`access_station` LIKE '		=> '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`category_name_s` LIKE '      => '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`category_name_l` LIKE '      => '%'.$this->request->data['areaname'].'%',
						'`Restaurant`.`address` LIKE '       		=> '%'.$this->request->data['areaname'].'%',
					),
					'Movie.del_flg' => 0
				);
			}

	        //タグid検索
	        $Tagid = $this->TagRelation->find('all',array(
	        	'conditions'=>
	        		array( '`Tag`.`name` LIKE ' => '%'.$this->request->data['areaname'].'%'
	        			),
	        	'fields' => array('movie_id')
	        ));

	       	//キーワードに合致したTagidだけの配列を作成する
			$tag_id_array = array();
			foreach ($Tagid as $key => $value) {
		 		//echo var_dump($value);
	 	    	$tag_id_array[] = $value['TagRelation']['movie_id'];
			}

			//キーワードに合致したuser_idだけの配列を作成する
		    $user_id_array = array();
	        foreach ($UserName as $key => $value) {
	        $user_id_array[] = $value['UserProfile']['user_id'];
	        }

	        //タグidがあるか判定する
	        if(empty($Tagid)){
	        	if(empty($UserName)){

	        		//MovieのidとMovieのuser_idがない場合
	        		$conditions = array(
						'OR' =>
						array(	
								'`Movie`.`title` LIKE '			     		=> '%'.$this->request->data['areaname'].'%',
								'`Movie`.`description` LIKE '	     		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`name` LIKE '          		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`access_line` LIKE '   		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`access_station` LIKE '		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`category_name_s` LIKE '      => '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`category_name_l` LIKE '      => '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`address` LIKE '       		=> '%'.$this->request->data['areaname'].'%'
						),
						'Movie.del_flg' => 0
					);
					//echo var_dump($UserName);

	        	}else{

	        		//MovieのUser_idだけある場合
	        		$conditions = array(
						'OR' =>
						array(	
								'`Movie`.`title` LIKE '			     		=> '%'.$this->request->data['areaname'].'%',
								'`Movie`.`description` LIKE '	     		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`name` LIKE '          		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`access_line` LIKE '   		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`access_station` LIKE '		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`category_name_s` LIKE '      => '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`category_name_l` LIKE '      => '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`address` LIKE '       		=> '%'.$this->request->data['areaname'].'%',
								'`Movie`.`user_id` IN '						=> $user_id_array,
						),
						'Movie.del_flg' => 0
					);
	        	}
	        }else{
	        	if(empty($UserName)){

	        		//Movieのuser_idだけある場合
	        		$conditions = array(
						'OR' =>
						array(	
								'`Movie`.`title` LIKE '			     		=> '%'.$this->request->data['areaname'].'%',
								'`Movie`.`description` LIKE '	     		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`name` LIKE '          		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`access_line` LIKE '   		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`access_station` LIKE '		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`category_name_s` LIKE '      => '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`category_name_l` LIKE '      => '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`address` LIKE '       		=> '%'.$this->request->data['areaname'].'%',
								'`Movie`.`id`'					 			=> $tag_id_array,
						),		
						'Movie.del_flg' => 0
					);
	        	}else{

	        		//どっちもある場合
	        		$conditions = array(
						'OR' =>
						array(	
								'`Movie`.`title` LIKE '			     		=> '%'.$this->request->data['areaname'].'%',
								'`Movie`.`description` LIKE '	     		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`name` LIKE '          		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`access_line` LIKE '   		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`access_station` LIKE '		=> '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`category_name_s` LIKE '      => '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`category_name_l` LIKE '      => '%'.$this->request->data['areaname'].'%',
								'`Restaurant`.`address` LIKE '       		=> '%'.$this->request->data['areaname'].'%',
								'`Movie`.`id'					 			=> $tag_id_array,
								'`Movie`.`user_id` IN '        		 		=> $user_id_array
						),
						'Movie.del_flg' => 0
					);
	        	}
	        }
			//ユーザープロフィールを検索する
			$this->User->unbindModel(
	            array('hasMany' =>array('Movie' , 'UserFavoriteMovieList', 'UserWatchMovieList'))
	        );
			$this->Restaurant->unbindModel(
	            array('hasMany' =>array('Movie','UserProfile'))
	        );

			$results = $this->Movie->find('all',array(
				 'conditions' => $conditions,
				 'limit' => 10,
				 'order' => array('Movie.count' => 'DESC'),
				 'recursive' => 2
				)
			);

			// //結果がない場合
			// if(empty($results)){
			// 	$conditions = array(
			// 		'Movie.del_flg' => 0
			// 	);
			// 	$results = $this->Movie->find('all',array(
			// 		 'conditions' => $conditions,
			// 		 'limit' => 10,
			// 		 'order' => array('Movie.count' => 'DESC'),
			// 		 'recursive' => 2
			// 		)
			// 	);
			// }

		}

		//ポストされなかった場合
		if(empty($this->request->data['areaname'])){
			$areaname = null;
			$conditions = array(
				'Movie.del_flg' => 0
			);
			//ユーザープロフィールを検索する
			$this->User->unbindModel(
	            array('hasMany' =>array('Movie' , 'UserFavoriteMovieList', 'UserWatchMovieList'))
	        );
			$this->Restaurant->unbindModel(
	            array('hasMany' =>array('Movie','UserProfile'))
	        );
			$results = $this->Movie->find('all',array(
				 'conditions' => $conditions,
				 'limit' => 10,
				 'order' => array('Movie.count' => 'DESC'),
				 'recursive' => 2
				)
			);
		}
        /*
        *メッセージを返す
        */       
        $message = array('result' => $results , 'areaname' => $areaname);
        $this->set(array('message' => $message, '_serialize' => array('message')));
	}

}