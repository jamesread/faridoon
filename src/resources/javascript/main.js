function vote(id, dir)
{
  window.fetch('vote.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      id: id,
      direction: dir
    })
  })
    .then(response => response.json())
    .then(onVoteReply)
    .catch(onError)
}

function onError(res)
{
  console.log('err', res)

  document.querySelectorAll('p.error').forEach(function (el) {
    el.remove()
  })

  if (typeof res.message != "undefined") {
    const p = document.createElement('p')
    p.classList.add('error')
    p.textContent = 'Error: ' + res.message
    p.addEventListener('click', function () {
      p.remove()
    })

    document.body.appendChild(p)
  }
}

function onVoteReply(json)
{
  if (json.type === 'error') {
    if (json.cause === 'needsLogin') {
      window.location = 'login.php'
    } else {
      onError(json)
    }
  } else {
    const voteCount = document.getElementById('quote' + json.id).querySelector('.voteCount')

    if (json.newVal === 0) {
      voteCount.classList.add('novotes')
    } else {
      voteCount.classList.remove('novotes')
    }

    voteCount.innerText = json.newVal
  }
}
