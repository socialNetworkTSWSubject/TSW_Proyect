<?php
//file /controller/LikesController.php

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../model/Like.php");
require_once(__DIR__."/../database/PostDAO.php");
require_once(__DIR__."/../database/LikeDAO.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class LikesController
 * Controlador relativo a los likes de un post cuya funcionalidad es 
 * añadir un like
 * 
 * @author jenifer <jeny-093@hotmail.com>
 * @author adrian <adricelixfernandez@gmail.com>
 */

class LikesController extends BaseController{
	
	/**
	 * Referencia a la clase LikeDAO que interactua con la BD
	 * @var likeDAO
	 */
	private $likeDAO;
	
	/**
	 * Referencia a la clase PostDAO que interactua con la BD
	 * @var postDAO 
	 */
	private $postDAO;
	
	public function __construct(){
		parent::__construct();
		
		$this->likeDAO = new LikeDAO;
		$this->postDAO = new PostDAO();
	}
	
	/**
	 * Metodo del controlador Likes cuya funcionalidad es añadir un like en un
	 * post. Verifica que el usuario haya iniciado sesion, que el post existe y
	 * que el usuario no ha hecho like previamente sobre ese post.
	 *
	 * @return void
	 */
	public function addLike(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing posts requires login");
		}
		
		if (isset($_GET["id"])) { 
			
			// Get the Post object from the database
			$idPost = $_GET["id"];
			$post = $this->postDAO->findByIdPost($idPost);
			
			if ($post == NULL) {
				throw new Exception("No such post with id: ".$idPost);
			}
			
			if($this->likeDAO->isNewLike($this->currentUser,$idPost) > 0){
				throw new Exception("This user already made like in this post");
			}
			
			//Create the Like Object
			$like = new Like($this->currentUser->getEmail(),$post);
			
			try {
				$this->likeDAO->addLikePost($like);
				$this->likeDAO->increaseNumLikes($idPost);
				$this->view->redirect("posts", "viewPosts");
			} catch (ValidationException $ex){
				$errors = $ex->getErrors();
			
				$this->view->setVariable("like", $like, true);
				$this->view->setVariable("errors", $errors, true);
					
				$this->view->redirect("posts", "viewPosts");
			}
		} else {
			throw new Exception("No such post id");
		}

	}
	
}
?>