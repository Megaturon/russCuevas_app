<!-- Chatbot UI -->
<div id="chatbot-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; align-items: flex-end;">
  <!-- Chat Window -->
  <div id="chat-window" style="display: none; width: 300px; height: 400px; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); overflow: hidden; display: none; flex-direction: column;">
    <div style="background: #1a1a1a; color: white; padding: 15px; font-family: 'Playfair Display', serif; display: flex; justify-content: space-between; align-items: center;">
      <span style="font-size: 1.1rem; font-style: italic;">Russ Cuevas Assistant</span>
      <button onclick="toggleChat()" style="background: none; border: none; color: white; cursor: pointer;"><i class="fas fa-times"></i></button>
    </div>
    <div id="chat-messages" style="flex: 1; padding: 15px; overflow-y: auto; display: flex; flex-direction: column; gap: 10px; font-family: 'Inter', sans-serif; font-size: 0.9rem; background: #faf9f6;">
      <!-- Messages will appear here -->
      <div style="align-self: flex-start; background: #e5e7eb; color: #1f2937; padding: 8px 12px; border-radius: 15px 15px 15px 0; max-width: 80%;">
        Hello! How can I help you today?
      </div>
      <div id="chat-suggested-questions" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 6px;"></div>
    </div>
    <div style="padding: 10px; border-top: 1px solid #ddd; background: white; display: flex; gap: 10px;">
      <input type="text" id="chat-input" placeholder="Type a message..." style="flex: 1; padding: 8px 12px; border: 1px solid #ddd; border-radius: 20px; outline: none; font-family: 'Inter', sans-serif; font-size: 0.9rem;">
      <button onclick="sendChatMessage()" style="background: #1a1a1a; color: white; border: none; border-radius: 50%; width: 35px; height: 35px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-paper-plane" style="font-size: 0.8rem;"></i>
      </button>
    </div>
  </div>
  <!-- Chat Toggle Button -->
  <button id="chat-toggle-btn" onclick="toggleChat()" style="background: #1a1a1a; color: white; border: none; border-radius: 50%; width: 60px; height: 60px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-top: 10px; transition: transform 0.3s ease;">
    <i class="fas fa-comment-dots"></i>
  </button>
</div>

<script>
  // Chatbot Logic
  const chatWindow = document.getElementById('chat-window');
  const chatMessages = document.getElementById('chat-messages');
  const chatInput = document.getElementById('chat-input');
  const suggestedQuestionsContainer = document.getElementById('chat-suggested-questions');
  const starterQuestions = [
    'How do I book an appointment?',
    'How much do your gowns usually cost?',
    'Do you accept custom gown designs?',
    'How can I request a quote?'
  ];

  function renderStarterQuestions() {
    if (!suggestedQuestionsContainer) return;
    suggestedQuestionsContainer.innerHTML = '';

    starterQuestions.forEach((question) => {
      const button = document.createElement('button');
      button.type = 'button';
      button.textContent = question;
      button.style.border = '1px solid #d1d5db';
      button.style.background = '#ffffff';
      button.style.color = '#1f2937';
      button.style.borderRadius = '999px';
      button.style.padding = '6px 10px';
      button.style.fontSize = '0.75rem';
      button.style.cursor = 'pointer';
      button.style.textAlign = 'left';
      button.addEventListener('click', () => {
        sendChatMessage(question);
      });
      suggestedQuestionsContainer.appendChild(button);
    });
  }
  
  function toggleChat() {
    if (chatWindow.style.display === 'none') {
      chatWindow.style.display = 'flex';
      document.getElementById('chat-toggle-btn').style.transform = 'scale(0.8)';
    } else {
      chatWindow.style.display = 'none';
      document.getElementById('chat-toggle-btn').style.transform = 'scale(1)';
    }
  }

  function appendMessage(msg, sender) {
    const div = document.createElement('div');
    div.style.padding = '8px 12px';
    div.style.maxWidth = '80%';
    div.style.fontFamily = "'Inter', sans-serif";
    div.style.fontSize = "0.9rem";
    div.style.wordBreak = "break-word";
    div.style.overflowWrap = "break-word";
    if (sender === 'user') {
      div.style.alignSelf = 'flex-end';
      div.style.background = '#c5a48e';
      div.style.color = 'white';
      div.style.borderRadius = '15px 15px 0 15px';
    } else {
      div.style.alignSelf = 'flex-start';
      div.style.background = '#e5e7eb';
      div.style.color = '#1f2937';
      div.style.borderRadius = '15px 15px 15px 0';
    }
    
    // Escape HTML to prevent XSS
    let safeMsg = msg.replace(/[&<>'"]/g, tag => ({
      '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;'
    }[tag] || tag));

    // Convert URLs to clickable links
    const urlRegex = /(https?:\/\/[^\s]+)/g;
    safeMsg = safeMsg.replace(urlRegex, url => {
      return `<a href="${url}" target="_blank" style="text-decoration: underline; font-weight: bold;">${url}</a>`;
    });

    div.innerHTML = safeMsg;
    chatMessages.appendChild(div);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function sendChatMessage(prefilledMessage = null) {
    const msg = (prefilledMessage ?? chatInput.value).trim();
    if (!msg) return;
    
    appendMessage(msg, 'user');
    chatInput.value = '';
    
    // Post to backend
    fetch('/chatbot/send', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ message: msg })
    }).catch(err => console.error(err));
  }
  
  chatInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') sendChatMessage();
  });

  // Laravel Echo Websocket Listener
  document.addEventListener('DOMContentLoaded', () => {
    renderStarterQuestions();

    setTimeout(() => {
      if (window.Echo) {
        window.Echo.channel('chatbot')
          .listen('ChatMessageEvent', (e) => {
             // Only append if it's from Bot (our route sends as 'Bot')
             if(e.user === 'Bot') {
               appendMessage(e.message, 'bot');
             }
          });
      }
    }, 1000); // slight delay to ensure Echo is initialized
  });

</script>
