@props(['href', 'icon', 'text', 'progress'])

<a href="{{ $href }}" class="button">
    <span class="icon"><i class="{{ $icon }}"></i></span>
    <div class="text">{{ $text }}</div>
    <div class="progress">
      <div class="progress-bar" style="width: {{ $progress }}%">{{ $progress }}%</div>
    </div>
  </a>


  <style>
  
  .button {
    display: inline-block;
    width: 220px;
    height: 160px;
    margin: 10px;
    background-color: rgb(216, 228, 227);
    border: 1px dotted rgb(22, 66, 22);
    border-radius: 1rem;
    padding: 0.5rem;
    text-align: center;
    transition: background-color 0.3s ease;
  }
  
  .button:hover {
    background-color: rgb(192,192,192);
    color: #fff;
  }
  
  .button .icon {
    font-size: 3rem;
    color: rgb(22, 66, 22);
  }
  
  .button .text {
    font-size: 1rem;
    font-weight: bold;
    color: rgb(22, 66, 22);
    margin-bottom: 1rem;
  }
  
  .progress {
    width: 100%;
    height: 1rem;
    background-color: #dee2e6;
    border-radius: 0.5rem;
    overflow: hidden;
  }
  
  .progress-bar {
    height: 100%;
    font-size: 0.75rem;
    font-weight: bold;
    color: #fff;
    background-color: rgb(22, 66, 22);
    transition: width 0.3s ease;
  }


  </style>
  