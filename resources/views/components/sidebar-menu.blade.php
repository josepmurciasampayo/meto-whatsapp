@props(['links' => []])

<aside class="sidebar">
    <button class="sidebar-toggle">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="nav flex-column">
        @foreach($links as $link)
            <li class="nav-item">
                <a href="{{ $link['href'] }}" class="nav-link">
                    <i class="{{ $link['icon'] }}"></i>
                    <span>{{ $link['label'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</aside>

<style>
    
.sidebar {
    position: fixed;
    top: 0;
    left: -250px;
    height: 60vh;
    width: 250px;
    background-color: rgb(5,23,21);
    transition: all 0.3s ease-in-out;
    margin-top: 5.5rem;
}


.sidebar.show {
    left: 0;
}

.sidebar-toggle {
    position: fixed;
    margin-top: 3.5rem;
    top: 20px;
    right: 10px;
    height: 60px;
    width: 50px;
    background-color: none;
    border: none;
    color: rgb(5,23,21);
    font-size: 20px;
    cursor: pointer;
}

.sidebar-toggle i {
  font-size: 40px;
}

.nav {
    padding: 20px;
}

.nav-link {
    display: flex;
    align-items: center;
    color: white;
    text-decoration: none;
    font-size: 16px;
    margin-bottom: 10px;
}

.nav-link i {
    margin-right: 10px;
}
</style>

<script>
const sidebar = document.querySelector('.sidebar');
const toggleButton = document.querySelector('.sidebar-toggle');

toggleButton.addEventListener('click', () => {
    sidebar.classList.toggle('show');
});
</script>