@props(['href', 'icon', 'text'])

<a href="{{ $href }}" target="_blank" class="button">
    <div class="icon"><i class="{{ $icon }}"></i></div>
    <div class="text">{{ $text }}</div>
  </a>

  <style>
  .button {
    display: inline-block;
    width: 220px;
    height: 120px;
    margin: 10px;
    background-color: rgb(216, 228, 227);
    border: 2px dotted rgb(22, 66, 22);
    border-radius: 1rem;
    text-align: center;
    transition: background-color 0.3s ease;
    padding: .5rem;
  }

  .button:hover {
    background-color: rgb(192,192,192);
    color: #fff;
  }

  .button .icon {
    font-size: 3rem;
    color: rgb(22, 66, 22);
    margin-bottom: .5rem;
  }

  .button .text {
    font-size: 1.2rem;
    font-weight: bold;
    color: rgb(22, 66, 22);
  }

  </style>
