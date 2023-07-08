import './bootstrap';

import Alpine from 'alpinejs';
import autoAnimate from '@formkit/auto-animate';
Alpine.directive('animate', el => {
      autoAnimate(el);
})



window.Alpine = Alpine;

Alpine.start();
