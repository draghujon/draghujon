// Hides or shows the username available and the username taken
// messages using CSS block property.
function usernameMessage(usernameAvailable) {
  let usernameAvailableMsg = document.querySelector('.username-available-msg');
  let usernameTakenMsg = document.querySelector('.username-taken-msg');

  if (usernameAvailable) {
    usernameAvailableMsg.style.display = 'block';
    usernameTakenMsg.style.display = 'none';
  } else {
    usernameAvailableMsg.style.display = 'none';
    usernameTakenMsg.style.display = 'block';
  }
}

function checkUsername(event) {
  // Fetch the username provided by the user in the target input.
  let username = event.target.value;

  // Don't bother checking blank usernames.
  if (username === '') {
    return;
  }

  // AJAX GET request to test the username for availability.
  fetch('username.php?username=' + username)
    .then(function(rawResponse) { 
      return rawResponse.json(); // Promise for parsed JSON.
    })
    .then(function(response) {
      // If the API check was successful.
      if (response['success']) {
        // Show the relevant username message (available / taken).
        usernameMessage(response['usernameAvailable'])

        // If the username is take put the focus back on the input
        // and select all text.
        if (! response['usernameAvailable']) {
          event.target.select();
        }
      }
    });
};

// Bind the checkUsername function to the onblur event of the username input.
// When this input loses focus this function will be executed.
let inputUsername = document.querySelector('#inputUsername');
inputUsername.onblur = checkUsername;