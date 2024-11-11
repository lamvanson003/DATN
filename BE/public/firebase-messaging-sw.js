// firebase-messaging-sw.js

importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');


// Firebase config
const firebaseConfig = {
    apiKey: "AIzaSyADoX7jz4ESYSVmYozwKRCyCSiMKgKrQoM",
    authDomain: "app-tmdt-97150.firebaseapp.com",
    projectId: "app-tmdt-97150",
    storageBucket: "app-tmdt-97150.appspot.com",
    messagingSenderId: "925256118208",
    appId: "1:925256118208:web:47e23b8d635065e0b7e225",
    measurementId: "G-BJCL2E7522"
};

// Initialize Firebase in Service Worker
firebase.initializeApp(firebaseConfig);

// Retrieve Firebase Messaging
const messaging = firebase.messaging();

// Handle background messages
messaging.onBackgroundMessage(function(payload) {
    console.log('Received background message ', payload);
    const notificationTitle = 'New Notification';
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/firebase-messaging-sw.js')
    .then(function(registration) {
        console.log('Service Worker registered with scope: ', registration.scope);
    })
    .catch(function(error) {
        console.log('Service Worker registration failed: ', error);
    });
}
