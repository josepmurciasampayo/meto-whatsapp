@php
    $inviteText = Auth::user()->first . ' is inviting you to join them on Meto. Get started here: www.app.meto-intl.org';
@endphp

<div class="invite-popup-box" style="display:none">
    <div class="invite-popup">
        <h2 class="invite-popup-title display-8"><i class="fas fa-user-plus"></i> INVITE FRIENDS</h2>
        <p>Click the button to copy the invitation:</p>
        <button class="invite-popup-copy-btn" onclick="copyToClipboard('{{ $inviteText }}')">Copy <i class="fa fa-copy"></i></button>
        <hr>
        <h3 class="invite-popup-title display-8"><i class="fa fa-envelope-open-text"></i> SEND EMAIL INVITATION</h3>
        <form method="POST" action="{{ route('inviteFriends') }}">
            @csrf
            <div class="input-group">
                <input type="email" name="inviteEmail" class="invite-popup-input" placeholder="Enter email address">
                <button class="invite-popup-btn" onclick="inviteUser('{{ $inviteText }}')">Invite <i class="fa fa-paper-plane"></i></button>
            </div>
        </form>
        <button class="invite-popup-close" onclick="closePopup()">Close <i class="far fa-window-close"></i></button>
    </div>
</div>

<a href="#" class="btn btn-secondary d-flex align-items-center justify-content-center rounded" onclick="openInvitePopup()" style="border-radius: 999px !important;">
    <i class="fa fa-user-plus mr-2"></i>
    <span>Invite Friends</span>
</a>


<style>
.invite-popup-box {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.invite-popup-box p {
    margin-bottom: 10px;
}

.invite-popup {
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
}


.invite-popup-title {
    margin-top: 20px;
    margin-bottom: 10px;
}

.invite-popup-copy-btn,
.invite-popup-btn {
    font-size: 16px;
    font-weight: bold;
    height: 40px;
    color: #fff;
    background-color: rgb(22, 66, 22);
    border: none;
    padding: 10px 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.invite-popup-copy-btn:hover,
.invite-popup-btn:hover {
    background-color: #0062cc;
}

.input-group {
    display: flex;
}

.invite-popup-input {
    width: 60%;
    height: 40px;
    padding: 10px;
    border: 1px dashed;
    border-radius: 5px 0 0 5px;
}

.invite-popup-btn {
    padding: 10px 30px;
    border-radius: 0 5px 5px 0;
}

.invite-popup-close {
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #6c757d;
    border: none;
    padding: 10px 20px;
    margin-top: 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.invite-popup-close:hover {
    background-color: #5a6268;
}
</style>


<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
    }

    function closePopup() {
        document.querySelector('.invite-popup-box').style.display = 'none';
    }

    function openInvitePopup() {
        document.querySelector('.invite-popup-box').style.display = 'flex';
    }
</script>
