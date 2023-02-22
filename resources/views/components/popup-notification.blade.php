@props(['title', 'icon', 'text', 'btn_text', 'btn_class'])

<div class="popup-container">
    <div class="popup">
        <h2>{{ $title }}</h2>
        <p>{{ $text }}</p>
        <button class="{{ $btn_class }}">{{ $btn_text }} <i class="{{ $icon }}"></i></button>

    </div>
</div>

<style>
    .popup-container {
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

    .popup {
        background-color: white;
        padding: 20px;
        max-width: 400px;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .popup h2 {
        font-size: 24px;
        margin-top: 0;
    }

    .popup-close {
    background-color: #ddd;
    border: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    margin-top: 20px;
}

.popup-close i {
    font-size: 16px;
}

</style>

<script>
    function showNotification() {
        const popupContainer = document.querySelector('.popup-container');
        const popupClose = document.querySelector('.popup-close');

        const now = new Date();
        const expirationTime = now.getTime() + 60 * 1000; // 10 sec from now
        const lastVisit = getCookie('lastVisit');
        if (!lastVisit || now.getTime() > parseInt(lastVisit)) {
            setCookie('lastVisit', expirationTime);
            popupContainer.style.display = 'flex';
        }

        popupClose.addEventListener('click', () => {
            popupContainer.style.display = 'none';
        });

        function setCookie(name, value, expirationTime) {
            const expires = new Date(expirationTime).toUTCString();
            document.cookie = name + "=" + value + "; expires=" + expires + "; path=/";
        }

        function getCookie(name) {
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].trim();
                if (cookie.startsWith(name + "=")) {
                    return cookie.substring(name.length + 1);
                }
            }
            return null;
        }
    }

    // Call the function on page load
    document.addEventListener('DOMContentLoaded', showNotification);
</script>
