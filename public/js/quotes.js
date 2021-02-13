var bookQuotes = [
	'A room without books is like a body without a soul.',
	'Good friends, good books, and a sleepy conscience: this is the ideal life.',
	'Fairy tales are more than true: not because they tell us that dragons exist, but because they tell us that dragons can be beaten.',
	'Never trust anyone who has not brought a book with them.',
	'You can never get a cup of tea large enough or a book long enough to suit me.',
	'There is no friend as loyal as a book.'

];

window.onload = function() {
	var randomNumber = Math.floor(Math.random() * (bookQuotes.length));
	document.getElementById('quoteDisplay').innerHTML = bookQuotes[randomNumber];
}