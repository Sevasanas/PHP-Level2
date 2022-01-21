'use strict';

const mediaQuery900 = window.matchMedia('(min-width: 901px)');

function handleTabletChange(e) {
  if (e.matches) {
    let getUrl = new URL(window.location);
    let url = getUrl.searchParams.get('method');
    if ( url == null || url == 'index' ) {
        let header = document.getElementById('header');
        header.style.position = 'absolute';
        header.style.backgroundColor = 'transparent';
    }
  } else {
        header.style.position = 'relative';
  }
};
mediaQuery900.addEventListener('change', handleTabletChange);
handleTabletChange(mediaQuery900);
