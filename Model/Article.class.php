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
		$article = $this->db->fetchAll("SELECT * FROM articles a JOIN users u on a.user_id = u.id");

		return $article;
		//var_dump($article);

	}

	public function getOne()
	{
		$article = $this->db->fetchOne("SELECT * FROM articles a JOIN users u on a.user_id = u.id WHERE id = :idArticle", array("idArticle" => $_GET["id_article"]));
		
		return $article;
	}

	public function createArticle($data)
	{	

		$article = $this->db->insert("INSERT INTO articles(title, description,user_id) VALUES(:title, :description, :user)",$data);
		return $this->db->lastInsertId();
		
	}

	public function insertImage($file, $article_id)
	{
		$uploads_dir = 'assets/images';

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

	public function showTPicture($article_id)
	{


	}

}