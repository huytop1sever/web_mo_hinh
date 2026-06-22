(function(){
  function onClick(e){
    var btn = e.target.closest('.btn-excerpt-toggle');
    if(!btn) return;

    var wrap = btn.closest('.excerpt-wrap');
    if(!wrap) return;

    var full = wrap.querySelector('.excerpt-full');
    if(!full) return;

    var action = btn.getAttribute('data-action') || 'show';

    if(action === 'show'){
      full.style.display = 'block';
      btn.setAttribute('data-action','hide');
      btn.textContent = 'Hide';
    }else{
      full.style.display = 'none';
      btn.setAttribute('data-action','show');
      btn.textContent = 'Show';
    }
  }

  document.addEventListener('click', onClick);
})();

