// Listen for new messages using Laravel Echo
// window.Echo.channel('chatroom')
//     .listen('.message.sent', (e) => {
//         appendMessage(e.message, 'outgoing');
//     })
//     .listen('.message.received', (e) => {
//         appendMessage(e.message, 'incoming');
//     });

window.Echo.channel('chatroom')
    .listen('.message.sent', (e) => {
        console.log(e);
        // Append the new message to the chatroom
        const messages = document.getElementById('messages');
        const messageContainer = document.createElement('div');
        messageContainer.classList.add('bg-gray-100', 'text-gray-800', 'p-3', 'rounded-lg', 'm-2', 'self-start');

        const messageText = document.createElement('p');
        messageText.innerText = e.message.text;
        messageContainer.appendChild(messageText);

        const userInfo = document.createElement('div');
        userInfo.classList.add('text-right', 'text-sm', 'text-gray-500');
        userInfo.innerText = `${e.message.user}, ${e.message.time}`;
        messageContainer.appendChild(userInfo);

        messages.appendChild(messageContainer);
    })




// Function to send a new message
window.sendMessage = function() {
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value;
    axios.post('/chat/send-message', { message: message })
        .then(response => {
            console.log(response.data);
            // Clear the input field after sending
            messageInput.value = '';
        })
        .catch(error => console.error(error));

    console.log('sent message');
};
