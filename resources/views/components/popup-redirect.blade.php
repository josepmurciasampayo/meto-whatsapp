@props(['title', 'text', 'btn_text', 'btn_href', 'btn_icon'])

<div class="popup-box">
    <div class="popup_secondary">
      <h2>{{ $title }}</h2>
      <p>{{ $text }}</p>
     <a href="{{ $btn_href }}">
        {{ $btn_text }}
        <i class="{{ $btn_icon }}"></i>
      </a>
      <button class="popup_close_secondary">Close <i class="far fa-window-close"></i></button>

    </div>
   
  </div>
  
  <style>


    .popup-box {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      justify-content: center;
      align-items: center;
    }
  
    .popup_secondary {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: #ffffff;
      padding: 20px;
      max-width: 600px;
      text-align: center;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
      position: relative;
      
    }
  
    .popup_secondary h2 {
      font-size: 20px;
      margin-top: 0;
      color: rgb(5,23,21);
      font-weight: bold;
    }
  
    .popup_secondary p {
      font-size: 15px;
      margin-top: 20px;
    }
  
    .popup_secondary a {
      display: inline-block;
      background-color: #ea4335;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      font-size: 15px;
      font-weight: bold;
      text-decoration: none;
      margin-top: 20px;
      transition: background-color 0.3s ease;
    }
  
    .popup_secondary a:hover {
      background-color: rgb(5,23,21);
    }
  
    .popup_secondary a i {
      margin-left: 10px;
    }
  
    .popup_secondary button,
    .popup_secondary a {
      display: inline-block;
      vertical-align: top;
      margin-right: 10px;
    }
  
    @media (max-width: 768px) {
      .popup_secondary {
        max-width: 300px;
      }
  
      .popup_secondary h2 {
        font-size: 24px;
      }
  
      .popup_secondary p {
        font-size: 16px;
      }
  
      .popup_secondary a {
        font-size: 16px;
        padding: 8px 16px;
      }
  
      .popup_secondary a i {
        margin-left: 5px;
      }

    .popup_close_secondary {
        max-width: 100px;
      }

    }
  
  .popup_close_secondary {
  font-size: 15px;
  font-weight:bold;
  color: #fff;
  background-color: rgb(57, 53, 53);
  border: none;
  padding: 2px 10px;
  margin-top: 2px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.popup_close_secondary:hover {
  background-color: rgb(5,23,21);
}

.popup_close_secondary i {vertical-align: middle;}

  </style>

<script>
  function showNotification() {
    const popupContainer = document.querySelector('.popup-box');
    const now = new Date();
    const expirationTime = now.getTime() + 5 * 1000; // 5 sec from now
    const lastVisit = getCookie('lastVisit');
    if (!lastVisit || now.getTime() - parseInt(lastVisit) > 5000) {
      setCookie('lastVisit', now.getTime(), expirationTime);
      popupContainer.style.display = 'flex';
    }
  }

  function setCookie(name, value, expirationTime) {
  const expires = new Date(expirationTime);
  document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
}


function getCookie(name) {
const value = '; ' + document.cookie;
const parts = value.split('; ' + name + '=');
if (parts.length === 2) {
return parts.pop().split(';').shift();
}
}

window.addEventListener('load', showNotification);

const closeButton = document.querySelector('.popup_close_secondary');
closeButton.addEventListener('click', () => {
const popupContainer = document.querySelector('.popup-box');
popupContainer.style.display = 'none';
});
</script>
