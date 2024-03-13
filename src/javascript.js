async function randomQuote() {
    const response = await fetch('https://api.quotable.io/random')
    const jsonquote = await response.json()
    
    // Output the quote and author name
    const author = document.getElementById('author');
    const quote = document.getElementById('quote');
    quote.textContent = jsonquote.content;
    author.textContent = "- " + jsonquote.author;
  }