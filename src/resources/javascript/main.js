function toggleFullscreen () {
  if (document.fullscreenElement) {
    document.exitFullscreen()
  } else {
    document.documentElement.requestFullscreen()
  }
}

window.logoClicks = 0

function clickLogo () {
  window.logoClicks++
  if (window.logoClicks >= 5) {
    document.getElementById('developer-links').hidden = false

    window.alert('You found the hidden developer links!')

  }
}

function voteUp (id) {
  return vote(id, 'up')
}

function voteDown (id) {
  return vote(id, 'down')
}

function vote (id, dir) {
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

  return false // prevent default
}

function onError (res) {
  console.log('err', res)

  document.querySelectorAll('p.error').forEach(function (el) {
    el.remove()
  })

  if (typeof res.message !== 'undefined') {
    const p = document.createElement('p')
    p.classList.add('error')
    p.textContent = 'Error: ' + res.message
    p.addEventListener('click', function () {
      p.remove()
    })

    document.body.appendChild(p)
  }
}

function onVoteReply (json) {
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
