window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from "{{asset('js/echo.js')}}";
//  import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key',
//     wsHost: window.location.hostname,
//     wsPort: 6001,
//     forceTLS: false,
//     disableStats: true,
// });

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');
window.Echo = new Echo({
broadcaster: 'pusher',
key: process.env.MIX_PUSHER_APP_KEY,
cluster: process.env.MIX_PUSHER_APP_CLUSTER,
forceTLS: false,
wsHost: window.location.hostname,
wsPort: 6001,
disableStats: true,
});

// window.Echo.channel(`websocket`)
//     .subscribed(() => {
//         console.log("Echo connected to WebSocket channel!");
//     })
//     .listen(".ForWebsocket", () => {
//         alert("New Order Received");
//       // console.log("New Order Data", data);
//     });