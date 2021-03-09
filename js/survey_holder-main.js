
jQuery(document).ready(function($) {
  let button = document.querySelector('#launch-survey')
  button.addEventListener("click", showSurvey);
  let close = document.querySelector('#close-survey');
  close.addEventListener("click", hideSurvey);
  
});

function showSurvey(){
	let survey = document.querySelector('#the-survey');
	survey.classList.add('show');
}

function hideSurvey(){
	let survey = document.querySelector('#the-survey');
	survey.classList.remove('show');
}