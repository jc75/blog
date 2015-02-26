<?php
Class Model_Article
{
	private $db;

	public function __construct()
	{		
		
		$this->db = new Helper_Database("mysql:host=127.0.0.1;dbname=blog", "root", "troiswa");

	}

	public function getAll()
	{
		$article = $this->db->fetchAll("SELECT u.id as users_id, a.id as article_id, pseudo, title, date, description, user_id FROM articles a JOIN users u on a.user_id = u.id");

		return $article;
		//var_dump($article);

	}

	public function getOne($id)
	{
		$article = $this->db->fetchOne("SELECT u.id as users_id, a.id as article_id, pseudo, title, date, description, user_id FROM articles a JOIN users u on a.user_id = u.id WHERE a.id = :idArticle", array("idArticle" => $_GET["id"]));
		
		return $article;
	}

	public function createArticle($data)
	{	

		$article = $this->db->insert("INSERT INTO articles(title, description,user_id) VALUES(:title, :description, :user)",$data);
		return $this->db->lastInsertId();
		
	}


	public function insertImage($file, $article_id)
	{
		$uploads_dir = 'assets/files';

		foreach ($file["files"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $tmp_name = $file["files"]["tmp_name"][$key];
		        $name = $file["files"]["name"][$key];
		        move_uploaded_file($tmp_name, "$uploads_dir/$name");
		        //echo $name = $file["files"]["name"][$key];
		        $article = $this->db->insert("INSERT INTO images(url, article_id) VALUES(:url, :article_id)",array("url"=>$name, "article_id"=>$article_id));
		    }

		}
	}


	public function pageNext($article_id)
	{
		$page_next = $this->db->fetchAll("SELECT * FROM articles where id > :article_id order by id ASC",array("article_id"=>$article_id));
		
		if(isset($page_next[0]))
		{
			$data = $page_next[0];
			return $data;
		}
		else
		{
			return false;
		}
	}


	public function pagePrev($article_id)
	{
		$page_prev = $this->db->fetchAll("SELECT * FROM articles where id < :article_id order by id DESC",array("article_id"=>$article_id));
	
		if(isset($page_prev[0]))
		{
			$data = $page_prev[0];
			return $data;
		}
		else
		{
			return false;
		}
	}

	public function pagination($offset,$nbPost)
	{
		
		$offset = ($offset-1)*$nbPost;

		$post = $this->db->fetchOne("SELECT count(*) FROM articles");

		foreach ($post as $value) {
			$total = $value;
		}

		$nombreDePages=ceil($total/$nbPost);

		$data[] = $nombreDePages;

		 $article = $this->db->fetchAll("SELECT u.id as users_id, a.id as article_id, pseudo, title, date, description, user_id FROM articles a JOIN users u on a.user_id = u.id order by article_id limit $offset, $nbPost");
		 
		$data[] = $article;

		return $data;

	}

	public function showComment($article_id)
	{	

		$comment = $this->db->fetchAll("SELECT * FROM comments c JOIN users u on c.id_user = u.id where id_article= :article_id",array("article_id"=>$article_id));		

		foreach ($comment as $c) {

			$data[] = $c;
		}
		if (isset($data)){

			return $data;

		}else{
			return false;
		}
	}

	public function insertComment($data)
	{
		$comment = $this->db->insert("INSERT INTO comments(content, id_article, id_user) VALUES(:content, :id_article, :id_user)",$data);
		
	}


	public function insertTag($tags, $article_id)
	{
		$tags = trim($tags);
		$tag = explode(",", $tags);

		foreach ($tag as $name) {
		
			$this->db->insert("INSERT INTO tags(name, article_id) VALUES(:name, :article_id)",array("name"=>$name, "article_id"=>$article_id));
		
		}
	}

	public function showTag($article_id)
	{
		$tag = $this->db->fetchAll("SELECT * FROM tags where article_id = :article_id",array("article_id"=>$article_id));
		return $tag;
	}

	public function showImg($article_id)
	{
		$img = $this->db->fetchAll("SELECT * FROM images where article_id = :article_id",array("article_id"=>$article_id));
		return $img;
	}




}