<!-- Include the Firebase JavaScript SDK -->
<script src="https://www.gstatic.com/firebasejs/9.6.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.6.5/firebase-messaging.js"></script>

<script>
  // Initialize Firebase
  const firebaseConfig = {
    apiKey: 'AIzaSyDmen_dIwqioZR5p_kJDjTmb10Tg4E5nJs',
    authDomain: 'YOUR_AUTH_DOMAIN',
    projectId: 'donation-9074c',
    messagingSenderId: '35491763018 7',
    appId: 'YOUR_APP_ID'
  };
  firebase.initializeApp(firebaseConfig);

  const messaging = firebase.messaging();

  // Request permission from the user to receive notifications
  messaging.requestPermission()
    .then(() => {
      console.log('Notification permission granted.');
      return messaging.getToken();
    })
    .then((token) => {
      console.log('Token:', token);
      // Send this token to your server to associate it with the user
    })
    .catch((err) => {
      console.log('Error getting permission:', err);
    });

  // Handle incoming messages
  messaging.onMessage((payload) => {
    console.log('Message received:', payload);
    // Handle the received message, e.g., display a notification
  });
</script>
