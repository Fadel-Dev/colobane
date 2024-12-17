import{P as u}from"./app-8596da2d.js";var r,e=(r=u)&&typeof r=="object"&&"default"in r?r.default:r,l=null;function f(n){document.addEventListener("inertia:start",x.bind(null,n)),document.addEventListener("inertia:progress",b),document.addEventListener("inertia:finish",h)}function x(n){l=setTimeout(function(){return e.start()},n)}function b(n){e.isStarted()&&n.detail.progress.percentage&&e.set(Math.max(e.status,n.detail.progress.percentage/100*.9))}function h(n){clearTimeout(l),e.isStarted()&&(n.detail.visit.completed?e.done():n.detail.visit.interrupted?e.set(0):n.detail.visit.cancelled&&(e.done(),e.remove()))}var w={init:function(n){var o=n===void 0?{}:n,s=o.delay,a=o.color,g=a===void 0?"#29d":a,p=o.includeCSS,c=p===void 0||p,d=o.showSpinner,m=d!==void 0&&d;f(s===void 0?250:s),e.configure({showSpinner:m}),c&&function(t){var i=document.createElement("style");i.type="text/css",i.textContent=`
    #nprogress {
      pointer-events: none;
    }

    #nprogress .bar {
      background: `+t+`;

      position: fixed;
      z-index: 1031;
      top: 0;
      left: 0;

      width: 100%;
      height: 2px;
    }

    #nprogress .peg {
      display: block;
      position: absolute;
      right: 0px;
      width: 100px;
      height: 100%;
      box-shadow: 0 0 10px `+t+", 0 0 5px "+t+`;
      opacity: 1.0;

      -webkit-transform: rotate(3deg) translate(0px, -4px);
          -ms-transform: rotate(3deg) translate(0px, -4px);
              transform: rotate(3deg) translate(0px, -4px);
    }

    #nprogress .spinner {
      display: block;
      position: fixed;
      z-index: 1031;
      top: 15px;
      right: 15px;
    }

    #nprogress .spinner-icon {
      width: 18px;
      height: 18px;
      box-sizing: border-box;

      border: solid 2px transparent;
      border-top-color: `+t+`;
      border-left-color: `+t+`;
      border-radius: 50%;

      -webkit-animation: nprogress-spinner 400ms linear infinite;
              animation: nprogress-spinner 400ms linear infinite;
    }

    .nprogress-custom-parent {
      overflow: hidden;
      position: relative;
    }

    .nprogress-custom-parent #nprogress .spinner,
    .nprogress-custom-parent #nprogress .bar {
      position: absolute;
    }

    @-webkit-keyframes nprogress-spinner {
      0%   { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes nprogress-spinner {
      0%   { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  `,document.head.appendChild(i)}(g)}};export{w as I};
