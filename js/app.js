// carousel functionality
jQuery(function ($) {
  $('.carousel').carousel();
  $('.next').click(function () {
    $('.carousel').carousel('next');
    return false;
  });
  $('.prev').click(function () {
    $('.carousel').carousel('prev');
    return false;
  });
});

// featured video width and height
Object.assign(document.querySelector('.embed-container iframe'), {
  width: '1000px',
  height: '562.50px',
});

class ClassWatcher {
  constructor(
    targetNode,
    classToWatchContains,
    classToWatchNotContains,
    classAddedCallback,
    classRemovedCallback
  ) {
    this.targetNode = targetNode;
    this.classToWatchContains = classToWatchContains;
    this.classToWatchNotContains = classToWatchNotContains;
    this.classAddedCallback = classAddedCallback;
    this.classRemovedCallback = classRemovedCallback;
    this.observer = null;
    this.lastClassState =
      targetNode.classList.contains(this.classToWatchContains) &&
      !targetNode.classList.contains(this.classToWatchNotContains);

    this.init();
  }

  init() {
    this.observer = new MutationObserver(this.mutationCallback);
    this.observe();
  }

  observe() {
    this.observer.observe(this.targetNode, { attributes: true });
  }

  disconnect() {
    this.observer.disconnect();
  }

  mutationCallback = (mutationsList) => {
    for (let mutation of mutationsList) {
      if (
        mutation.type === 'attributes' &&
        mutation.attributeName === 'class'
      ) {
        let contains = mutation.target.classList.contains(
          this.classToWatchContains
        );
        let notContains = !mutation.target.classList.contains(
          this.classToWatchNotContains
        );

        let currentClassState = contains && notContains;

        if (this.lastClassState !== currentClassState) {
          this.lastClassState = currentClassState;
          if (currentClassState) {
            this.classAddedCallback();
          } else {
            this.classRemovedCallback();
          }
        }
      }
    }
  };
}

let toggleNode = document.getElementById('navbar-toggle');
let navNode = document.getElementById('navbarSupportedContent');

toggleNode.addEventListener('click', () => {
  const sheet = document.styleSheets[3];
  if (!toggleNode.classList.contains('show')) {
    const header = document.getElementById('header');
    header.style.zIndex = 99999;
    if (sheet.cssRules[0].selectorText !== 'header::after') {
      sheet.insertRule('header::after { width: 0% !important }', 0);
    }
  }
});

function workOnClassAdd() {
  const sheet = document.styleSheets[3];
  document.getElementById('header').style.zIndex = 'inherit';

  if (sheet.cssRules[0].selectorText === 'header::after') {
    sheet.deleteRule(0);
  }
}

function workOnClassRemoval() {
  console.log('close');
}

// watch for a specific class change
// contains .collpase but not .show
let classWatcher = new ClassWatcher(
  navNode,
  'collapse',
  'show',
  workOnClassAdd,
  workOnClassRemoval
);

const navLinks = document.getElementsByClassName('nav-link');
Array.from(navLinks).forEach((navLink) => {
  navLink.addEventListener('click', () => {
    navNode.classList.remove('show');
    toggleNode.classList.add('collapsed');
    toggleNode.setAttribute('aria-expanded', 'false');
  });
});
