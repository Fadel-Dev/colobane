import{d as t,a as e,t as o,F as l,g as d,o as a,f as n,j as r}from"./app-99aca3ad.js";const x={class:"mx-auto bg-gray-200 max-w-2xl px-4 py-16 sm:px-6 sm:py-4 lg:max-w-7xl lg:px-8"},p={class:"text-2xl font-bold tracking-tight text-gray-900"},g={class:"mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8"},h=["onClick"],f={class:"min-h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80"},_=["src","alt"],m={class:"mt-4 flex justify-between"},u={class:"space-y-2"},v={class:"space-y-4"},w={class:"prix flex justify-between"},y={class:"text-md font-semibold text-cyan-900 text-justify"},b={class:"text-md font-semibold text-cyan-900 text-justify"},j=e("span",{class:"color-principal"},"Fcfa",-1),k=r('<div class="flex items-center space-x-4 justify-between"><div class="text-grey-500 flex flex-row space-x-1 my-4"><p class="text-xs"> 10/dec/2023 </p></div><div class="flex flex-row space-x-1"><div class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row"><span><a href="www.google.com">Booster</a></span></div><div class="text-2 bg-green-500 shadow-lg shadow- shadow-green-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl flex space-x-2 flex-row"><span>deja vendu</span></div></div></div>',1),N={__name:"article",props:{results:Object},setup(i){return surface,(c,B)=>(a(),t("div",x,[e("h2",p,o(c.$page.props.auth.user.name)+" Vos Publications ",1),e("div",g,[(a(!0),t(l,null,d(i.results,s=>(a(),t("div",{key:s.id,onClick:V=>c.navigateToBoost(s.id),class:"group relative"},[e("div",f,[e("img",{src:"/storage/"+s.image1,alt:s.imageAlt,class:"h-full w-full object-cover object-center lg:h-full lg:w-full"},null,8,_)]),e("div",m,[e("div",u,[e("div",v,[e("div",w,[e("h4",y,o(s.nom),1),e("h4",b,[n(o(s.prix)+" ",1),j])])]),k])])],8,h))),128))])]))}};export{N as default};