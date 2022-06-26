const formPub = document.getElementById('form-publisher')
const formDate = document.getElementById('form-date')
const formAuthor = document.getElementById('form-author')
const displayPub = document.getElementById('display-publisher')
const displayDate = document.getElementById('display-date')
const displayAuthor = document.getElementById('display-author')

const send = async function (data, text = false) {
    return await fetch(`/controllers/controller.php?${data}`)
    .then(response => { return text ? response.text() : response.json()})
}

formPub.publisher.onchange = async function (e) {
    e.preventDefault()
    await send(`publisher=${ e.target.value }`)
        .then(value => displayPub.innerHTML = value)
}

formAuthor.author.onchange = async function(e) {
    e.preventDefault()
    await send(`author=${e.target.value}`, true)
        .then(str => new window.DOMParser().parseFromString(str, 'text/html'))
        .then(data => displayAuthor.innerHTML = data['activeElement']['innerHTML'])
}

formDate.send.onclick = async function(e) {
    e.preventDefault()
    await send(`date_from=${ formDate.date_from.value }&date_to=${ formDate.date_to.value }`, true)
        .then(value => displayDate.innerHTML = value)
}
