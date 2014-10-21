<?php

class JuxtaPHP {
	private $URL = "http://celtest1.lnu.se:4040";
	
	/*
	*	Get all quizzes
	*
	*/
	public function getQuizzes() {
		$response = \Httpful\Request::get($this->URL . "/quizzes")->send();
		return $response;
	}
	
	/*
	*	Get a quiz by ID
	*
	*/
	public function getQuizzById($id) {
		$response = \Httpful\Request::get($this->URL . "/quizzes/id/".$id)->send();
		return $response;
	}
	
	/*
	*	Create a new quiz
	*	[“mediaItem:type” must be one of the following: video, image]
	*	Responds with 201 on success
	*/

	public function makeNewQuiz($quiz) {
		$response = \Httpful\Request::post($this->URL . "/quizzes/new")
			->sendsJson()
			->body($quiz)
			->send();

		return $response;
	}

	/*
	*	Update a quiz
	*	Responds with 200 on success
	*/

	public function updateQuizzById($id, $update) {
		$response = \Httpful\Request::put($this->URL . "/quizzes/id/".$id)
			->sendsJson()
			->body($update)
			->send();

		return $response;
	}

	/*
	*	Deletes quiz by ID
	*
	*/

	public function removeQuizById($id){
		$response = \Httpful\Request::delete($this->URL . "/quizzes/delete/".$id)->send();
		return $response;		
	}
	
	/*
	*	Get all images
	*
	*/

	public function getImages() {
		$response = \Httpful\Request::get($this->URL . "/images")->send();
		return $response;
	}
	
	/*
	*	Get a image by ID
	*
	*/
	public function getImageById($id) {
		$response = \Httpful\Request::get($this->URL . "/images/id/".$id)->send();
		return $response;
	}
	
	/*
	*	Upload a new image
	*	[“mediaItem:type” must be one of the following: video, image]
	*	Responds with 201 on success
	*/

	public function createNewImage($image) {
		$response = \Httpful\Request::post($this->URL . "/images/new")
			->sendsJson()
			->body($image)
			->send();

		return $response;
	}
	
	/*
	*	Update an image
	*	Responds with 200 on success
	*/
	public function updateImageById($id, $update) {
		$response = \Httpful\Request::put($this->URL . "/images/id/".$id)
			->sendsJson()
			->body($update)
			->send();

		return $response;
	}
	
	/*
	*	Deletes image by ID
	*
	*/
	public function removeImageById($id) {
		$response = \Httpful\Request::delete($this->URL . "/images/delete/".$id)->send();
		return $response;		
	}
	
		/*
	*	Get all videos
	*
	*/

	public function getVideos() {
		$response = \Httpful\Request::get($this->URL . "/videos")->send();
		return $response;
	}

}

?>