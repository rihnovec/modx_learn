(function() {
  document.addEventListener('DOMContentLoaded', () => {
    const searchForm = document.querySelector('.search-form')
    const resultBlock = document.getElementById('search-result')
  
    searchForm.addEventListener('submit', event => {
      const formData = new FormData(event.currentTarget)

      const url = new URL(window.location.origin + '/search-result.php')
      url.search = new URLSearchParams(Object.fromEntries(formData)).toString()
  
      resultBlock.innerHTML = 'Поиск...'

      fetch(url, {
        method: 'GET',
        headers: {
          'x-requested-with': 'xmlhttprequest'
        }
      })
        .then(response => response.text())
        .then(responseText => {
          resultBlock.innerHTML = responseText
        })

      event.preventDefault()
    })
  })
})()